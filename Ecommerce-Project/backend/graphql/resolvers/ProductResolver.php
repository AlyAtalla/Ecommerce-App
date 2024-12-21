<?php

namespace GraphQL\Resolvers;

use Models\Product;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\FieldDefinition;
use GraphQL\Type\Definition\InputObjectType;

class ProductResolver
{
    public function getProducts($root, $args)
    {
        // Logic to fetch products from the database
        return Product::all();
    }

    public function getProduct($root, $args)
    {
        // Logic to fetch a single product by ID
        return Product::find($args['id']);
    }

    public function createProduct($root, $args)
    {
        // Logic to create a new product
        return Product::create($args);
    }

    public function updateProduct($root, $args)
    {
        // Logic to update an existing product
        $product = Product::find($args['id']);
        if ($product) {
            $product->update($args);
            return $product;
        }
        return null;
    }

    public function deleteProduct($root, $args)
    {
        // Logic to delete a product
        $product = Product::find($args['id']);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}