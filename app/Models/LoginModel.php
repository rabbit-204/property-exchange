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
    public function register($fullname, $email, $phone, $password, $role)
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

    // public function updatePassword($email, $password)
    // {
    //     $sql = "UPDATE account SET password = :password WHERE email = :email";
    //     return $this->query($sql, [
    //         ':email' => $email,
    //         ':password' => $password
    //     ]);
    // }
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM account WHERE email = :email";
        return $this->fetchOne($sql, [':email' => $email]);
    }

    public function saveResetCode($email, $resetCode, $expiry)
    {
        // Check if a code already exists for this user
        $sql = "SELECT * FROM password_resets WHERE email = :email";
        $existing = $this->fetchOne($sql, [':email' => $email]);
        
        if ($existing) {
            // Update existing code
            $sql = "UPDATE password_resets SET token = :resetCode, expiry = :expiry, created_at = NOW(), used = 0 WHERE email = :email";
        } else {
            // Insert new code
            $sql = "INSERT INTO password_resets (email, token, expiry, created_at, used) VALUES (:email, :resetCode, :expiry, NOW(), 0)";
        }
        
        return $this->query($sql, [
            ':email' => $email,
            ':resetCode' => $resetCode,
            ':expiry' => $expiry
        ]);
    }

    public function verifyResetCode($email, $resetCode)
    {
        $sql = "SELECT * FROM password_resets WHERE email = :email AND token = :resetCode AND expiry > NOW() AND used = 0";
        return $this->fetchOne($sql, [
            ':email' => $email,
            ':resetCode' => $resetCode
        ]);
    }


    public function invalidateResetCode($email)
    {
        $sql = "UPDATE password_resets SET used = 1 WHERE email = :email";
        return $this->query($sql, [':email' => $email]);
    }
    
    // For backward compatibility - can be used to verify old tokens
    public function verifyResetToken($token)
    {
        $sql = "SELECT * FROM password_resets WHERE token = :token AND expiry > NOW() AND used = 0";
        return $this->fetchOne($sql, [':token' => $token]);
    }
    
    // For backward compatibility - can be used to invalidate old tokens
    public function invalidateResetToken($token)
    {
        $sql = "UPDATE password_resets SET used = 1 WHERE token = :token";
        return $this->query($sql, [':token' => $token]);
    }
}
?>
