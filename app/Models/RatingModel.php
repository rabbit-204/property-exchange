<?php
require_once __DIR__ . '/BaseModel.php';

class RatingModel extends BaseModel {
    // Lấy tất cả tin nhắn
    function submitRating($id_user, $rating, $message, $name_user)
    {
        $sql = "CALL InsertOrUpdateRating(:rating, :message, :id_user, :name_user)";
        return $this->query($sql,[
            ':rating' => $rating,
            ':message' => $message,
            ':id_user' => $id_user,
            ':name_user' => $name_user
        ]);
    }
}
?>