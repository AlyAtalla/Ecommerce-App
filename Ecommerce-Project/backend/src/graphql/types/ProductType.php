<?php
// File: /src/GraphQL/Types/ProductType.php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Product',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'name' => Type::nonNull(Type::string()),
                'price' => Type::nonNull(Type::float()),
                'imageUrl' => Type::string(), // Add the imageUrl field
            ],
        ];
        parent::__construct($config);
    }
}