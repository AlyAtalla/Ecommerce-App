import React, { Component } from 'react';
import { useParams } from 'react-router-dom';

class ProductDetailPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            product: null
        };
    }

    componentDidMount() {
        const { id } = this.props.params;
        // Fetch product details from the GraphQL API
        fetch('http://localhost:8000/graphql', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                query: `
                    query {
                        product(id: "${id}") {
                            id
                            name
                            price
                            description
                            imageUrl
                        }
                    }
                `
            })
        })
        .then(response => response.json())
        .then(data => this.setState({ product: data.data.product }));
    }

    render() {
        const { product } = this.state;
        if (!product) return <div>Loading...</div>;
        return (
            <div className="product-detail-page">
                <img src={product.imageUrl} alt={product.name} />
                <h1>{product.name}</h1>
                <p>{product.description}</p>
                <p>${product.price}</p>
                <button className="add-to-cart">Add to Cart</button>
            </div>
        );
    }
}

export default function ProductDetailPageWrapper() {
    const params = useParams();
    return <ProductDetailPage params={params} />;
}