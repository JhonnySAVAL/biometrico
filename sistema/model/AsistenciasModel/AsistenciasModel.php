<?php
require_once __DIR__ . '/../conexion.php';

class Asistencias extends Database {
    public function obtenerEmpleadosSinEntradaSinPermiso($fecha)
    {
        $sql = "SELECT idEmpleado FROM empleados 
                WHERE idEmpleado NOT IN (
                    SELECT empleadoId FROM asistencia WHERE fechaRegistro = :fecha
                )
                AND idEmpleado NOT IN (
                    SELECT empleadoId FROM permisos WHERE fechaInicio <= :fecha AND fechaFin >= :fecha
                )
                AND idEmpleado NOT IN (
                    SELECT empleadoId FROM exoneraciones WHERE fecha = :fecha
                )";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerEmpleadosConEntrada($fecha) {
        $sql = "SELECT e.idEmpleado, e.nombre, 
                       CASE WHEN a.minutos_tardanza > 0 THEN 'Tardanza' ELSE 'A Tiempo' END AS estado
                FROM empleados e
                JOIN asistencia a ON e.idEmpleado = a.empleadoId
                WHERE a.fechaRegistro = :fecha AND a.horaEntrada IS NOT NULL";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener empleados que no han marcado entrada ni tienen permisos o exoneraciones
    public function obtenerEmpleadosAusentes($fecha) {
        $sql = "SELECT e.idEmpleado, e.nombre
                FROM empleados e
                WHERE e.idEmpleado NOT IN (
                    SELECT a.empleadoId
                    FROM asistencia a
                    WHERE a.fechaRegistro = :fecha AND a.horaEntrada IS NOT NULL
                )
                AND e.idEmpleado NOT IN (
                    SELECT p.empleadoId
                    FROM permisos p
                    WHERE p.fechaInicio <= :fecha AND p.fechaFin >= :fecha
                )
                AND e.idEmpleado NOT IN (
                    SELECT ex.empleadoId
                    FROM exoneraciones ex
                    WHERE ex.fecha = :fecha
                )";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener empleados que tienen una falta registrada en una fecha específica
    public function obtenerEmpleadosConFalta($fecha) {
        $sql = "SELECT e.idEmpleado, e.nombre
                FROM empleados e
                JOIN asistencia a ON e.idEmpleado = a.empleadoId
                WHERE a.fechaRegistro = :fecha AND a.estado = 'falta'";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarFalta($empleadoId)
    {
        $sql = "INSERT INTO asistencia (empleadoId, fechaRegistro, estado) VALUES (:empleadoId, CURDATE(), 'falta')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
    }
    
    // Registrar Entrada
    public function registrarEntrada($empleadoId, $tipoRegistro = 'automatica') {
        // Calcular minutos anticipados o tardanza
        $horaEntradaProgramada = $this->obtenerHoraEntradaTurno($empleadoId);
        $horaActual = date('H:i:s');
        
        $minutos_anticipados = 0;
        $minutos_tardanza = 0;
        
        if ($horaActual < $horaEntradaProgramada) {
            $minutos_anticipados = $this->calcularDiferenciaMinutos($horaActual, $horaEntradaProgramada);
        } elseif ($horaActual > $horaEntradaProgramada) {
            $minutos_tardanza = $this->calcularDiferenciaMinutos($horaEntradaProgramada, $horaActual);
        }

        $sql = "INSERT INTO asistencia (empleadoId, fechaRegistro, horaEntrada, minutos_anticipados, minutos_tardanza, tipo_registro) 
                VALUES (:empleadoId, CURDATE(), CURTIME(), :minutos_anticipados, :minutos_tardanza, :tipo_registro)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->bindParam(':minutos_anticipados', $minutos_anticipados);
        $stmt->bindParam(':minutos_tardanza', $minutos_tardanza);
        $stmt->bindParam(':tipo_registro', $tipoRegistro);
        $stmt->execute();
    }

    // Registrar Receso
    public function registrarReceso($empleadoId, $tipoRegistro = 'automatica') {
        $sql = "UPDATE asistencia SET horaReceso = CURTIME(), tipo_registro = :tipo_registro 
                WHERE empleadoId = :empleadoId AND fechaRegistro = CURDATE()";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->bindParam(':tipo_registro', $tipoRegistro);
        $stmt->execute();
    }

    // Registrar Salida
    public function registrarSalida($empleadoId, $tipoRegistro = 'automatica') {
        $sql = "UPDATE asistencia SET horaSalida = CURTIME(), tipo_registro = :tipo_registro 
                WHERE empleadoId = :empleadoId AND fechaRegistro = CURDATE()";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->bindParam(':tipo_registro', $tipoRegistro);
        $stmt->execute();
    }

    // Calcular minutos de receso
    public function calcularMinutosReceso($empleadoId) {
        $sql = "SELECT TIMESTAMPDIFF(MINUTE, horaReceso, CURTIME()) AS minutosReceso 
                FROM asistencia 
                WHERE empleadoId = :empleadoId AND fechaRegistro = CURDATE() AND horaReceso IS NOT NULL";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Verificar Entrada
    public function verificarEntrada($empleadoId) {
        $sql = "SELECT COUNT(*) FROM asistencia WHERE empleadoId = :empleadoId AND fechaRegistro = CURDATE() AND horaEntrada IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verificar Receso
    public function verificarReceso($empleadoId) {
        $sql = "SELECT COUNT(*) FROM asistencia WHERE empleadoId = :empleadoId AND fechaRegistro = CURDATE() AND horaReceso IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Obtener hora de entrada del turno del empleado
    private function obtenerHoraEntradaTurno($empleadoId) {
        $sql = "SELECT t.entrada FROM turnos t
                INNER JOIN empleados e ON e.idTurno = t.idTurno
                WHERE e.idEmpleado = :empleadoId";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->execute();
        return $stmt->fetchColumn(); // Devuelve la hora de entrada programada del turno
    }

    // Calcular diferencia en minutos entre dos horas
    private function calcularDiferenciaMinutos($horaInicio, $horaFin) {
        $inicio = new DateTime($horaInicio);
        $fin = new DateTime($horaFin);
        return $inicio->diff($fin)->i; // Retorna la diferencia en minutos
    }
}
?>
