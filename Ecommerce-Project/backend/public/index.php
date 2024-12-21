<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\GraphQL\Types\QueryType;
use App\GraphQL\Types\MutationType;

// Enable error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
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
    // Define the schema
    $schema = new Schema([
        'query' => new QueryType(),
        'mutation' => new MutationType(),
    ]);

    // Get raw input
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    // Check if query is provided
    if (!isset($input['query'])) {
        throw new \Exception('No query provided');
    }

    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;

    $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
    $output = $result->toArray();
} catch (\GraphQL\Error\SyntaxError $e) {
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