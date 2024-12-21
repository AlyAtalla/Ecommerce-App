<?php
// File: /src/GraphQL/Types/QueryType.php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Models\Product;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'products' => [
                    'type' => Type::listOf(new ProductType()),
                    'resolve' => function () {
                        // Fetch products from the database or any other source
                        return Product::all();
                    },
                ],
            ],
        ];
        parent::__construct($config);
    }
}