<?php
require_once __DIR__ . '/../conexion.php';
class Reportes extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function obtenerAsistenciaEmpleado($empleadoId) {
        $sql = "SELECT * FROM asistencia WHERE empleadoId = :empleadoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPermisosEmpleado($empleadoId) {
        $sql = "SELECT * FROM permisos WHERE empleadoId = :empleadoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTardanzasEmpleado($empleadoId) {
        $sql = "SELECT * FROM asistencia WHERE empleadoId = :empleadoId AND minutos_tardanza > 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerJustificacionesEmpleado($empleadoId) {
        $sql = "SELECT * FROM justificaciones WHERE empleadoId = :empleadoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerReporteGeneral() {
        // Unir las tablas de empleados, asistencia, permisos, etc., para obtener un reporte completo
        $sql = "SELECT e.idEmpleado, e.nombres, e.departamento, e.puesto, 
                       COUNT(a.idAsistencia) AS diasAsistidos,
                       SUM(CASE WHEN a.minutos_tardanza > 0 THEN 1 ELSE 0 END) AS tardanzas,
                       COUNT(p.idPermiso) AS permisos,
                       COUNT(j.idJustificacion) AS justificaciones
                FROM empleados e
                LEFT JOIN asistencia a ON e.idEmpleado = a.empleadoId
                LEFT JOIN permisos p ON e.idEmpleado = p.empleadoId
                LEFT JOIN justificaciones j ON e.idEmpleado = j.empleadoId
                GROUP BY e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
