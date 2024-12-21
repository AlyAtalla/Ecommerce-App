<?php
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
                        // Return an array of product objects with all fields
                        return [
                            [
                                'id' => '1',
                                'name' => 'Smartphone',
                                'price' => 599.99,
                                'imageUrl' => 'https://example.com/smartphone.jpg',
                                'description' => 'High-end smartphone with advanced features',
                                'category' => 'Electronics',
                                'stock' => 50,
                                'createdAt' => date('c'), // ISO 8601 format
                                'updatedAt' => date('c')
                            ],
                            [
                                'id' => '2',
                                'name' => 'Laptop',
                                'price' => 1299.99,
                                'imageUrl' => 'https://example.com/laptop.jpg',
                                'description' => 'Powerful laptop for professional use',
                                'category' => 'Computers',
                                'stock' => 25,
                                'createdAt' => date('c'),
                                'updatedAt' => date('c')
                            ]
                        ];
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}