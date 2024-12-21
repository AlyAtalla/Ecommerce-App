import React, { Component } from 'react';

class ProductList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products: []
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
                            inStock
                            description
                            category {
                                name
                            }
                            brand
                        }
                    }
                `
            })
        })
        .then(response => response.json())
        .then(data => this.setState({ products: data.data.products }));
    }

    render() {
        const { products } = this.state;
        return (
            <div>
                <h1>Product List</h1>
                <ul>
                    {products.map(product => (
                        <li key={product.id}>
                            <h2>{product.name}</h2>
                            <p>{product.description}</p>
                            <p>Category: {product.category.name}</p>
                            <p>Brand: {product.brand}</p>
                        </li>
                    ))}
                </ul>
            </div>
        );
    }
}

export default ProductList;