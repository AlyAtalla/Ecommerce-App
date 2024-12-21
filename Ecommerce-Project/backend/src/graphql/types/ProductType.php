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
                'imageUrl' => Type::string(),
                'description' => Type::string(),
                'category' => Type::string(),
                'stock' => Type::int(),
                // Add createdAt and updatedAt fields
                'createdAt' => Type::string(),
                'updatedAt' => Type::string(),
            ],
        ];
        parent::__construct($config);
    }
}