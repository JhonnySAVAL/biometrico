<?php
require_once __DIR__ . '/../conexion.php';

class Vacaciones extends Database
{
    public function __construct() {
        parent::__construct(); 
    }

    // Obtener empleados sin vacaciones programadas
    public function getEmpleadosSinVacaciones()
    {
        $sql = "SELECT e.idEmpleado, e.nombres
                FROM empleados e
                LEFT JOIN vacaciones v ON e.idEmpleado = v.idEmpleado
                WHERE v.idVacacion IS NULL";  
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas las vacaciones programadas
    public function getVacacionesProgramadas()
    {
        $sql = "SELECT v.idVacacion, v.fechaInicio, v.fechaFin, v.motivo, e.nombres 
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar vacaciones a un empleado 
    public function asignarVacacion($idEmpleado, $fechaInicio, $fechaFin, $motivo) {
        if ($fechaInicio >= $fechaFin) {
            return false;
        }
    
        // Verificar solapamientos
        $sqlCheck = "SELECT COUNT(*) AS num FROM vacaciones 
                     WHERE idEmpleado = :idEmpleado 
                     AND NOT (:fechaFin <= fechaInicio OR :fechaInicio >= fechaFin)";
    
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bindParam(':idEmpleado', $idEmpleado);
        $stmtCheck->bindParam(':fechaInicio', $fechaInicio);
        $stmtCheck->bindParam(':fechaFin', $fechaFin);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
        if ($result['num'] > 0) {
            return false;
        }
    
        // Insertar nueva vacación si no hay solapamientos y las fechas son correctas
        $sql = "INSERT INTO vacaciones (idEmpleado, fechaInicio, fechaFin, motivo)
                VALUES (:idEmpleado, :fechaInicio, :fechaFin, :motivo)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':motivo', $motivo);
        return $stmt->execute();
    }
    

    // Editar las vacaciones de un empleado
    public function editarVacacion($idVacacion, $fechaInicio, $fechaFin)
    {
        $sql = "UPDATE vacaciones 
                SET fechaInicio = :fechaInicio, fechaFin = :fechaFin
                WHERE idVacacion = :idVacacion";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idVacacion', $idVacacion);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        return $stmt->execute();
    }

    public function getVacacionById($idVacacion)
{
    $sql = "SELECT v.idVacacion, v.fechaInicio, v.fechaFin, v.motivo 
            FROM vacaciones v 
            WHERE v.idVacacion = :idVacacion";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idVacacion', $idVacacion);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Devuelve los datos de la vacación
}

}
?>
