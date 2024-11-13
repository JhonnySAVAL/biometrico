<?php
require_once __DIR__ . '/../conexion.php';

class Asistencias extends Database {

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
