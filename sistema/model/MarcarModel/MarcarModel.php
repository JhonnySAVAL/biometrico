<?php

require_once __DIR__ . '/../conexion.php';

class MarcarModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public function tieneExoneraciones($idEmpleado)
    {
        $sql = "SELECT * FROM exoneraciones WHERE idEmpleado = :idEmpleado 
                AND fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Devuelve true si tiene exoneraciones activas
    }

    // Verificar si el empleado tiene vacaciones activas
    public function tieneVacaciones($idEmpleado)
    {
        $sql = "SELECT * FROM vacaciones WHERE idEmpleado = :idEmpleado 
                AND fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Devuelve true si tiene vacaciones activas
    }

    // Verificar si el empleado tiene permisos activos
    public function tienePermiso($idEmpleado)
    {
        $sql = "SELECT * FROM permisos WHERE idEmpleado = :idEmpleado 
                AND fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Devuelve true si tiene permisos activos
    }

    // Método para autenticar al empleado
    public function autenticarEmpleado($idmarcar, $passmarcar)
    {
        // Query para verificar las credenciales
        $sql = "SELECT idEmpleado, nombres, apellidos, correo, idPuesto, idTurno, habilitado, estado 
                FROM empleados 
                WHERE idmarcar = :idmarcar AND passmarcar = :passmarcar AND estado = 'Activo' AND habilitado = 1";

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idmarcar', $idmarcar);
        $stmt->bindParam(':passmarcar', $passmarcar);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se encuentra al empleado
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retornar los datos del empleado si es exitoso
        } else {
            return false; // No se encontró el empleado o las credenciales no coinciden
        }
    }

    // Marcar entrada
    public function marcarEntrada($idEmpleado)
{
    // Verificamos si el empleado tiene exoneraciones, vacaciones o permisos activos
    if ($this->tieneExoneraciones($idEmpleado) || $this->tieneVacaciones($idEmpleado) || $this->tienePermiso($idEmpleado)) {
        return ['success' => false, 'message' => 'No puedes marcar la entrada, tienes exoneración, vacaciones o permisos activos.'];
    }

    // Obtener el turno del empleado (hora de entrada)
    $sqlTurno = "SELECT t.entrada
                 FROM turnos t 
                 JOIN empleados e ON e.idTurno = t.idTurno 
                 WHERE e.idEmpleado = :idEmpleado";
    $stmtTurno = $this->conn->prepare($sqlTurno);
    $stmtTurno->bindParam(':idEmpleado', $idEmpleado);
    $stmtTurno->execute();

    // Verificar si se encontró el turno
    if ($stmtTurno->rowCount() == 0) {
        return ['success' => false, 'message' => 'No se encontró el turno del empleado.'];
    }

    // Obtener la hora de entrada del turno
    $turno = $stmtTurno->fetch(PDO::FETCH_ASSOC);
    $horaEntradaTurno = $turno['entrada'];

    // Establecer la zona horaria de Lima, Perú
    date_default_timezone_set('America/Lima');
    
    // Obtener la hora actual
    $horaEntrada = date('H:i:s');

    // Comparar la hora actual con la hora de entrada del turno
    if ($horaEntrada < $horaEntradaTurno) {
        return ['success' => false, 'message' => 'No puedes marcar la entrada antes de la hora de entrada establecida en tu turno.'];
    }

    // Comprobamos si ya existe una entrada para hoy
    $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND fecha_registro = CURDATE()";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idEmpleado', $idEmpleado);
    $stmt->execute();

    // Si no hay registro, lo insertamos
    if ($stmt->rowCount() == 0) {
        // Insertamos la entrada
        $sql = "INSERT INTO asistencia (idEmpleado, fecha_registro, hora_entrada, tipo_registro)
                VALUES (:idEmpleado, CURDATE(), :horaEntrada, 'automatica')";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':horaEntrada', $horaEntrada);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Entrada marcada correctamente.'];
        } else {
            return ['success' => false, 'message' => 'Hubo un error al marcar la entrada.'];
        }
    } else {
        // Si ya hay un registro de entrada para hoy
        return ['success' => false, 'message' => 'Ya has marcado tu entrada hoy.'];
    }
}

    // Marcar salida
    public function marcarSalida($idEmpleado)
{
    // Verificamos si el empleado tiene exoneraciones, vacaciones o permisos activos
    if ($this->tieneExoneraciones($idEmpleado)) {
        return ['success' => false, 'message' => 'No puedes marcar la salida, tienes exoneración, vacaciones o permisos activos.'];
    }

    // Obtener el turno del empleado (hora de salida)
    $sqlTurno = "SELECT t.salida
                 FROM turnos t 
                 JOIN empleados e ON e.idTurno = t.idTurno 
                 WHERE e.idEmpleado = :idEmpleado";
    $stmtTurno = $this->conn->prepare($sqlTurno);
    $stmtTurno->bindParam(':idEmpleado', $idEmpleado);
    $stmtTurno->execute();

    // Verificar si se encontró el turno
    if ($stmtTurno->rowCount() == 0) {
        return ['success' => false, 'message' => 'No se encontró el turno del empleado.'];
    }

    // Obtener la hora de salida del turno
    $turno = $stmtTurno->fetch(PDO::FETCH_ASSOC);
    $horaSalidaTurno = $turno['salida'];

    // Establecer la zona horaria de Lima, Perú
    date_default_timezone_set('America/Lima');
    
    // Obtener la hora actual
    $horaActual = date('H:i:s');

    // Comparar la hora actual con la hora de salida del turno
    if ($horaActual < $horaSalidaTurno) {
        return ['success' => false, 'message' => 'No puedes marcar la salida antes de la hora de salida establecida en tu turno.'];
    }

    // Verificar si se intenta marcar la salida 10 minutos antes de la hora de salida
    $horaSalidaDate = new DateTime($horaSalidaTurno);
    $horaActualDate = new DateTime($horaActual);
    $intervalo = $horaSalidaDate->diff($horaActualDate);
    
    // Si intentan marcar la salida antes de 10 minutos de la hora de salida
    if ($intervalo->i < 10 && $intervalo->h == 0) {
        return ['success' => false, 'message' => 'No puedes marcar la salida antes de 10 minutos de la hora establecida.'];
    }

    // Comprobamos si ya existe un registro de entrada para hoy
    $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND fecha_registro = CURDATE() AND hora_entrada IS NOT NULL";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idEmpleado', $idEmpleado);
    $stmt->execute();

    // Si ya existe una entrada, actualizamos la hora de salida
    if ($stmt->rowCount() > 0) {
        // Actualizamos la salida
        $sql = "UPDATE asistencia 
            SET hora_salida = :horaSalida 
            WHERE idEmpleado = :idEmpleado AND fecha_registro = CURDATE()";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':horaSalida', $horaActual);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Salida marcada correctamente.'];
        } else {
            return ['success' => false, 'message' => 'Hubo un error al marcar la salida.'];
        }
    } else {
        // Si no hay registro de entrada para hoy
        return ['success' => false, 'message' => 'No puedes marcar salida sin haber marcado entrada.'];
    }
}
}
