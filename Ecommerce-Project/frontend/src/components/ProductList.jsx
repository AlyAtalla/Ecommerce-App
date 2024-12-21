import React, { Component } from 'react';
import ProductCard from './ProductCard.jsx';

class ProductList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products: [],
            error: null
        };
    }

    componentDidMount() {
        // Fetch products from the GraphQL API
        fetch('http://localhost:8000/graphql', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                query: `
                    query {
                        products {
                            id
                            name
                            price
                            imageUrl
                        }
                    }
                `
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.errors) {
                throw new Error(data.errors.map(error => error.message).join(', '));
            }
            this.setState({ products: data.data.products });
        })
        .catch(error => this.setState({ error }));
    }

    render() {
        const { products, error } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        }
        return (
            <div className="category-list">
                {products.map(product => (
                    <ProductCard key={product.id} product={product} />
                ))}
            </div>
        );
    }
}

export default ProductList;