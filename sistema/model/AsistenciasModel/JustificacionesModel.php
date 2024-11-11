<?php
require_once __DIR__ . '/../conexion.php';

class Justificaciones extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function getJustificacionesAprobadas()
    {
        $sql = "SELECT j.idJustificacion, j.fechaInicio, j.fechaFin, j.motivo, j.estado, e.nombre
                FROM justificacion j
                JOIN empleados e ON j.idEmpleado = e.idEmpleado
                WHERE j.estado = 'Aprobada'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodasLasJustificaciones()
    {
        $sql = "SELECT j.idJustificacion, j.fechaInicio, j.fechaFin, j.motivo, j.estado, e.nombre
                FROM justificacion j
                JOIN empleados e ON j.idEmpleado = e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarJustificacion($idEmpleado, $fechaInicio, $fechaFin, $motivo)
    {
        $sql = "INSERT INTO justificacion (idEmpleado, fechaInicio, fechaFin, motivo, estado)
                VALUES (:idEmpleado, :fechaInicio, :fechaFin, :motivo, 'Pendiente')";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':motivo', $motivo);
        return $stmt->execute();
    }

    public function aprobarJustificacion($idJustificacion)
    {
        $sql = "UPDATE justificacion SET estado = 'Aprobada' WHERE idJustificacion = :idJustificacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idJustificacion', $idJustificacion);
        return $stmt->execute();
    }

    public function rechazarJustificacion($idJustificacion)
    {
        $sql = "UPDATE justificacion SET estado = 'Rechazada' WHERE idJustificacion = :idJustificacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idJustificacion', $idJustificacion);
        return $stmt->execute();
    }
}
