<?php
// filepath: /src/Models/Product.php
namespace App\Models;

abstract class Product {
    protected $id;
    protected $name;
    protected $inStock;
    protected $description;
    protected $category;
    protected $brand;

    public function __construct($id, $name, $inStock, $description, $category, $brand) {
        $this->id = $id;
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->category = $category;
        $this->brand = $brand;
    }

    abstract public function getType();
}

class ClothesProduct extends Product {
    public function getType() {
        return 'clothes';
    }
}

class TechProduct extends Product {
    public function getType() {
        return 'tech';
    }
}