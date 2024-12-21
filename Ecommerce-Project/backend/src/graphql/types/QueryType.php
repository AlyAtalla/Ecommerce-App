<?php
// File: /src/GraphQL/Types/QueryType.php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(ProductType::getInstance()),
                    'resolve' => function () {
                        // Fetch products from the database or any other source
                        return [
                            [
                                'id' => '1',
                                'name' => 'Product 1',
                                'description' => 'Description 1',
                                'price' => 99.99,
                                'category' => 'Electronics',
                                'stock' => 10,
                                'createdAt' => '2023-01-01T00:00:00Z',
                                'updatedAt' => '2023-01-01T00:00:00Z',
                            ],
                            [
                                'id' => '2',
                                'name' => 'Product 2',
                                'description' => 'Description 2',
                                'price' => 149.99,
                                'category' => 'Books',
                                'stock' => 5,
                                'createdAt' => '2023-02-01T00:00:00Z',
                                'updatedAt' => '2023-02-01T00:00:00Z',
                            ],
                            // Add more products as needed
                        ];
                    }
                ],
                // Add more query fields as needed
            ],
        ];
        parent::__construct($config);
    }
}