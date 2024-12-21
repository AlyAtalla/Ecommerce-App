// filepath: /c:/Users/ANDALOS/Documents/GitHub/Ecommerce-App/Ecommerce-Project/frontend/src/App.js
import React, { Component } from 'react';
import ProductList from './components/ProductList';
import './styles/main.css';

class App extends Component {
    render() {
        return (
            <div className="App">
                <ProductList />
            </div>
        );
    }
}

export default App;