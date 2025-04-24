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
    
    // Lấy danh sách sản phẩm của tài khoản
    public function getAccountProducts($id) {
        $sql = "SELECT listProduct FROM {$this->table} WHERE id = ?";
        $result = $this->fetchOne($sql, [$id]);
        
        if ($result && $result['listProduct']) {
            $productIds = json_decode($result['listProduct'], true);
            
            // Now fetch the actual product details
            if (!empty($productIds)) {
                require_once __DIR__ . '/ProductModel.php';
                $productModel = new ProductModel();
                $products = [];
                
                foreach ($productIds as $productId) {
                    $product = $productModel->getProductById($productId);
                    if ($product) {
                        $products[] = $product;
                    }
                }
                
                return $products;
            }
        }
        
        return [];
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