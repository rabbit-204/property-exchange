<?php
require_once __DIR__ . '/BaseModel.php';

class HomepageModel extends BaseModel
{
    #region slider
    function getAllImage()
    {
        $sql = "SELECT * FROM sliders ORDER BY id";
        return $this->fetchAll($sql, []);
    }

    function deleteImage($id)
    {
        $sql = "DELETE FROM sliders WHERE id = :id ";
        return $this->query($sql, [
            ':id' => $id
        ]);
    }

    function addImage($image, $caption)
    {
        $sql = "INSERT INTO sliders (image, caption) VALUES (:image, :caption)";
        return $this->query($sql, [
            ':image' => $image,
            ':caption' => $caption,
        ]);
    }

    function updateInterval($ms)
    {
        $sql = "UPDATE slider_settings SET timeskip = :interval WHERE id = 1";
        return $this->query($sql, [':interval' => $ms]);
    }

    function getInterval()
    {
        $sql = "SELECT timeskip FROM slider_settings WHERE id = 1";
        return $this->fetchOne($sql, []);
    }

    function updateScreen($id, $caption)
    {
        $sql = "UPDATE sliders SET caption = :caption WHERE id = :id";
        $params = [
            ':caption' => $caption,
            ':id' => $id
        ];
        return $this->query($sql, $params);
    }
    #endregion

    #region card
    function getAllCard()
    {
        $sql = "SELECT * FROM homepage_province ORDER BY id";
        return $this->fetchAll($sql, []);
    }

    function deleteCard($id)
    {
        $sql = "DELETE FROM homepage_province WHERE id = :id ";
        return $this->query($sql, [
            ':id' => $id
        ]);
    }

    function addCard($name, $image, $num)
    {
        $sql = "INSERT INTO homepage_province (name, image, num) VALUES (:name ,:image, :num)";
        return $this->query($sql, [
            ':name' => $name,
            ':image' => $image,
            ':num' => $num,
        ]);
    }

    function updateCard($id, $num)
    {
        $sql = "UPDATE homepage_province SET num = :num WHERE id = :id";
        $params = [
            ':num' => $num,
            ':id' => $id
        ];
        return $this->query($sql, $params);
    }
    #endregion

    #region introduction
    function getAllIntroduction()
    {
        $sql = "SELECT * FROM list_introduction ORDER BY id";
        return $this->fetchAll($sql, []);
    }

    function deleteIntroduction($id)
    {
        $sql = "DELETE FROM list_introduction WHERE id = :id ";
        return $this->query($sql, [
            ':id' => $id
        ]);
    }

    function addIntroduction($symbol, $title, $detail)
    {
        $sql = "INSERT INTO list_introduction (symbol, title, detail) VALUES (:symbol ,:title, :detail)";
        return $this->query($sql, [
            ':symbol' => $symbol,
            ':title' => $title,
            ':detail' => $detail,
        ]);
    }

    function updateIntroduction($id, $symbol, $title, $detail)
    {
        $sql = "UPDATE list_introduction SET symbol = :symbol, title = :title, detail = :detail WHERE id = :id";
        $params = [
            ':symbol' => $symbol,
            ':title' => $title,
            ':detail' => $detail,
            ':id' => $id,
        ];
        return $this->query($sql, $params);
    }
    #endregion
}
