<?php
// File: public/router.php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/graphql':
        require_once 'index.php';
        break;
    case '/':
    case '/index.html':
        header('Content-Type: text/html; charset=utf-8');
        header('X-UA-Compatible: IE=edge');
        readfile('index.html');
        exit;
    default:
        $filePath = __DIR__ . $requestUri;
        if (is_file($filePath)) {
            return false; // Let the server handle static files
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
        break;
}