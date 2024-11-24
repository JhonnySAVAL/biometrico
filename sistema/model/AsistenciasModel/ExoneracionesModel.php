<?php
require_once __DIR__ . '/../conexion.php';

class Exoneraciones extends Database {
        public function __construct() {
        parent::__construct(); 
    }
    public function obtenerExoneraciones() {
        $query = "
            SELECT 
                e.dni AS dniEmpleado, 
                CONCAT(e.nombres, ' ', e.apellidos) AS nombreEmpleado, 
                ex.fecha_inicio, 
                ex.fecha_fin, 
                ex.motivo, 
                ex.documento, 
                ex.idExoneraciones
            FROM exoneraciones ex
            INNER JOIN empleados e ON ex.idEmpleado = e.idEmpleado
        ";
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
    
    public function crearExoneraciones($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "INSERT INTO exoneraciones (idEmpleado, fecha_inicio, fecha_fin, motivo, documento) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento]);
    }

    public function actualizarExoneraciones($idExoneraciones, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento) {
        $query = "UPDATE exoneraciones SET idEmpleado = ?, fecha_inicio = ?, fecha_fin = ?, motivo = ?, documento = ? WHERE idExoneraciones = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento, $idExoneraciones]);
    }

    public function eliminarExoneraciones($idExoneraciones) {
        $query = "DELETE FROM exoneraciones WHERE idExoneraciones = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idExoneraciones]);
    }

    
}
?>

