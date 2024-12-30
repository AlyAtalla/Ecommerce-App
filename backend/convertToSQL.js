const fs = require('fs');

// Read the JSON file
const data = JSON.parse(fs.readFileSync('data.json', 'utf8'));

const categories = data.data.categories;
const products = data.data.products;

let categoryInserts = [];
let productInserts = [];
let galleryInserts = [];
let attributeInserts = [];
let priceInserts = [];

categories.forEach(category => {
    categoryInserts.push(`INSERT INTO categories (name) VALUES ('${category.name}');`);
});

products.forEach(product => {
    productInserts.push(`INSERT INTO products (id, name, inStock, description, category, brand) VALUES ('${product.id}', '${product.name}', ${product.inStock}, '${product.description.replace(/'/g, "''")}', '${product.category}', '${product.brand}');`);
    product.gallery.forEach(image => {
        galleryInserts.push(`INSERT INTO galleries (product_id, image_url) VALUES ('${product.id}', '${image}');`);
    });
    product.attributes.forEach(attributeSet => {
        attributeSet.items.forEach(attribute => {
            attributeInserts.push(`INSERT INTO attributes (product_id, attribute_name, attribute_value) VALUES ('${product.id}', '${attributeSet.name}', '${attribute.value}');`);
        });
    });
    product.prices.forEach(price => {
        priceInserts.push(`INSERT INTO prices (product_id, amount, currency_label, currency_symbol) VALUES ('${product.id}', ${price.amount}, '${price.currency.label}', '${price.currency.symbol}');`);
    });
});

const sqlStatements = [
    ...categoryInserts,
    ...productInserts,
    ...galleryInserts,
    ...attributeInserts,
    ...priceInserts
].join('\n');

// Write the SQL statements to a file
fs.writeFileSync('insert_data.sql', sqlStatements);

console.log('SQL insert statements have been generated and saved to insert_data.sql');