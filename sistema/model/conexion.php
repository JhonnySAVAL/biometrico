<?php
    class Database {
        private $host = 'localhost';
        private $dbname = 'biometrico';
        private $username = 'root';
        private $password = '';
        public $conn;
    
        public function connect() {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
                return null;
            }
        }
    }
    $database = new Database();
    $conn = $database->connect();
?>