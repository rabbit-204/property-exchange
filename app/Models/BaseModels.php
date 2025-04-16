<?php
class BaseModel {
    protected $conn;

    public function __construct() {
        $this->connectDB();
    }

    protected function connectDB() {
        $host = 'localhost';
        $dbname = 'your_database';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    // Thực thi truy vấn (insert, update, delete)
    protected function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    // Lấy nhiều dòng
    protected function fetchAll($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một dòng
    protected function fetchOne($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy ID cuối cùng được insert
    protected function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}