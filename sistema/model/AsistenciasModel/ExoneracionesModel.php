<?php
require_once __DIR__ . '/../conexion.php';

class Exoneraciones extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function getExoneracionesAprobadas()
    {
        $sql = "SELECT e.idExoneracion, e.fechaInicio, e.fechaFin, e.motivo, e.estado, emp.nombre
                FROM exoneraciones e
                JOIN empleados emp ON e.idEmpleado = emp.idEmpleado
                WHERE e.estado = 'Aprobada'"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodasLasExoneraciones()
    {
        $sql = "SELECT e.idExoneracion, e.fechaInicio, e.fechaFin, e.motivo, e.estado, emp.nombre
                FROM exoneraciones e
                JOIN empleados emp ON e.idEmpleado = emp.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarExoneracion($idEmpleado, $fechaInicio, $fechaFin, $motivo)
    {
        $sql = "INSERT INTO exoneraciones (idEmpleado, fechaInicio, fechaFin, motivo, estado)
                VALUES (:idEmpleado, :fechaInicio, :fechaFin, :motivo, 'Pendiente')";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':motivo', $motivo);
        return $stmt->execute();
    }

    public function aprobarExoneracion($idExoneracion)
    {
        $sql = "UPDATE exoneraciones SET estado = 'Aprobada' WHERE idExoneracion = :idExoneracion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idExoneracion', $idExoneracion);
        return $stmt->execute();
    }

    public function rechazarExoneracion($idExoneracion)
    {
        $sql = "UPDATE exoneraciones SET estado = 'Rechazada' WHERE idExoneracion = :idExoneracion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idExoneracion', $idExoneracion);
        return $stmt->execute();
    }
}
