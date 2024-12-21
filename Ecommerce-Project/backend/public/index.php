<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\GraphQL\Types\QueryType;
use App\GraphQL\Types\MutationType;

// Comprehensive error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../graphql_error.log');

// Set headers to prevent Quirks Mode and ensure proper content type
header('X-UA-Compatible: IE=edge');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Logging function
function logGraphQLError($message, $context = []) {
    error_log(json_encode([
        'timestamp' => date('Y-m-d H:i:s'),
        'message' => $message,
        'context' => $context
    ], JSON_PRETTY_PRINT));
}

try {
    // Ensure only POST requests are processed
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        throw new \Exception('Only POST requests are allowed');
    }

    // Get raw input
    $rawInput = file_get_contents('php://input');

    // Log raw input for debugging
    logGraphQLError('Raw Input', ['input' => $rawInput]);

    // Validate input
    if (empty($rawInput)) {
        http_response_code(400);
        throw new \Exception('No query provided');
    }

    // Decode input
    $input = json_decode($rawInput, true);

    // Check for JSON decoding errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        throw new \Exception('Invalid JSON: ' . json_last_error_msg());
    }

    // Validate query
    if (!isset($input['query'])) {
        http_response_code(400);
        throw new \Exception('No GraphQL query found in the request');
    }

    // Define schema
    $schema = new Schema([
        'query' => new QueryType(),
        'mutation' => new MutationType(),
    ]);

    // Execute query
    $result = GraphQL::executeQuery(
        $schema, 
        $input['query'], 
        null, 
        null, 
        $input['variables'] ?? null
    );

    // Convert result to array
    $output = $result->toArray();

} catch (\Throwable $e) {
    // Comprehensive error handling
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]
        ]
    ];
    
    // Log the full error
    logGraphQLError('GraphQL Error', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}

// Ensure JSON output
echo json_encode($output);