<?php
require_once __DIR__ . '/../Models/BaseModel.php';

class FavoriteModel extends BaseModel {
    protected $table = 'user_favorites';

    public function addFavorite($userId, $productId) {
        $sql = "INSERT IGNORE INTO {$this->table} (user_id, product_id) VALUES (?, ?)";
        return $this->query($sql, [$userId, $productId]);
    }

    public function removeFavorite($userId, $productId) {
        $sql = "DELETE FROM {$this->table} WHERE user_id = ? AND product_id = ?";
        return $this->query($sql, [$userId, $productId]);
    }

    public function isFavorite($userId, $productId) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} 
                WHERE user_id = ? AND product_id = ?";
        $result = $this->fetchOne($sql, [$userId, $productId]);
        return $result['count'] > 0;
    }

    public function getUserFavorites($userId) {
        $sql = "SELECT p.* FROM product p
                JOIN {$this->table} uf ON p.id = uf.product_id
                WHERE uf.user_id = ?";
        return $this->fetchAll($sql, [$userId]);
    }
}