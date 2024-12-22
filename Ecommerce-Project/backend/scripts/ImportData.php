<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class ImportData
{
    private $pdo;

    public function __construct()
    {
        // Load environment variables
        $dotenvPath = dirname(dirname(__FILE__));
        if (file_exists($dotenvPath . '/.env')) {
            $dotenv = Dotenv::createImmutable($dotenvPath);
            $dotenv->load();
        }

        // Database connection
        try {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $dbname = $_ENV['DB_NAME'] ?? 'Ecommerce';
            $username = $_ENV['DB_USER'] ?? 'root';
            $password = $_ENV['DB_PASS'] ?? 'Vita93**';

            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
            
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function import()
    {
        // Drop tables in the correct order to avoid foreign key constraint errors
        $dropTables = [
            'galleries',
            'attributes',
            'prices',
            'products',
            'categories'
        ];

        foreach ($dropTables as $table) {
            $this->pdo->exec("DROP TABLE IF EXISTS {$table}");
        }

        // Create tables
        $createTables = [
            "CREATE TABLE categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )",
            "CREATE TABLE products (
                id VARCHAR(255) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                inStock BOOLEAN NOT NULL,
                description TEXT,
                category VARCHAR(255),
                brand VARCHAR(255)
            )",
            "CREATE TABLE galleries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id VARCHAR(255),
                image_url TEXT,
                FOREIGN KEY (product_id) REFERENCES products(id)
            )",
            "CREATE TABLE attributes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id VARCHAR(255),
                attribute_name VARCHAR(255),
                attribute_value VARCHAR(255),
                FOREIGN KEY (product_id) REFERENCES products(id)
            )",
            "CREATE TABLE prices (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id VARCHAR(255),
                amount DECIMAL(10, 2),
                currency_label VARCHAR(10),
                currency_symbol VARCHAR(10),
                FOREIGN KEY (product_id) REFERENCES products(id)
            )"
        ];

        try {
            foreach ($createTables as $sql) {
                $this->pdo->exec($sql);
            }
        } catch (\PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }

        // Read the data from data.json
        $data = json_decode(file_get_contents(__DIR__ . '/../data.json'), true);

        // Insert categories
        $categories = $data['data']['categories'];
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        foreach ($categories as $category) {
            $stmt->execute(['name' => $category['name']]);
        }

        // Insert products
        $products = $data['data']['products'];
        $stmt = $this->pdo->prepare("INSERT INTO products (id, name, inStock, description, category, brand) VALUES (:id, :name, :inStock, :description, :category, :brand)");
        foreach ($products as $product) {
            $stmt->execute([
                'id' => $product['id'],
                'name' => $product['name'],
                'inStock' => $product['inStock'] ? 1 : 0, // Convert to boolean
                'description' => strip_tags($product['description']),
                'category' => $product['category'],
                'brand' => $product['brand']
            ]);
        }

        // Insert galleries
        $stmt = $this->pdo->prepare("INSERT INTO galleries (product_id, image_url) VALUES (:product_id, :image_url)");
        foreach ($products as $product) {
            foreach ($product['gallery'] as $imageUrl) {
                $stmt->execute([
                    'product_id' => $product['id'],
                    'image_url' => $imageUrl
                ]);
            }
        }

        // Insert attributes
        $stmt = $this->pdo->prepare("INSERT INTO attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, :attribute_name, :attribute_value)");
        foreach ($products as $product) {
            foreach ($product['attributes'] as $attribute) {
                foreach ($attribute['items'] as $item) {
                    $stmt->execute([
                        'product_id' => $product['id'],
                        'attribute_name' => $attribute['name'],
                        'attribute_value' => $item['value']
                    ]);
                }
            }
        }

        // Insert prices
        $stmt = $this->pdo->prepare("INSERT INTO prices (product_id, amount, currency_label, currency_symbol) VALUES (:product_id, :amount, :currency_label, :currency_symbol)");
        foreach ($products as $product) {
            foreach ($product['prices'] as $price) {
                $stmt->execute([
                    'product_id' => $product['id'],
                    'amount' => $price['amount'],
                    'currency_label' => $price['currency']['label'],
                    'currency_symbol' => $price['currency']['symbol']
                ]);
            }
        }

        echo "Data imported successfully.";
    }
}

$importData = new ImportData();
$importData->import();