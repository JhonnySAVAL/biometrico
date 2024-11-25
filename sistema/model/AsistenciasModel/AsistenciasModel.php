<?php
require_once __DIR__ . '/../conexion.php';

class Asistencias extends Database
{

    public function __construct()
    {
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
    // Obtener las asistencias del día de hoy
    public function obtenerAsistenciaHoy($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener el turno de un empleado
    public function obtenerTurnoEmpleado($idTurno)
    {
        $sql = "SELECT * FROM turnos WHERE idTurno = :idTurno";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idTurno', $idTurno);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   // Registrar la entrada del empleado
   public function registrarEntrada($idEmpleado, $horaEntrada, $tipo, $minutosTardanza = 0)
   {
       try {
           $sql = "INSERT INTO asistencia (idEmpleado, fecha_registro, hora_entrada, tipo_registro, estado, minutos_tardanza) 
                   VALUES (:idEmpleado, NOW(), :horaEntrada, :tipo, 'presente', :minutosTardanza)";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':idEmpleado', $idEmpleado);
           $stmt->bindParam(':horaEntrada', $horaEntrada);
           $stmt->bindParam(':tipo', $tipo);
           $stmt->bindParam(':minutosTardanza', $minutosTardanza);
           $stmt->execute();
       } catch (PDOException $e) {
           error_log("Error al registrar entrada: " . $e->getMessage());
           throw new Exception("No se pudo registrar la entrada. Intente nuevamente.");
       }
   }
   


    // Actualizar el estado del empleado (presente, tarde, etc.)
    public function actualizarEstado($idEmpleado, $estado)
    {
        $sql = "UPDATE asistencia SET estado = :estado WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
    }

    // Obtener un empleado por su DNI
    public function obtenerEmpleadoPorDNI($dni)
    {
        $sql = "SELECT * FROM empleados WHERE dni = :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Otros métodos existentes
    public function esFeriado($fecha)
    {
        $sql = "SELECT * FROM feriados WHERE fecha = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function estaDeVacaciones($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM vacaciones WHERE idEmpleado = :idEmpleado AND fecha_inicio <= :fecha AND fecha_fin >= :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tienePermiso($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM permisos WHERE idEmpleado = :idEmpleado AND fecha_inicio <= :fecha AND fecha_fin >= :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tieneExoneracion($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM exoneraciones WHERE idEmpleado = :idEmpleado AND fecha_inicio <= :fecha AND fecha_fin >= :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener el receso de hoy para un empleado
    public function obtenerRecesoHoy($idEmpleado, $fecha)
    {
        $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = :fecha AND hora_receso IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
public function registrarReceso($idEmpleado, $horaReceso)
{
    $sql = "UPDATE asistencia 
            SET hora_receso = :horaReceso, estado = 'receso' 
            WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = CURDATE()";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idEmpleado', $idEmpleado);
    $stmt->bindParam(':horaReceso', $horaReceso);
    $stmt->execute();
}


public function registrarFinReceso($idEmpleado, $horaRecesoFinal)
{
    $sql = "UPDATE asistencia 
            SET hora_receso_final = :horaRecesoFinal, estado = 'regreso'  
            WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = CURDATE() AND estado = 'receso'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idEmpleado', $idEmpleado);
    $stmt->bindParam(':horaRecesoFinal', $horaRecesoFinal);
    $stmt->execute();
}

public function registrarSalida($idEmpleado, $horaSalida, $horasExtras = 0)
{
    try {
        $sql = "UPDATE asistencia 
                SET hora_salida = :horaSalida, 
                    horas_extras = :horasExtras, 
                    estado = 'salida' 
                WHERE idEmpleado = :idEmpleado AND DATE(fecha_registro) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':horaSalida', $horaSalida);
        $stmt->bindParam(':horasExtras', $horasExtras);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al registrar salida: " . $e->getMessage());
        throw new Exception("No se pudo registrar la salida. Intente nuevamente.");
    }
}
public function calcularHorasExtras($horaEntradaReal, $horaEntradaTurno, $horaSalidaReal, $horaSalidaTurno)
{
    $horasExtras = 0;

    // Calcular horas extras por entrada anticipada
    if ($horaEntradaReal < $horaEntradaTurno) {
        $horasExtras += ($horaEntradaTurno - $horaEntradaReal) / 3600; // Convertir segundos a horas
    }

    // Calcular horas extras por salida tardía
    if ($horaSalidaReal > $horaSalidaTurno) {
        $horasExtras += ($horaSalidaReal - $horaSalidaTurno) / 3600; // Convertir segundos a horas
    }

    return $horasExtras;
}





}
