<?php
require_once __DIR__ . '/../conexion.php';

class Permisos extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function obtenerPermisos() {
        $query = "SELECT 
                      p.idPermiso, 
                      p.fecha_inicio, 
                      p.fecha_fin, 
                      p.motivo, 
                      p.documento, 
                      e.dni AS dniEmpleado, 
                      CONCAT(e.nombres, ' ', e.apellidos) AS nombreEmpleado
                  FROM permisos p
                  INNER JOIN empleados e ON p.idEmpleado = e.idEmpleado";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerEmpleadoPorDni($dniEmpleado) {
        $query = "SELECT * FROM empleados WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$dniEmpleado]);
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$empleado) {
            throw new Exception("No se encontró un empleado con el DNI $dniEmpleado");
        }
    
        return $empleado;
    }

    public function crearPermisos($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "INSERT INTO permisos (idEmpleado, fecha_inicio, fecha_fin, motivo, documento) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento]);
    }

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
