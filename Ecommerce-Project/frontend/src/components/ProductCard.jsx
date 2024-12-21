// filepath: /c:/Users/ANDALOS/Documents/GitHub/Ecommerce-App/Ecommerce-Project/frontend/src/components/ProductCard.jsx
import React, { Component } from 'react';

class ProductCard extends Component {
    render() {
        const { product } = this.props;
        return (
            <div className="product-card">
                <img src={product.imageUrl} alt={product.name} />
                <h2>{product.name}</h2>
                <p>${product.price}</p>
            </div>
        );
    }
}

export default ProductCard;