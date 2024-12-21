import React, { Component } from 'react';
import { useParams } from 'react-router-dom';
import CategoryList from '../components/CategoryList.jsx';

class CategoryPage extends Component {
    render() {
        const { category } = this.props.params;
        return (
            <div className="category-page">
                <h1>Category: {category}</h1>
                <CategoryList category={category} />
            </div>
        );
    }
}

export default function CategoryPageWrapper() {
    const params = useParams();
    return <CategoryPage params={params} />;
}