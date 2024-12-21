import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './index.css';
import App from './App.jsx';
import CategoryPageWrapper from './pages/CategoryPage.jsx';
import ProductDetailPageWrapper from './pages/ProductDetailPage.jsx';
import CartPage from './pages/CartPage.jsx';

createRoot(document.getElementById('root')).render(
  <Router>
    <Routes>
      <Route path="/" element={<App />} />
      <Route path="/category/:category" element={<CategoryPageWrapper />} />
      <Route path="/product/:id" element={<ProductDetailPageWrapper />} />
      <Route path="/cart" element={<CartPage />} />
    </Routes>
  </Router>
);