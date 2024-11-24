<?php
require_once __DIR__ . '/../conexion.php';

class Justificaciones extends Database
{
    public function __construct() {
        parent::__construct();
    }

    public function obtenerJustificaciones() {
        $query = "SELECT j.*, e.dni AS dniEmpleado FROM justificaciones j 
                  INNER JOIN empleados e ON j.idEmpleado = e.id";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function crearJustificaciones($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "INSERT INTO justificaciones (idEmpleado, fecha_inicio, fecha_fin, motivo, documento) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento]);
    }

    public function actualizarJustificaciones($idJustificaciones, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "UPDATE justificaciones SET idEmpleado = ?, fecha_inicio = ?, fecha_fin = ?, motivo = ?, documento = ? 
                  WHERE idJustificaciones = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento, $idJustificaciones]);
    }

    public function eliminarJustificaciones($idJustificaciones) {
        $query = "DELETE FROM justificaciones WHERE idJustificaciones = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idJustificaciones]);
    }

    public function obtenerEmpleadoPorDni($dniEmpleado) {
        $query = "SELECT * FROM empleados WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$dniEmpleado]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
