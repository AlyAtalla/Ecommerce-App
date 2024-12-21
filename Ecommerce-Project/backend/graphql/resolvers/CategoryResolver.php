<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category;

class CategoryResolver
{
    public function getCategories()
    {
        // Logic to fetch all categories
        return Category::all();
    }

    public function getCategoryById($id)
    {
        // Logic to fetch a category by ID
        return Category::find($id);
    }

    public function createCategory($args)
    {
        // Logic to create a new category
        $category = new Category();
        $category->name = $args['name'];
        $category->save();
        return $category;
    }

    public function updateCategory($id, $args)
    {
        // Logic to update an existing category
        $category = Category::find($id);
        if ($category) {
            $category->name = $args['name'];
            $category->save();
            return $category;
        }
        return null;
    }

    public function deleteCategory($id)
    {
        // Logic to delete a category
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }
}