<?php

abstract class Category {
    protected $id;
    protected $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    abstract public function save();
}

class ProductCategory extends Category {
    public function save() {
        // Logic to save the category to the database
    }
}

class ServiceCategory extends Category {
    public function save() {
        // Logic to save the category to the database
    }
}