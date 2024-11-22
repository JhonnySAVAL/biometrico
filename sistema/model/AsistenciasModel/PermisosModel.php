<?php
require_once __DIR__ . '/../conexion.php';

class Permisos extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    // Insertar un nuevo permiso
    public function insertarPermiso($idEmpleado, $fecha_inicio, $fecha_fin, $motivo) {
        $sql = "INSERT INTO permisos (idEmpleado, fecha_inicio, fecha_fin, motivo, estado) 
                VALUES (:idEmpleado, :fecha_inicio, :fecha_fin, :motivo, 'pendiente')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
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
        $sql = "SELECT p.idPermiso, p.idEmpleado, e.nombres, p.fecha_inicio, p.fecha_fin, p.motivo, p.estado
                FROM permisos p
                JOIN empleados e ON p.idEmpleado = e.idEmpleado
                ORDER BY p.fecha_inicio DESC";
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
