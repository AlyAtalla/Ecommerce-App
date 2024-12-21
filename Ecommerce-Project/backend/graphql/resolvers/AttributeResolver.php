<?php

namespace App\GraphQL\Resolvers;

use App\Models\Attribute;

class AttributeResolver
{
    public function getAttributes($root, $args, $context)
    {
        // Logic to fetch attributes from the database
        return Attribute::all();
    }

    public function getAttribute($root, $args, $context)
    {
        // Logic to fetch a single attribute by ID
        return Attribute::find($args['id']);
    }

    public function createAttribute($root, $args, $context)
    {
        // Logic to create a new attribute
        $attribute = new Attribute();
        $attribute->name = $args['name'];
        $attribute->value = $args['value'];
        $attribute->save();
        return $attribute;
    }

    public function updateAttribute($root, $args, $context)
    {
        // Logic to update an existing attribute
        $attribute = Attribute::find($args['id']);
        if ($attribute) {
            $attribute->name = $args['name'];
            $attribute->value = $args['value'];
            $attribute->save();
            return $attribute;
        }
        return null;
    }

    public function deleteAttribute($root, $args, $context)
    {
        // Logic to delete an attribute
        $attribute = Attribute::find($args['id']);
        if ($attribute) {
            $attribute->delete();
            return true;
        }
        return false;
    }
}