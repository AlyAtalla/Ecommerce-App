<?php
// File: public/router.php

// Get the requested URI and remove query string
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Define the routes
switch ($requestUri) {
    case '/graphql':
        // Route to the GraphQL endpoint
        require_once 'index.php';
        break;
    case '/':
        // Route to the test page
        require_once 'test.html';
        break;
    default:
        // Serve static files or return 404
        $filePath = __DIR__ . $requestUri;
        if (is_file($filePath)) {
            return false; // Let the server handle it
        } else {
            // Return 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
        }
        break;
}
?>