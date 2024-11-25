<?php
require_once __DIR__ . '/../conexion.php';
class Reportes extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function obtenerVacaciones(array $fechas)
    {
        $placeholders = implode(',', array_fill(0, count($fechas), '?'));
        $sql = "SELECT * FROM vacaciones WHERE fecha_inicio <= ? AND fecha_fin >= ?";
        $stmt = $this->conn->prepare($sql);
    
        $resultados = [];
        foreach ($fechas as $fecha) {
            $stmt->execute([$fecha, $fecha]);
            $resultados = array_merge($resultados, $stmt->fetchAll(PDO::FETCH_ASSOC));
        }
    
        return $resultados;
    }
    

    

    public function obtenerAsistencias($fechas)
    {
        $placeholders = implode(',', array_fill(0, count($fechas), '?'));
        $sql = "SELECT 
                    idEmpleado AS Empleado,
                    DATE(fecha_registro) AS Fecha,
                    hora_entrada AS 'Hora Entrada',
                    hora_salida AS 'Hora Salida'
                FROM asistencia
                WHERE DATE(fecha_registro) IN ($placeholders)";
        
        $stmt = $this->conn->prepare($sql);
    
        foreach ($fechas as $index => $fecha) {
            $stmt->bindValue($index + 1, $fecha);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function obtenerFeriados($fechas)
    {
        $sql = "SELECT * FROM feriados WHERE fecha IN (" . implode(',', array_fill(0, count($fechas), '?')) . ")";
        $stmt = $this->conn->prepare($sql);

        foreach ($fechas as $index => $fecha) {
            $stmt->bindValue($index + 1, $fecha);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTurnos($fechas)
    {
        $sql = "SELECT t.*, e.nombres, e.apellidos 
                FROM turnos t 
                INNER JOIN empleados e ON e.idTurno = t.idTurno 
                WHERE DATE(t.fecha) IN (" . implode(',', array_fill(0, count($fechas), '?')) . ")";
        $stmt = $this->conn->prepare($sql);

        foreach ($fechas as $index => $fecha) {
            $stmt->bindValue($index + 1, $fecha);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}