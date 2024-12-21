# Ecommerce-App/backend/README.md

# Ecommerce App Backend

This is the backend part of the Ecommerce App project, built using PHP. The backend is responsible for handling data management, business logic, and serving the frontend application through a RESTful API and GraphQL.

## Directory Structure

- **config/**: Contains configuration files, including database connection settings.
- **controllers/**: Contains controllers that handle requests and responses for various resources.
- **models/**: Contains model classes representing the application's data structures.
- **views/**: Contains view files that render the initial response for the backend.
- **graphql/**: Contains GraphQL schema definitions and resolvers for handling GraphQL queries and mutations.
- **index.php**: The main entry point for the backend application.
- **.htaccess**: Configuration file for URL rewriting and server settings.

## Requirements

- PHP 7.4 or higher
- MySQL 5.6 or higher
- Composer for dependency management

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the backend directory:
   ```
   cd Ecommerce-App/backend
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

4. Configure the database connection in `config/database.php`.

5. Populate the database with initial data as per the provided `data.json`.

6. Start the PHP built-in server:
   ```
   php -S localhost:8000 -t public
   ```

## Usage

- Access the API at `http://localhost:8000`.
- Use GraphQL queries and mutations to interact with products, categories, and attributes.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.