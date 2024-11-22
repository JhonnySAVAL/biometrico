<?php
require_once __DIR__ . '/../conexion.php';
class Reportes extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function obtenerAsistenciaEmpleado($idEmpleado) {
        $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPermisosEmpleado($idEmpleado) {
        $sql = "SELECT * FROM permisos WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTardanzasEmpleado($idEmpleado) {
        $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND minutos_tardanza > 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerJustificacionesEmpleado($idEmpleado) {
        $sql = "SELECT * FROM justificaciones WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
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
                LEFT JOIN asistencia a ON e.idEmpleado = a.idEmpleado
                LEFT JOIN permisos p ON e.idEmpleado = p.idEmpleado
                LEFT JOIN justificaciones j ON e.idEmpleado = j.idEmpleado
                GROUP BY e.idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
