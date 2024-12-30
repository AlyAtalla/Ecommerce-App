<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\GraphQL\Types\QueryType;
use App\GraphQL\Types\MutationType;

// Enable error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this in production for security
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight (OPTIONS) requests for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Ensure only POST requests are processed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'errors' => [
            ['message' => 'Method Not Allowed. Use POST.']
        ]
    ]);
    exit;
}

try {
    // Define the GraphQL schema
    $schema = new Schema([
        'query' => new QueryType(),
        'mutation' => new MutationType(),
    ]);

    // Retrieve the raw POST input
    $rawInput = file_get_contents('php://input');

    // Decode the JSON input to an associative array
    $input = json_decode($rawInput, true);

    // Check for JSON decoding errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \Exception('Invalid JSON input: ' . json_last_error_msg());
    }

    // Ensure that the input is an associative array
    if (!is_array($input)) {
        throw new \Exception('Invalid input format. Expected a JSON object.');
    }

    // Check if the 'query' parameter exists
    if (!isset($input['query'])) {
        throw new \Exception('No query provided.');
    }

    // Extract the query and variables from the input
    $query = $input['query'];
    $variableValues = $input['variables'] ?? null;

    // Execute the GraphQL query
    $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
    $output = $result->toArray();
} catch (\GraphQL\Error\SyntaxError $e) {
    // Handle GraphQL syntax errors
    $output = [
        'errors' => [
            [
                'message' => 'GraphQL Syntax Error: ' . $e->getMessage(),
                'locations' => $e->getLocations(),
            ],
        ],
    ];
    http_response_code(400); // Bad Request
} catch (\Exception $e) {
    // Handle other exceptions
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage(),
            ],
        ],
    ];
    http_response_code(400); // Bad Request
}

// Ensure the response is in JSON format
echo json_encode($output);