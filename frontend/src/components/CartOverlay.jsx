// filepath: /c:/Users/ANDALOS/Documents/GitHub/Ecommerce-App/Ecommerce-Project/frontend/src/components/CartOverlay.jsx
import React, { Component } from 'react';

class CartOverlay extends Component {
    render() {
        const { product, onClose } = this.props;
        return (
            <div className="cart-overlay">
                <div className="cart-overlay-content">
                    <button onClick={onClose}>Close</button>
                    <h2>{product.name}</h2>
                    <p>${product.price}</p>
                    <button className="place-order">Place Order</button>
                </div>
            </div>
        );
    }
}

export default CartOverlay;