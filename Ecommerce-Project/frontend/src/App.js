import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import HomePage from './pages/HomePage';
import ProductPage from './pages/ProductPage';
import CartPage from './pages/CartPage';
import Header from './components/Header';
import Footer from './components/Footer';
import './styles/main.css';

function App() {
    return (
        <Router>
            <Header />
            <Switch>
                <Route path="/" exact component={HomePage} />
                <Route path="/product/:id" component={ProductPage} />
                <Route path="/cart" component={CartPage} />
            </Switch>
            <Footer />
        </Router>
    );
}

export default App;