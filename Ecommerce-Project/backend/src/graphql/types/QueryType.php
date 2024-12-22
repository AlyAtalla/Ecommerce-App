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
                    'args' => [
                        'category' => Type::string(),
                        'brand' => Type::string(),
                        'minPrice' => Type::float(),
                        'maxPrice' => Type::float(),
                        'inStock' => Type::boolean(),
                        'limit' => Type::int(),
                        'offset' => Type::int()
                    ],
                    'resolve' => function ($root, $args) {
                        $products = [
                            [
                                'id' => '1',
                                'name' => 'Smartphone Pro',
                                'price' => 799.99,
                                'originalPrice' => 899.99,
                                'discountPercentage' => 11.11,
                                'imageUrl' => 'https://example.com/smartphone-pro-main.jpg',
                                'images' => [
                                    'https://example.com/smartphone-pro-main.jpg',
                                    'https://example.com/smartphone-pro-side.jpg',
                                    'https://example.com/smartphone-pro-back.jpg'
                                ],
                                'description' => 'Advanced smartphone with cutting-edge technology',
                                'category' => 'Electronics',
                                'brand' => 'TechBrand',
                                'stock' => 50,
                                'specifications' => [
                                    '6.5" OLED Display',
                                    '5G Enabled',
                                    '128GB Storage',
                                    'Quad Camera Setup'
                                ],
                                'rating' => 4.5,
                                'reviewCount' => 250,
                                'createdAt' => date('c'),
                                'updatedAt' => date('c')
                            ],
                            [
                                'id' => '2',
                                'name' => 'Laptop Ultra',
                                'price' => 1299.99,
                                'originalPrice' => 1499.99,
                                'discountPercentage' => 13.33,
                                'imageUrl' => 'https://example.com/laptop-ultra-main.jpg',
                                'images' => [
                                    'https://example.com/laptop-ultra-main.jpg',
                                    'https://example.com/laptop-ultra-open.jpg',
                                    'https://example.com/laptop-ultra-side.jpg'
                                ],
                                'description' => 'High-performance laptop for professionals',
                                'category' => 'Computers',
                                'brand' => 'ProTech',
                                'stock' => 25,
                                'specifications' => [
                                    'Intel Core i7',
                                    '16GB RAM',
                                    '512GB SSD',
                                    'NVIDIA RTX Graphics'
                                ],
                                'rating' => 4.7,
                                'reviewCount' => 180,
                                'createdAt' => date('c'),
                                'updatedAt' => date('c')
                            ],
                            [
                                'id' => '3',
                                'name' => 'Wireless Earbuds',
                                'price' => 199.99,
                                'originalPrice' => 249.99,
                                'discountPercentage' => 20,
                                'imageUrl' => 'https://example.com/earbuds-main.jpg',
                                'images' => [
                                    'https://example.com/earbuds-main.jpg',
                                    'https://example.com/earbuds-case.jpg',
                                    'https://example.com/earbuds-colors.jpg'
                                ],
                                'description' => 'Noise-cancelling wireless earbuds',
                                'category' => 'Audio',
                                'brand' => 'SoundWave',
                                'stock' => 100,
                                'specifications' => [
                                    'Active Noise Cancellation',
                                    '8 Hours Battery Life',
                                    'Touch Controls',
                                    'Water Resistant'
                                ],
                                'rating' => 4.3,
                                'reviewCount' => 350,
                                'createdAt' => date('c'),
                                'updatedAt' => date('c')
                            ],
                            [
                                'id' => '4',
                                'name' => 'Smart Watch',
                                'price' => 249.99,
                                'originalPrice' => 299.99,
                                'discountPercentage' => 16.67,
                                'imageUrl' => 'https://example.com/smartwatch-main.jpg',
                                'images' => [
                                    'https://example.com/smartwatch-main.jpg',
                                    'https://example.com/smartwatch-side.jpg',
                                    'https://example.com/smartwatch-app.jpg'
                                ],
                                'description' => 'Advanced fitness and health tracking smartwatch',
                                'category' => 'Wearables',
                                'brand' => 'FitTech',
                                'stock' => 75,
                                'specifications' => [
                                    'Heart Rate Monitor',
                                    'GPS Tracking',
                                    'Sleep Analysis',
                                    'Water Resistant'
                                ],
                                'rating' => 4.6,
                                'reviewCount' => 220,
                                'createdAt' => date('c'),
                                'updatedAt' => date('c')
                            ]
                        ];

                        // Apply filters
                        return array_filter($products, function($product) use ($args) {
                            // Category filter
                            if (isset($args['category']) && $product['category'] !== $args['category']) {
                                return false;
                            }

                            // Brand filter
                            if (isset($args['brand']) && $product['brand'] !== $args['brand']) {
                                return false;
                            }

                            // Price range filter
                            if (isset($args['minPrice']) && $product['price'] < $args['minPrice']) {
                                return false;
                            }
                            if (isset($args['maxPrice']) && $product['price'] > $args['maxPrice']) {
                                return false;
                            }

                            // In Stock filter
                            if (isset($args['inStock']) && 
                                (($product['stock'] > 0) !== $args['inStock'])) {
                                return false;
                            }

                            return true;
                        });
                    }
                ],
                
                // Categories Query
                'categories' => [
                    'type' => Type::listOf(Type::string()),
                    'resolve' => function() {
                        return [
                            'Electronics',
                            'Computers',
                            'Audio',
                            'Wearables'
                        ];
                    }
                ],

                // Brands Query
                'brands' => [
                    'type' => Type::listOf(Type::string()),
                    'resolve' => function() {
                        return [
                            'TechBrand',
                            'ProTech',
                            'SoundWave',
                            'FitTech'
                        ];
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}