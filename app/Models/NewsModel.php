<?php
require_once __DIR__ . '/BaseModel.php';

class NewsModel extends BaseModel
{
    // Khởi tạo
    public function getAllNews()
    {
        $sql = "SELECT * FROM news";
        return $this->fetchAll($sql);
    }
    ////
    public function getNewsById($id)
    {
        $sql = "SELECT * FROM news WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }
    // xóa tin tức
    public function deleteNews($id)
    {
        $sql = "DELETE FROM news WHERE id = ?";
        return $this->query($sql, [$id]);
    }

    // tìm kiếm tin tức
    public function filterNews($keyword, $limit, $offset, $order = 'DESC')
    {
        $sql = "SELECT * FROM news WHERE 1=1";
        $params = [];

        if ($keyword) {
            $sql .= " AND (id LIKE ? OR title LIKE ? OR description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $order = strtoupper($order);
        $sql .= " ORDER BY created_at " . ($order === 'ASC' ? 'ASC' : 'DESC');
        $sql .= " LIMIT " . (int) $limit . " OFFSET " . (int) $offset;

        return $this->fetchAll($sql, $params);
    }

    // Đếm sô tin tức tìm kiếm 
    public function countFilteredNews($keyword)
    {
        $sql = "SELECT COUNT(*) as total FROM news WHERE 1=1";
        $params = [];

        if ($keyword) {
            $sql .= " AND (id LIKE ? OR title LIKE ? OR description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        return $this->fetchOne($sql, $params)['total'];
    }

    // thêm tin tức
    public function insertNews($data)
    {
        $sql = "INSERT INTO news (title, description, image, created_at) 
            VALUES (?, ?, ?, NOW())";

        $params = [
            $data['title'],
            $data['description'],
            $data['image']
        ];

        return $this->query($sql, $params);
    }
    // Sắp xếp tin tức theo ngày đăng
    public function getSortedNewsByDate($order = 'DESC')
    {
        $order = strtoupper($order);
        if (!in_array($order, ['ASC', 'DESC'])) {
            $order = 'DESC'; // Mặc định: tin mới nhất lên đầu
        }

        $sql = "SELECT * FROM news ORDER BY created_at $order";
        return $this->fetchAll($sql);
    }

    // cập nhập tin tức
    public function updateNews($id, $data)
    {
        $params = [];
        $setStatements = [];

        // Chỉ cho phép update 3 trường (title, description, image)
        $allowedFields = ['title', 'description', 'image'];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields)) {
                $setStatements[] = "$key = ?";
                $params[] = $value;
            }
        }

        // Tự động cập nhật created_at = NOW()
        $setStatements[] = "created_at = NOW()";

        // Thêm id vào cuối để gắn vào WHERE
        $params[] = $id;

        $sql = "UPDATE news SET " . implode(", ", $setStatements) . " WHERE id = ?";

        return $this->query($sql, $params);
    }
}