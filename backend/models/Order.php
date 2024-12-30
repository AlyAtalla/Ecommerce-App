<?php
namespace App\Models;

class Order {
    protected $id;
    protected $product;
    protected $quantity;
    protected $total;

    public function __construct($id, $product, $quantity, $total) {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->total = $total;
    }

    public function getId() {
        return $this->id;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotal() {
        return $this->total;
    }
}