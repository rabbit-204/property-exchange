<?php
require_once __DIR__ . '/BaseModel.php';

class ContactModel extends BaseModel
{
    function getInfor()
    {
        $sql = "SELECT * FROM contacts ORDER BY id";
        return $this->fetchAll($sql, []);
    }
    function deleteInfo($id)
    {
        $sql = "DELETE FROM contacts WHERE id = :id ";
        return $this->query($sql, [
            ':id' => $id
        ]);
    }

    function addInfo($phone, $email, $address)
    {
        $sql = "INSERT INTO contacts (phone, email, address) VALUES (:phone, :email, :address)";
        return $this->query($sql, [
            ':phone' => $phone,
            ':email' => $email,
            ':address' => $address,
        ]);
    }

    function updateInfo($id, $phone, $email, $address)
    {
        $sql = "UPDATE contacts SET phone = :phone, email = :email, address = :address WHERE id = :id";
        $params = [
            ':phone' => $phone,
            ':email' => $email,
            ':address' => $address,
            ':id' => $id,
        ];
        return $this->query($sql, $params);
    }
}
