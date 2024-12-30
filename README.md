# Ecommerce-App

## Project Overview

Ecommerce-App is a full-stack eCommerce application built with PHP for the backend and React.js for the frontend. This project aims to provide a seamless shopping experience with features such as product listing, category management, and order processing.

## Project Structure

The project is organized into two main directories: `backend` and `frontend`.

### Backend

The backend is responsible for handling data management, business logic, and serving API endpoints. It is built using PHP and follows an object-oriented programming approach.

- **config/database.php**: Contains the database connection settings and configuration for the MySQL database.
- **controllers/ProductController.php**: Handles product-related operations such as fetching, creating, updating, and deleting products.
- **models/Product.php**: Represents the product model with properties like `id`, `name`, `description`, `price`, and methods for interacting with product data.
- **models/Category.php**: Represents the category model with properties like `id` and `name`, and methods for managing categories.
- **models/Attribute.php**: Represents the attribute model with properties like `id`, `name`, and `value`, and methods for managing attributes.
- **views/index.php**: Serves as the main entry point for the backend application, rendering the initial view or response.
- **graphql/schema.graphql**: Defines the GraphQL schema for the application, including types for products, categories, and attributes.
- **graphql/resolvers/**: Contains resolvers for handling GraphQL queries and mutations related to products, categories, and attributes.
- **index.php**: The main entry point for the backend application, initializing the application and routing requests.
- **.htaccess**: Used for URL rewriting and configuring server settings for the backend application.
- **README.md**: Documentation for the backend part of the project.

### Frontend

The frontend is responsible for the user interface and user experience. It is built using React.js and provides a dynamic and responsive design.

- **public/index.html**: The main HTML file for the frontend application, serving as the entry point for the React app.
- **public/favicon.ico**: The favicon for the frontend application.
- **src/components/**: Contains reusable components such as Header, Footer, and ProductList.
- **src/pages/**: Contains page components such as HomePage, ProductPage, and CartPage.
- **src/App.js**: The main component that sets up routing and renders the application.
- **src/index.js**: The entry point for the React application, rendering the App component into the DOM.
- **src/styles/main.css**: Contains the main CSS styles for the frontend application.
- **package.json**: Configuration file for npm, listing dependencies and scripts for the frontend application.
- **.babelrc**: Babel configuration for transpiling JavaScript.
- **.eslintrc.json**: ESLint configuration for linting JavaScript code.
- **README.md**: Documentation for the frontend part of the project.

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.6 or higher
- Node.js and npm

### Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   cd Ecommerce-App
   ```

2. Set up the backend:
   - Navigate to the `backend` directory.
   - Configure the database connection in `config/database.php`.
   - Run the necessary SQL scripts to create and populate the database.

3. Set up the frontend:
   - Navigate to the `frontend` directory.
   - Install dependencies:
     ```
     npm install
     ```

4. Start the backend server:
   - Use a local server (like XAMPP or MAMP) to serve the backend files.

5. Start the frontend development server:
   ```
   npm start
   ```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.