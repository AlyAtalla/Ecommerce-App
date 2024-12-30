<?php
// filepath: /src/Models/Category.php
namespace App\Models;

abstract class Category {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function getType();
}

class AllCategory extends Category {
    public function getType() {
        return 'all';
    }
}

class ClothesCategory extends Category {
    public function getType() {
        return 'clothes';
    }
}

class TechCategory extends Category {
    public function getType() {
        return 'tech';
    }
}