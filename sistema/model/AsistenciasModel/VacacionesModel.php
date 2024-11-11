<?php
require_once __DIR__ . '/../conexion.php';

class Vacaciones extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function getVacaciones()
    {
        $sql = "SELECT v.idVacacion, v.fechaInicio, v.fechaFin, v.motivo, v.estado, e.nombre 
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado
                WHERE v.estado = 'Aprobada'"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function getTodasLasVacaciones()
    {
        $sql = "SELECT v.idVacacion, v.fechaInicio, v.fechaFin, v.motivo, v.estado, e.nombre 
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function agregarVacacion($idEmpleado, $fechaInicio, $fechaFin, $motivo)
    {
        $sql = "INSERT INTO vacaciones (idEmpleado, fechaInicio, fechaFin, motivo, estado)
                VALUES (:idEmpleado, :fechaInicio, :fechaFin, :motivo, 'Pendiente')";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':motivo', $motivo);
        return $stmt->execute();
    }


    public function aprobarVacacion($idVacacion)
    {
        $sql = "UPDATE vacaciones SET estado = 'Aprobada' WHERE idVacacion = :idVacacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idVacacion', $idVacacion);
        return $stmt->execute();
    }


    public function rechazarVacacion($idVacacion)
    {
        $sql = "UPDATE vacaciones SET estado = 'Rechazada' WHERE idVacacion = :idVacacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idVacacion', $idVacacion);
        return $stmt->execute();
    }
}
