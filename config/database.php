<?php

class Database
{
    private $db;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=supersuit;charset=utf8mb4';

        $this->db = new PDO($dsn, 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function inTransaction()
    {
        return $this->db->inTransaction();
    }

    public function rollBack()
    {
        return $this->db->rollBack();
    }
}
