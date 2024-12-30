<?php

require 'vendor/autoload.php';

use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use App\Resolvers\OrderResolver;

// Define the schema
$schema = new Schema([
    'query' => null, // Define your query type here
    'mutation' => new MutationType([
        'createOrder' => [
            'type' => Type::order(),
            'args' => [
                'productId' => Type::nonNull(Type::id()),
                'quantity' => Type::nonNull(Type::int()),
            ],
            'resolve' => [new OrderResolver(), 'createOrder'],
        ],
    ]),
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