Here are the contents for the file `/Ecommerce-App/Ecommerce-App/frontend/src/components/ProductList.js`:

import React, { useEffect, useState } from 'react';
import axios from 'axios';

const ProductList = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await axios.get('/api/products'); // Adjust the API endpoint as needed
                setProducts(response.data);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        fetchProducts();
    }, []);

    return (
        <div className="product-list">
            <h2>Product List</h2>
            <div className="products">
                {products.map(product => (
                    <div key={product.id} className="product">
                        <img src={product.gallery[0]} alt={product.name} />
                        <h3>{product.name}</h3>
                        <p>{product.description}</p>
                        <p>Price: {product.prices[0].currency.symbol}{product.prices[0].amount}</p>
                        <p>{product.inStock ? 'In Stock' : 'Out of Stock'}</p>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default ProductList;