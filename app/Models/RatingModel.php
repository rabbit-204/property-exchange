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
    function getListReview(){
        $sql= "SELECT * 
                FROM rating r join account a on r.id_user = a.id
                WHERE r.rating IN (4, 5)
                LIMIT 20;
                ";
        return $this->fetchAll($sql,[]);

    }
    function getAverage(){
        $sql= "SELECT ROUND(AVG(rating), 1) AS average_rating FROM rating;";
        return $this->fetchOne($sql,[]);
    }
    function getCountRating(){
        $sql= "SELECT count(rating) AS count_rating FROM rating;";
        return $this->fetchOne($sql,[]);
    }
}
?>