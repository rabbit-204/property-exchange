<?php
require_once __DIR__ . '/BaseModel.php';

class ProductModel extends BaseModel
{
    public function getAllProducts()
    {
        $sql = "SELECT * FROM product";
        return $this->fetchAll($sql);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    public function addProduct($name, $price)
    {
        $sql = "INSERT INTO product(name, price) VALUES (?, ?)";
        $this->query($sql, [$name, $price]);
        return $this->lastInsertId();
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = ?";
        return $this->query($sql, [$id]);
    }

    public function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT * FROM product LIMIT " . (int) $limit . " OFFSET " . (int) $offset;
        return $this->fetchAll($sql);
    }

    public function getTotalProducts()
    {
        $sql = "SELECT COUNT(*) as total FROM product";
        return $this->fetchOne($sql)['total'];
    }

    public function searchProducts($keyword, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE name LIKE ? OR location LIKE ? LIMIT " . (int) $limit . " OFFSET " . (int) $offset;
        return $this->fetchAll($sql, ["%$keyword%", "%$keyword%"]);
    }

    public function countSearchProducts($keyword)
    {
        $sql = "SELECT COUNT(*) as total FROM product WHERE name LIKE ? OR location LIKE ?";
        return $this->fetchOne($sql, ["%$keyword%", "%$keyword%"])['total'];
    }


    public function filterProducts($keyword, $sellType, $city, $type, $priceRange, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE 1=1";
        $params = [];

        if ($keyword) {
            $sql .= " AND (name LIKE ? OR location LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if ($sellType) {
            $sql .= " AND sell_type = ?";
            $params[] = $sellType;
        }

        if ($city) {
            $sql .= " AND city = ?";
            $params[] = $city;
        }

        if ($type) {
            $sql .= " AND type_of_real_estate = ?";
            $params[] = $type;
        }

        if ($priceRange) {
            if ($priceRange === 'under_10m') {
                $sql .= " AND price < 10000000";
            } elseif ($priceRange === '10m_to_100m') {
                $sql .= " AND price BETWEEN 10000000 AND 100000000";
            } elseif ($priceRange === '100m_to_3b') {
                $sql .= " AND price BETWEEN 100000000 AND 3000000000";
            } elseif ($priceRange === 'above_3b') {
                $sql .= " AND price > 3000000000";
            }
        }

        $sql .= " LIMIT " . (int) $limit . " OFFSET " . (int) $offset;

        return $this->fetchAll($sql, $params);
    }

    public function countFilteredProducts($keyword, $sellType, $city, $type, $priceRange)
    {
        $sql = "SELECT COUNT(*) as total FROM product WHERE 1=1";
        $params = [];

        if ($sellType && $sellType !== 'All') {
            $sql .= " AND sell_type = ?";
            $params[] = $sellType;
        }

        if ($keyword) {
            $sql .= " AND (name LIKE ? OR location LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if ($city) {
            $sql .= " AND city = ?";
            $params[] = $city;
        }

        if ($type) {
            $sql .= " AND type_of_real_estate = ?";
            $params[] = $type;
        }

        if ($priceRange) {
            if ($priceRange === 'under_10m') {
                $sql .= " AND price < 10000000";
            } elseif ($priceRange === '10m_to_100m') {
                $sql .= " AND price BETWEEN 10000000 AND 100000000";
            } elseif ($priceRange === '100m_to_3b') {
                $sql .= " AND price BETWEEN 100000000 AND 3000000000";
            } elseif ($priceRange === 'above_3b') {
                $sql .= " AND price > 3000000000";
            }
        }

        return $this->fetchOne($sql, $params)['total'];
    }

    public function getProductsByCity($city, $excludeId)
    {
        $sql = "SELECT * FROM product WHERE city = ? AND id != ? LIMIT 3";
        return $this->fetchAll($sql, [$city, $excludeId]);
    }

    public function getRandomProducts($limit, $excludeId)
    {
        $sql = "SELECT * FROM product WHERE id != ? ORDER BY RAND() LIMIT ?";
        return $this->fetchAll($sql, [$excludeId, $limit]);
    }

    public function filterByCityAndType($city, $type, $search = null)
    {
        $sql = "SELECT * FROM product WHERE 1=1";
        $params = [];

        if ($city) {
            $sql .= " AND city = ?";
            $params[] = $city;
        }

        if ($type) {
            $sql .= " AND type_of_real_estate = ?";
            $params[] = $type;
        }

        if ($search) {
            $sql .= " AND (name LIKE ? OR location LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        return $this->fetchAll($sql, $params);
    }

    public function insertProduct($data)
    {
        $sql = "INSERT INTO product (id, name, price, bedrooms, toilets, area, location, sell_type, image, high_light, city, type_of_real_estate, agent_name, phone, floors, direction, latitude, longitude, pictures, length, width) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $data['id'],
            $data['name'],
            $data['price'],
            $data['bedrooms'],
            $data['toilets'],
            $data['area'],
            $data['location'],
            $data['sell_type'],
            $data['image'],
            $data['high_light'],
            $data['city'],
            $data['type_of_real_estate'],
            $data['agent_name'],
            $data['phone'],
            $data['floors'],
            $data['direction'],
            $data['latitude'],
            $data['longitude'],
            $data['pictures'],
            $data['length'],
            $data['width']
        ];

        return $this->query($sql, $params);
    }
    public function getSortedProducts($column = 'price', $order = 'ASC')
    {
        $sql = "SELECT * FROM product ORDER BY $column $order";
        return $this->fetchAll($sql);
    }

    public function update($id, $data)
    {
        $params = [];
        $setStatements = [];

        foreach ($data as $key => $value) {
            $setStatements[] = "$key = ?";
            $params[] = $value;
        }

        $params[] = $id;

        $sql = "UPDATE product SET " . implode(", ", $setStatements) . " WHERE id = ?";

        return $this->query($sql, $params);
    }
}