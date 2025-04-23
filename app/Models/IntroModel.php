<?php
require_once __DIR__ . '/BaseModel.php';

class IntroModel extends BaseModel {
    // Lấy tất cả tin nhắn
    
    function getListIntro()
    {
        $sql = "SELECT * FROM intro";
        return $this->fetchAll($sql,[]);
    }
    function getListProvince()
    {
        $sql = "SELECT * FROM list_province";
        return $this->fetchAll($sql,[]);
    }
}
?>