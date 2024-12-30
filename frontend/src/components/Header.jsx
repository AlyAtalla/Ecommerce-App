import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/Header.css';

const Header = () => {
    return (
        <header className="header">
            <h1>My E-commerce Store</h1>
            <nav>
                <Link to="/">Home</Link>
                <Link to="/category/electronics">Electronics</Link>
                <Link to="/category/clothing">Clothing</Link>
                <Link to="/category/books">Books</Link>
            </nav>
        </header>
    );
};

export default Header;