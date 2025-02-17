<?php

namespace Admin\Database;

use PDO;
use PDOException;

class DatabaseConnection {
     private string $path;
     private ?PDO $db;

    public function __construct(array $config) {
        $this->path = $config['path'];
    }

    public function connect(): void {
        try {
            $this->db = new PDO("sqlite:$this->path");
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function query(string $sql, array $params = [], bool $returningArray = false) {
        try {
             $stmt = $this->db->prepare($sql);
             if (empty($params)) $stmt->execute();
             else $stmt->execute($params);
        } catch (PDOException $e) {
            die("Preparing the query failed: " . $e->getMessage());
        }

          if ($returningArray) return $stmt->fetch(PDO::FETCH_ASSOC);
          else return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
