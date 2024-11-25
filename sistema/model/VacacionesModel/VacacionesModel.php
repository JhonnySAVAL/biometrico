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
        $sql = "SELECT 
                    e.idEmpleado, 
                    e.dni, 
                    CONCAT(e.nombres, ' ', e.apellidos) AS nombres
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
        $sql = "SELECT v.idVacacion, v.fecha_inicio, v.fecha_fin, v.motivo, e.nombres 
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar vacaciones a un empleado 
    public function asignarVacacion($idEmpleado, $fecha_inicio, $fecha_fin, $motivo) {
        if ($fecha_inicio >= $fecha_fin) {
            return false;
        }
    
        // Verificar solapamientos
        $sqlCheck = "SELECT COUNT(*) AS num FROM vacaciones 
                     WHERE idEmpleado = :idEmpleado 
                     AND NOT (:fecha_fin <= fecha_inicio OR :fecha_inicio >= fecha_fin)";
    
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bindParam(':idEmpleado', $idEmpleado);
        $stmtCheck->bindParam(':fecha_inicio', $fecha_inicio);
        $stmtCheck->bindParam(':fecha_fin', $fecha_fin);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
        if ($result['num'] > 0) {
            return false;
        }
    
        // Insertar nueva vacación si no hay solapamientos y las fechas son correctas
        $sql = "INSERT INTO vacaciones (idEmpleado, fecha_inicio, fecha_fin, motivo)
                VALUES (:idEmpleado, :fecha_inicio, :fecha_fin, :motivo)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':motivo', $motivo);
        return $stmt->execute();
    }
    

    // Editar las vacaciones de un empleado
    public function editarVacacion($idVacacion, $fecha_inicio, $fecha_fin)
    {
        $sql = "UPDATE vacaciones 
                SET fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin
                WHERE idVacacion = :idVacacion";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idVacacion', $idVacacion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        return $stmt->execute();
    }

    public function getVacacionById($idVacacion)
{
    $sql = "SELECT v.idVacacion, v.fecha_inicio, v.fecha_fin, v.motivo 
            FROM vacaciones v 
            WHERE v.idVacacion = :idVacacion";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idVacacion', $idVacacion);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Devuelve los datos de la vacación
}

}
?>
