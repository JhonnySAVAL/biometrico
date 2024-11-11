<?php
require_once __DIR__ . '/../conexion.php';

class Asistencia extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    public function registrarAsistencia($idEmpleado, $horaEntrada)
    {
        $fechaRegistro = date('Y-m-d'); 

        $sql = "INSERT INTO asistencia (idEmpleado, fechaRegistro, horaEntrada, estado) 
                VALUES (:idEmpleado, :fechaRegistro, :horaEntrada, 'Presente')";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fechaRegistro', $fechaRegistro);
        $stmt->bindParam(':horaEntrada', $horaEntrada);
        return $stmt->execute();
    }

    public function registrarSalida($idAsistencia, $horaSalida)
    {
        $sql = "UPDATE asistencia SET horaSalida = :horaSalida, estado = 'Finalizada' WHERE idAsistencia = :idAsistencia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idAsistencia', $idAsistencia);
        $stmt->bindParam(':horaSalida', $horaSalida);
        return $stmt->execute();
    }

    public function getAsistenciasPorFecha($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND fechaRegistro = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAsistenciasPorFechaGeneral($fecha)
    {
        $sql = "SELECT a.idAsistencia, a.fechaRegistro, a.horaEntrada, a.horaSalida, a.estado, emp.nombre
                FROM asistencia a
                JOIN empleados emp ON a.idEmpleado = emp.idEmpleado
                WHERE a.fechaRegistro = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
