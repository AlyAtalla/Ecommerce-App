import React from 'react';

const Footer = () => {
    return (
        <footer>
            <div className="footer-content">
                <p>&copy; {new Date().getFullYear()} Ecommerce-App. All rights reserved.</p>
                <p>Follow us on social media!</p>
            </div>
        </footer>
    );
};

export default Footer;