<?php

class ProductController
{
    private $productModel;

    public function __construct($productModel)
    {
        $this->productModel = $productModel;
    }

    public function getAllProducts()
    {
        return $this->productModel->getAll();
    }

    public function getProductById($id)
    {
        return $this->productModel->getById($id);
    }

    public function createProduct($data)
    {
        return $this->productModel->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->productModel->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productModel->delete($id);
    }
}