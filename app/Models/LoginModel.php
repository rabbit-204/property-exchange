<?php
require_once __DIR__ . '/BaseModel.php';

class LoginModel extends BaseModel {
    // Kiểm tra thông tin đăng nhập
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        return $this->fetchOne($sql, [
            ':email' => $email,
            ':password' => $password
        ]);
    }

    // Đăng ký người dùng mới
    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        return $this->query($sql, [
            ':name' => $name,
            ':email' => $email,
            ':password' => $password
        ]);
    }
}
?>