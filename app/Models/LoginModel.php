<?php
require_once __DIR__ . '/BaseModel.php';

class LoginModel extends BaseModel {
    // Kiểm tra thông tin đăng nhập
    public function login($email, $password)
    {
        $sql = "SELECT * FROM account WHERE email = :email AND password = :password";
        return $this->fetchOne($sql, [
            ':email' => $email,
            ':password' => $password
        ]);
    }

    // Đăng ký người dùng mới
    public function register($fullname,$email, $phone, $password,$role)
    {
        $sql = "INSERT INTO account (fullname, email, phone, role, password) VALUES (:fullname, :email, :phone, :role, :password)";
        return $this->query($sql, [
            ':fullname' => $fullname,
            ':email' => $email,
            ':phone' => $phone,
            ':role' => $role,
            ':password' => $password
        ]);
    }
}
?>