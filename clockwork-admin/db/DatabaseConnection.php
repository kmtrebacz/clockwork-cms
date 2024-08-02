<?php

class DatabaseConnection {
    private string $servername;
    private string $username;
    private string $password;
    private string $database;
    private ?PDO $db;
    private string $dsn;

    public function __construct(array $config) {
        $this->servername = $config['servername'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
    }

    public function connect(): void {
        $this->dsn = "mysql:host={$this->servername};dbname={$this->database}";

        try {
            $this->db = new PDO($this->dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function query(string $sql, array $params = [], bool $returningArray = false): ?array {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
        } catch (PDOException $e) {
            die("Preparing the query failed: " . $e->getMessage());
        }

        if ($stmt->rowCount() > 0) {
            if ($returningArray) return $stmt->fetch(PDO::FETCH_ASSOC);
            else return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}
