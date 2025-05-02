<?php
require_once __DIR__ . '/BaseModel.php';

class AnswerandquestionModel extends BaseModel
{
    // Lấy tất cả tin nhắn
    public function getMessages($id_user)
    {
        $sql = "SELECT * FROM messages WHERE id_user = :id_user ORDER BY created_at ASC";
        return $this->fetchAll($sql, [
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
    public function getListDM()
    {
        $sql = "SELECT 
                    m.id_user,
                    a.fullname,
                    m.is_read,
                    m.created_at AS latest_time
                FROM 
                    messages m
                JOIN 
                    account a ON m.id_user = a.id
                INNER JOIN (
                    SELECT 
                        id_user, 
                        MAX(created_at) AS latest_time
                    FROM 
                        messages
                    GROUP BY 
                        id_user
                ) latest ON m.id_user = latest.id_user AND m.created_at = latest.latest_time
                ORDER BY 
                    latest_time DESC;";
        return $this->fetchAll($sql);
    }
    public function markAsRead($id){
        $sql ="UPDATE messages SET is_read = 1 WHERE id_user = :id AND is_read = 0;";
        return $this->query($sql,[
            ':id' => $id,
        ]);
    }
}
