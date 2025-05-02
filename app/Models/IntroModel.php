<?php
require_once __DIR__ . '/BaseModel.php';

class IntroModel extends BaseModel
{
    // Lấy tất cả tin nhắn

    function getListIntro()
    {
        $sql = "SELECT * FROM intro";
        return $this->fetchAll($sql, []);
    }
    function getListProvince()
    {
        $sql = "SELECT * FROM list_province";
        return $this->fetchAll($sql, []);
    }
    function getTitle()
    {
        $sql = "SELECT * FROM title_intro";
        return $this->fetchAll($sql, []);
    }
    function deleteProvince($id)
    {
        $sql = "DELETE FROM list_province WHERE id = :id ";
        return $this->query($sql, [
            ':id' => $id
        ]);
    }
    function addProvince($name, $thumbnail)
    {
        $sql = "INSERT INTO list_province (name, thumbnail) VALUES (:name, :thumbnail)";
        return $this->query($sql, [
            ':name' => $name,
            ':thumbnail' => $thumbnail,
        ]);
    }
    function updateProvince($id, $name, $thumbnail = null)
    {
        if ($thumbnail) {
            $sql = "UPDATE list_province SET name = :name, thumbnail = :thumbnail WHERE id = :id";
            $params = [
                ':name' => $name,
                ':thumbnail' => $thumbnail,
                ':id' => $id
            ];
        } else {
            $sql = "UPDATE list_province SET name = :name WHERE id = :id";
            $params = [
                ':name' => $name,
                ':id' => $id
            ];
        }

        return $this->query($sql, $params);
    }
}
