<?php

namespace andeh\Framework\Infrastructure\Database;

use PDO;
use PDOException;
use andeh\Framework\Infrastructure\Contract\Database\DbContextInterface;

class DbContext implements DbContextInterface {
    private string $host = "localhost";
    private string $db_name = "ticket";
    private string $username = "root";
    private string $password = "";
    private ?PDO $conn = null;

    public function __construct() {
        $this->connect();
    }

    private function connect(): void {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}

function get_db_connection(){
    $server_name    = 'localhost';
    $username       = 'root';
    $passowrd       = '';
    $db_name        = 'ticket';  

    try {
        $conn = new PDO("mysql:host=$server_name;dbname=$db_name;",$username,$passowrd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException   $e) {
        echo "connection Field : ".$e->getMessage();
    }
}


