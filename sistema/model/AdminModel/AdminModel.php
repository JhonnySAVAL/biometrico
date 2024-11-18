<?php
require_once __DIR__ . '/../conexion.php';

class AdminModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // Método para insertar un nuevo administrador
    public function insertAdmin($nombres, $apellidos, $dni, $usergen, $passgen)
    {
        // Consulta SQL para insertar los datos
        $query = "INSERT INTO admins (nombres, apellidos, dni, usergen, passgen) 
                VALUES (:nombres, :apellidos, :dni, :usergen, :passgen)";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular los parámetros
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':usergen', $usergen);
        $stmt->bindParam(':passgen', $passgen);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Si la inserción fue exitosa
        } else {
            return false; // Si hubo un error en la inserción
        }
    }
}
