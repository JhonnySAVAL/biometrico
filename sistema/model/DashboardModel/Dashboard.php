<?php
require_once __DIR__ . '/../conexion.php';  

class Dashboard extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function obtenerEstadoAsistencias()
    {
        $sql = "
                SELECT 
                    e.idEmpleado,
                    e.nombres,
                    e.apellidos,
                    e.dni,
                    p.nombrePuesto AS puesto,
                    t.descripcion AS turno,
                    t.entrada AS hora_entrada_turno,
                    t.salida AS hora_salida_turno,
                    IFNULL(a.estado, 'Sin acciones') AS estado,
                    IFNULL(a.hora_entrada, 'Sin datos') AS hora_entrada,
                    IFNULL(a.hora_receso, 'Sin datos') AS hora_receso,
                    IFNULL(a.hora_receso_final, 'Sin datos') AS hora_receso_final,
                    IFNULL(a.hora_salida, 'Sin datos') AS hora_salida
                FROM 
                    empleados e
                LEFT JOIN 
                    asistencia a ON e.idEmpleado = a.idEmpleado AND DATE(a.fecha_registro) = CURDATE()
                LEFT JOIN 
                    puestos p ON e.idPuesto = p.idPuesto
                LEFT JOIN 
                    turnos t ON e.idTurno = t.idTurno
                WHERE 
                    e.estado = 'Activo';
            ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
