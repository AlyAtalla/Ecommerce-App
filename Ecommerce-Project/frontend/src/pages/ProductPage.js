import React, { useEffect, useState } from 'react';

const ProductPage = ({ match }) => {
    const [product, setProduct] = useState(null);
    const productId = match.params.id;

    useEffect(() => {
        const fetchProduct = async () => {
            const response = await fetch(`/api/products/${productId}`);
            const data = await response.json();
            setProduct(data);
        };

        fetchProduct();
    }, [productId]);

    if (!product) {
        return <div>Loading...</div>;
    }

    return (
        <div>
            <h1>{product.name}</h1>
            <img src={product.gallery[0]} alt={product.name} />
            <p>{product.description}</p>
            <p>Price: {product.prices[0].currency.symbol}{product.prices[0].amount}</p>
            <p>{product.inStock ? 'In Stock' : 'Out of Stock'}</p>
        </div>
    );
};

export default ProductPage;