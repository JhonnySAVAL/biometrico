<?php
require_once __DIR__ . '/../conexion.php';  

class Dashboard extends Database
{
    public function __construct() {
        parent::__construct(); 
    }

    public function getAsistencias()
    {
        $sql = "SELECT *
                FROM asistencia a
                JOIN empleados e ON a.idEmpleado = e.idEmpleado
                ORDER BY a.fechaRegistro DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJustificaciones()
    {
        $sql = "SELECT *
                FROM justificacion j
                JOIN empleados e ON j.idEmpleado = e.idEmpleado
                WHERE j.estado = 'Aprobada'"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVacaciones()
    {
        $sql = "SELECT *
                FROM vacaciones v
                JOIN empleados e ON v.idEmpleado = e.idEmpleado
                WHERE v.estado = 'Aprobada'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermisos()
    {
        $sql = "SELECT *
                FROM permisos p
                JOIN empleados e ON p.idEmpleado = e.idEmpleado
                WHERE p.estado = 'Aprobado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
