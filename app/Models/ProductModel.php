<?php
require_once __DIR__ . '/BaseModel.php';

class ProductModel extends BaseModel {
    public function getAllProducts() {
        $sql = "SELECT * FROM product";
        return $this->fetchAll($sql);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM product WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    public function addProduct($name, $price) {
        $sql = "INSERT INTO product(name, price) VALUES (?, ?)";
        $this->query($sql, [$name, $price]);
        return $this->lastInsertId();
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE id = ?";
        return $this->query($sql, [$id]);
    }
}