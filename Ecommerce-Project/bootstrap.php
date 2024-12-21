<?php
// filepath: /c:/Users/ANDALOS/Documents/GitHub/Ecommerce-App/Ecommerce-Project/backend/bootstrap.php
require 'vendor/autoload.php';

use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use App\GraphQL\Types\MutationType;

// Define the schema
$schema = new Schema([
    'query' => null, // Define your query type here if needed
    'mutation' => new MutationType(),
]);

// Handle the request
$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];
$variableValues = isset($input['variables']) ? $input['variables'] : null;

try {
    $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($output);