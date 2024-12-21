<?php

abstract class ProductModel {
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    public function __construct($id, $name, $description, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    abstract public function save();
    abstract public function delete();
}

class Product extends ProductModel {
    public function save() {
        // Logic to save the product to the database
    }

    public function delete() {
        // Logic to delete the product from the database
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }
}