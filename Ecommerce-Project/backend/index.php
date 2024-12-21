<?php
// This is the main entry point for the backend application

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductController.php';

// Initialize the application
$database = new Database();
$db = $database->getConnection();

$productController = new ProductController($db);

// Handle routing
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Example routing logic
if ($requestUri === '/products' && $requestMethod === 'GET') {
    $productController->getAllProducts();
} elseif (preg_match('/\/products\/(\d+)/', $requestUri, $matches) && $requestMethod === 'GET') {
    $productController->getProductById($matches[1]);
} elseif ($requestUri === '/products' && $requestMethod === 'POST') {
    $productController->createProduct();
} elseif (preg_match('/\/products\/(\d+)/', $requestUri, $matches) && $requestMethod === 'PUT') {
    $productController->updateProduct($matches[1]);
} elseif (preg_match('/\/products\/(\d+)/', $requestUri, $matches) && $requestMethod === 'DELETE') {
    $productController->deleteProduct($matches[1]);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Not Found"]);
}
?>