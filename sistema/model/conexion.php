<?php
// Asegúrate de que la clase Database esté configurada correctamente
class Database {
    protected $conn;

    public function __construct() {
        try {
            // Configura tu conexión a la base de datos (ajusta los parámetros según tu configuración)
            $host = 'localhost';  // Cambia esto si tu base de datos está en otro host
            $dbname = 'biometrico';  // Cambia esto a tu nombre de base de datos
            $username = 'root';  // Cambia esto a tu usuario de base de datos
            $password = '';  // Cambia esto a tu contraseña de base de datos, si tienes una

            // Usamos PDO para conectar a la base de datos
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Configura el modo de errores de PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit(); // Salir si la conexión falla
        }
    }
}
?>
