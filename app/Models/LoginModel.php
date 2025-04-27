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
    public function getPasswordByEmail($email) {
        $sql= "SELECT password FROM account WHERE email = :email";
       return $this->fetchOne($sql,[
        ':email' => $email
       ]);
    }
    public function updatePassword($email, $newPasswordHash) {
        $sql ="UPDATE account SET password = :newPasswordHash WHERE email = :email";
        return $this->query($sql,[
            ':email' => $email,
            ':newPasswordHash' => $newPasswordHash,
        ]);
    }
}
?>