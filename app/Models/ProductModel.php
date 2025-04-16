<?php
require_once 'core/BaseModel.php';

class ProductModel extends BaseModel {
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        return $this->fetchAll($sql);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    public function addProduct($name, $price) {
        $sql = "INSERT INTO products(name, price) VALUES (?, ?)";
        $this->query($sql, [$name, $price]);
        return $this->lastInsertId();
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        return $this->query($sql, [$id]);
    }
}