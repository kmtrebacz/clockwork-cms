<?php

class Database {
    private string $servername;
    private string $username;
    private string $password;
    private string $database;
    private ?PDO $db;

    public function __construct(string $servername, string $username, string $password, string $database) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
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