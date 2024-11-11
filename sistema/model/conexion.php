<?php

class Database {
    protected $conn;

    public function __construct() {
        try {
            $host = 'localhost';  
            $dbname = 'biometrico'; 
            $username = 'root';  
            $password = ''; 

            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit(); 
        }
    }
    public function getConnection() {
        return $this->conn;
    }
}
?>
