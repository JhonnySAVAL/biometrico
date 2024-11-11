<?php
require_once __DIR__ . '/../conexion.php';  

class Dashboard extends Database
{
    public function __construct() {
        parent::__construct(); 
    }

    public function getAsistencias()
    {
        $sql = "SELECT a.idAsistencia, a.fechaRegistro, a.horaEntrada, a.horaSalida, a.estado, e.nombre 
                FROM asistencia a
                JOIN empleados e ON a.idEmpleado = e.idEmpleado
                ORDER BY a.fechaRegistro DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJustificaciones()
    {
        $sql = "SELECT j.idJustificacion, j.fechaInicio, j.fechaFin, j.motivo, j.estado, e.nombre 
                FROM justificacion j
                JOIN empleados e ON j.idEmpleado = e.idEmpleado
                WHERE j.estado = 'Aprobada'"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVacaciones()
    {
        $sql = "SELECT v.idVacacion, v.fechaInicio, v.fechaFin, v.motivo, v.estado, e.nombre 
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado
                WHERE v.estado = 'Aprobada'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermisos()
    {
        $sql = "SELECT p.idPermiso, p.fechaInicio, p.fechaFin, p.motivo, p.estado, e.nombre 
                FROM permisos p
                JOIN empleados e ON p.idEmpleado = e.idEmpleado
                WHERE p.estado = 'Aprobado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
