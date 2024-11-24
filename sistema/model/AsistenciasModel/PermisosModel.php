<?php
require_once __DIR__ . '/../conexion.php';

class Permisos extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    
    // Obtener todos los permisos
    public function obtenerPermisos() {
        $query = "SELECT * FROM permisos";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un permiso específico
    public function obtenerEmpleadoPorDni($dni) {
        $query = "SELECT * FROM empleados WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$dni]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Crear un permiso
    public function crearPermisos($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "INSERT INTO permisos (idEmpleado, fecha_inicio, fecha_fin, motivo, documento) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento]);
    }

    // Actualizar un permiso
    public function actualizarPermisos($idPermiso, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "UPDATE permisos SET idEmpleado = ?, fecha_inicio = ?, fecha_fin = ?, motivo = ?, documento = ? WHERE idPermiso = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento, $idPermiso]);
    }

    // Eliminar un permiso
    public function eliminarPermisos($idPermiso) {
        $query = "DELETE FROM permisos WHERE idPermiso = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idPermiso]);
    }

    
}
?>
