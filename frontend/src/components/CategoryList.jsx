// filepath: /c:/Users/ANDALOS/Documents/GitHub/Ecommerce-App/Ecommerce-Project/frontend/src/components/CategoryList.jsx
import React, { Component } from 'react';
import ProductCard from './ProductCard';

class CategoryList extends Component {
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
                            price
                            imageUrl
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
            <div className="category-list">
                {products.map(product => (
                    <ProductCard key={product.id} product={product} />
                ))}
            </div>
        );
    }
}

export default CategoryList;