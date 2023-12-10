<?php


class Db
{
    private static $instance = null;
    private PDOStatement $stmt;
    private $conn;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __construct()
    {
    }
    public function getConnection()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=numbers";
            $this->conn = new PDO($dsn, 'root', 'root', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        } catch (PDOException $e) {
            echo 'Connection Error:' . $e->getMessage();
        }
        return $this;
    }
    public function query($query, $params = [])
    {
        try {
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->execute($params);
        } catch (PDOException $e) {
            echo 'Query Error:' . $e->getMessage();
        }
        return $this;
    }

    public function find()
    {
        return $this->stmt->fetch();
    }
    public function findAll()
    {
        return $this->stmt->fetchAll();
    }
}
