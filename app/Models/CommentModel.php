<?php
require_once __DIR__ . '/BaseModel.php';

class CommentModel extends BaseModel
{
    // thêm comment
    public function insertComment($newsId, $userId, $content)
    {
        $sql = "INSERT INTO comment (news_id, user_id, content, created_at)
                VALUES (?, ?, ?, NOW())";
        return $this->query($sql, [$newsId, $userId, $content]);
    }
    /// danh sách các comment trong bài viết
    public function getCommentsByNews($newsId, $limit = 5, $offset = 0)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;

        $sql = "SELECT c.*, a.fullname 
            FROM comment c 
            JOIN account a ON c.user_id = a.id
            WHERE c.news_id = ?
            ORDER BY c.created_at DESC
            LIMIT $limit OFFSET $offset";

        return $this->fetchAll($sql, [$newsId]);
    }
    // xóa comment
    public function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE id = ?";
        return $this->query($sql, [$id]);
    }
}