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
            $this->db = new PDO("mysql:host={$this->servername};", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->createDatabaseFromSqlFile();

            $this->db = new PDO("mysql:host={$this->servername};dbname:$this->db", $this->username, $this->password);
        } catch (PDOException $err) {
            die("Connection failed: " . $err->getMessage());
        }
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
