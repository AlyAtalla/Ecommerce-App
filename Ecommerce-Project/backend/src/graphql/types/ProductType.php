<?php
// File: /src/GraphQL/Types/ProductType.php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'description' => Type::string(),
                'price' => Type::nonNull(Type::float()),
                'category' => Type::string(),
                'stock' => Type::int(),
                'createdAt' => Type::string(),
                'updatedAt' => Type::string(),
            ],
        ];
        parent::__construct($config);
    }
}