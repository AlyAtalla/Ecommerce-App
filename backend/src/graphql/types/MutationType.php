<?php
// File: /src/GraphQL/Types/MutationType.php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Mutation',
            'fields' => [
                'createProduct' => [
                    'type' => ProductType::getInstance(),
                    'args' => [
                        'name' => Type::nonNull(Type::string()),
                        'description' => Type::string(),
                        'price' => Type::nonNull(Type::float()),
                        'category' => Type::string(),
                        'stock' => Type::int(),
                    ],
                    'resolve' => function ($root, $args) {
                        // Here you would typically:
                        // 1. Validate input
                        // 2. Create product in the database
                        // 3. Return the created product
                        // For demonstration, we'll return a mock product
                        return [
                            'id' => '3', // In reality, generate this dynamically
                            'name' => $args['name'],
                            'description' => $args['description'] ?? '',
                            'price' => $args['price'],
                            'category' => $args['category'] ?? '',
                            'stock' => $args['stock'] ?? 0,
                            'createdAt' => date('c'),
                            'updatedAt' => date('c'),
                        ];
                    }
                ],
                // Add more mutation fields as needed
            ],
        ];
        parent::__construct($config);
    }
}