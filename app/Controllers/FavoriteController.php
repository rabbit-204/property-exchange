<?php
require_once __DIR__ . '/../Models/FavoriteModel.php';

class FavoriteController {
    private $favoriteModel;

    public function __construct() {
        $this->favoriteModel = new FavoriteModel();
    }

    public function toggleFavorite() {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để sử dụng tính năng này']);
            return;
        }

        // Get data from request
        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'] ?? null;

        if (!$productId) {
            echo json_encode(['success' => false, 'message' => 'Thiếu thông tin sản phẩm']);
            return;
        }

        // Check if already favorite
        $isFavorite = $this->favoriteModel->isFavorite($userId, $productId);

        if ($isFavorite) {
            // Remove from favorites
            $result = $this->favoriteModel->removeFavorite($userId, $productId);
            $message = 'Đã xóa khỏi danh sách yêu thích';
            $newStatus = false;
        } else {
            // Add to favorites
            $result = $this->favoriteModel->addFavorite($userId, $productId);
            $message = 'Đã thêm vào danh sách yêu thích';
            $newStatus = true;
        }

        echo json_encode([
            'success' => true,
            'message' => $message,
            'isFavorite' => $newStatus
        ]);
    }

    public function getFavorites() {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            return [];
        }

        $userId = $_SESSION['user']['id'];
        return $this->favoriteModel->getUserFavorites($userId);
    }
}