import React, { Component } from 'react';
import ProductList from './components/ProductList.jsx';
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