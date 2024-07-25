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
        try {
            $this->db = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            die("Connection failed: " . $err->getMessage());
        }

        if (!$this->databaseExists()) {
            $this->createDatabaseFromSqlFile();
        }
    }

    private function databaseExists(): bool {
        $sql = "SHOW DATABASES LIKE '{$this->database}'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function createDatabaseFromSqlFile(): void {
        $sqlFile = 'db.sql';
        $sqlContent = file_get_contents($sqlFile);
        $queries = explode(';', $sqlContent);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $stmt = $this->db->prepare($query);
                $stmt->execute();
            }
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
