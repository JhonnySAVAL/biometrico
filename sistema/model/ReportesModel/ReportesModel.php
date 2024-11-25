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
        $sql = "SELECT 
                    e.dni AS 'DNI',
                    CONCAT(e.nombres, ' ', e.apellidos) AS 'Empleado',
                    MIN(v.fecha_inicio) AS 'Fecha Inicio',
                    MAX(v.fecha_fin) AS 'Fecha Fin',
                    GROUP_CONCAT(DISTINCT v.motivo SEPARATOR ', ') AS 'Motivo'
                FROM vacaciones v
                INNER JOIN empleados e ON v.idEmpleado = e.idEmpleado
                WHERE ? BETWEEN v.fecha_inicio AND v.fecha_fin
                GROUP BY e.dni";
    
        $stmt = $this->conn->prepare($sql);
    
        $resultados = [];
        foreach ($fechas as $fecha) {
            $stmt->execute([$fecha]);
            $resultados = array_merge($resultados, $stmt->fetchAll(PDO::FETCH_ASSOC));
        }
    
        return $resultados;
    }
    
    

    public function obtenerAsistencias($fechas)
    {
        $placeholders = implode(',', array_fill(0, count($fechas), '?'));
        $sql = "SELECT 
                    e.DNI AS DNI,
                    CONCAT(e.nombres, ' ', e.apellidos) AS Empleado,
                    DATE(a.fecha_registro) AS Fecha,
                    a.hora_entrada AS 'Hora Entrada',
                    a.hora_salida AS 'Hora Salida',
                    a.horas_extras AS 'Horas Extras',
                    a.minutos_tardanza AS 'Minutos de Tardanza',
                    CASE 
                        WHEN a.estado = 'falta' THEN 'Falta'
                        ELSE 'Asistido'
                    END AS Estado
                FROM asistencia a
                INNER JOIN empleados e ON a.idEmpleado = e.idEmpleado
                WHERE DATE(a.fecha_registro) IN ($placeholders)";
        
        $stmt = $this->conn->prepare($sql);
    
        // Asignar valores a los placeholders
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

        
    public function obtenerPermisos(array $fechas)
{
    $placeholders = implode(',', array_fill(0, count($fechas), '?'));
    $sql = "SELECT 
                empleados.dni AS 'DNI',
                CONCAT(empleados.nombres, ' ', empleados.apellidos) AS 'Empleado',
                permisos.fecha_inicio AS 'Fecha Inicio',
                permisos.fecha_fin AS 'Fecha Fin',
                permisos.motivo AS 'Motivo'
            FROM permisos
            INNER JOIN empleados ON permisos.idEmpleado = empleados.idEmpleado
            WHERE DATE(permisos.fecha_inicio) IN ($placeholders)";
    $stmt = $this->conn->prepare($sql);

    foreach ($fechas as $index => $fecha) {
        $stmt->bindValue($index + 1, $fecha);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerExoneraciones(array $fechas)
{
    $placeholders = implode(',', array_fill(0, count($fechas), '?'));
    $sql = "SELECT 
                empleados.dni AS 'DNI',
                CONCAT(empleados.nombres, ' ', empleados.apellidos) AS 'Empleado',
                exoneraciones.fecha AS 'Fecha',
                exoneraciones.motivo AS 'Motivo'
            FROM exoneraciones
            INNER JOIN empleados ON exoneraciones.idEmpleado = empleados.idEmpleado
            WHERE DATE(exoneraciones.fecha) IN ($placeholders)";
    $stmt = $this->conn->prepare($sql);

    foreach ($fechas as $index => $fecha) {
        $stmt->bindValue($index + 1, $fecha);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}