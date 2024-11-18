<?php
require_once __DIR__ . '/../conexion.php';

class Permisos extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    // Insertar un nuevo permiso
    public function insertarPermiso($empleadoId, $fechaInicio, $fechaFin, $motivo) {
        $sql = "INSERT INTO permisos (empleadoId, fechaInicio, fechaFin, motivo, estado) 
                VALUES (:empleadoId, :fechaInicio, :fechaFin, :motivo, 'pendiente')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->execute();
    }

    // Aprobar un permiso
    public function aprobarPermiso($permisoId) {
        $sql = "UPDATE permisos SET estado = 'aprobado' WHERE idPermiso = :permisoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':permisoId', $permisoId);
        $stmt->execute();
    }

    // Obtener todos los permisos
    public function obtenerPermisos() {
        $sql = "SELECT p.idPermiso, p.empleadoId, e.nombres, p.fechaInicio, p.fechaFin, p.motivo, p.estado
                FROM permisos p
                JOIN empleados e ON p.empleadoId = e.idEmpleado
                ORDER BY p.fechaInicio DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Rechazar un permiso (Opcional)
    public function rechazarPermiso($permisoId) {
        $sql = "UPDATE permisos SET estado = 'rechazado' WHERE idPermiso = :permisoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':permisoId', $permisoId);
        $stmt->execute();
    }
}
?>
