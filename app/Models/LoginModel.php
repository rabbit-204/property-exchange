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
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM account WHERE email = :email";
        return $this->fetchOne($sql, [':email' => $email]);
    }

    public function saveResetToken($email, $token, $expiry)
    {
        // Check if a token already exists for this user
        $sql = "SELECT * FROM password_resets WHERE email = :email";
        $existing = $this->fetchOne($sql, [':email' => $email]);
        
        if ($existing) {
            // Update existing token
            $sql = "UPDATE password_resets SET token = :token, expiry = :expiry, created_at = NOW() WHERE email = :email";
        } else {
            // Insert new token
            $sql = "INSERT INTO password_resets (email, token, expiry, created_at) VALUES (:email, :token, :expiry, NOW())";
        }
        
        return $this->query($sql, [
            ':email' => $email,
            ':token' => $token,
            ':expiry' => $expiry
        ]);
    }

    public function verifyResetToken($token)
    {
        $sql = "SELECT * FROM password_resets WHERE token = :token AND expiry > NOW() AND used = 0";
        return $this->fetchOne($sql, [':token' => $token]);
    }

    public function updatePassword($email, $password)
    {
        // Note: Password is stored as plain text as per requirement
        $sql = "UPDATE account SET password = :password WHERE email = :email";
        return $this->query($sql, [
            ':email' => $email,
            ':password' => $password
        ]);
    }

    public function invalidateResetToken($token)
    {
        $sql = "UPDATE password_resets SET used = 1 WHERE token = :token";
        return $this->query($sql, [':token' => $token]);
    }
}
?>