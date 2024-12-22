<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductType extends ObjectType
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $config = [
            'name' => 'Product',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'name' => Type::nonNull(Type::string()),
                'price' => Type::nonNull(Type::float()),
                
                // Main image and multiple images
                'imageUrl' => Type::string(),
                'images' => Type::listOf(Type::string()),
                
                // Product details
                'description' => Type::string(),
                'category' => Type::string(),
                'brand' => Type::string(),
                
                // Inventory
                'stock' => Type::int(),
                
                // Computed fields
                'inStock' => [
                    'type' => Type::boolean(),
                    'resolve' => function($product) {
                        return ($product['stock'] ?? 0) > 0;
                    }
                ],
                
                // Pricing and discounts
                'originalPrice' => Type::float(),
                'discountPercentage' => Type::float(),
                
                // Metadata
                'createdAt' => Type::string(),
                'updatedAt' => Type::string(),
                
                // Additional product attributes
                'specifications' => Type::listOf(Type::string()),
                'rating' => Type::float(),
                'reviewCount' => Type::int()
            ],
        ];
        parent::__construct($config);
    }
}