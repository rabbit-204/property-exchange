<?php
class BaseModel
{
    protected $conn;

    public function __construct()
    {
        // Gọi loadEnv để nạp biến môi trường
        $this->loadEnv(__DIR__ . '/../.env');
        $this->connectDB();
    }

    function loadEnv($filePath)
    {
        if (!file_exists($filePath)) {
            die("Tệp .env không tồn tại!");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0)
                continue; // Bỏ qua dòng comment
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }


    protected function connectDB()
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];


        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    // Thực thi truy vấn (insert, update, delete)
    protected function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    // Lấy nhiều dòng
    protected function fetchAll($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một dòng
    protected function fetchOne($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy ID cuối cùng được insert
    protected function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
