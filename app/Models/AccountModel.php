<?php
// Models/AccountModel.php
require_once __DIR__ . '/BaseModel.php';
class AccountModel extends BaseModel {
    protected $table = 'account';
    
    // Lấy thông tin tài khoản theo ID
    public function getAccountById($id) {
        $sql = "SELECT id, fullname, email, phone, role, img FROM {$this->table} WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }
    
    // Lấy thông tin tài khoản theo email
    public function getAccountByEmail($email) {
        $sql = "SELECT id, fullname, email, phone, role, img FROM {$this->table} WHERE email = ?";
        return $this->fetchOne($sql, [$email]);
    }
    
    public function getFavoriteProducts($userId) {
        require_once __DIR__ . '/FavoriteModel.php';
        $favoriteModel = new FavoriteModel();
        return $favoriteModel->getUserFavorites($userId);
    }
    
    
    // Cập nhật thông tin tài khoản
    public function updateAccount($id, $data) {
        $fields = [];
        $values = [];
        
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
            $values[] = $value;
        }
        
        $values[] = $id; // Thêm ID vào cuối mảng value
        
        $sql = "UPDATE {$this->table} SET " . implode(", ", $fields) . " WHERE id = ?";
        return $this->query($sql, $values);
    }

    public function verifyPassword($id, $password) {
        $sql = "SELECT password FROM {$this->table} WHERE id = ?";
        $result = $this->fetchOne($sql, [$id]);
    
        if ($result && isset($result['password'])) {
            return $password === $result['password'];
        }
    
        return false;
    }
    
    public function updatePassword($id, $hashedPassword) {
        $sql = "UPDATE {$this->table} SET password = ? WHERE id = ?";
        return $this->query($sql, [$hashedPassword, $id]);
    }
}