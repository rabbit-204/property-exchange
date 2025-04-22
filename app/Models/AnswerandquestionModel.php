<?php
require_once __DIR__ . '/BaseModel.php';

class AnswerandquestionModel extends BaseModel {
    // Lấy tất cả tin nhắn
    public function getMessages($id_user)
    {
        $sql = "SELECT * FROM messages WHERE id_user = :id_user ORDER BY created_at ASC";
        return $this->fetchAll($sql,[
            ':id_user' => $id_user
        ]);
    }

    // Thêm tin nhắn mới
    public function addMessage($sender, $message, $id_user)
    {
        $sql = "INSERT INTO messages (sender, message, id_user) VALUES (:sender, :message, :id_user)";
        return $this->query($sql, [
            ':sender' => $sender,
            ':message' => $message,
            ':id_user' => $id_user
        ]);
    }
}
?>