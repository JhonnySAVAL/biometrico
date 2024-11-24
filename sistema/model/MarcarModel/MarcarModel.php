<?php

require_once __DIR__ . '/../conexion.php';

class MarcarModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
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
    public function marcarEntrada($idEmpleado)
{
    // Establecer la zona horaria de Lima, Perú
    date_default_timezone_set('America/Lima');
    
    // Obtener la hora actual
    $horaEntrada = date('H:i:s');

    // Comprobamos si ya existe una entrada para hoy
    $sql = "SELECT * FROM asistencia WHERE idEmpleado = :idEmpleado AND fecha_registro = CURDATE()";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idEmpleado', $idEmpleado);
    $stmt->execute();

    // Si no hay registro, lo insertamos
    if ($stmt->rowCount() == 0) {
        // Insertamos la entrada
        $sql = "INSERT INTO asistencia (idEmpleado, fecha_registro, hora_entrada, tipo_registro)
            VALUES (:idEmpleado, CURDATE(), :horaEntrada, 'manual')";

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

public function marcarSalida($idEmpleado)
{
    // Establecer la zona horaria de Lima, Perú
    date_default_timezone_set('America/Lima');
    
    // Obtener la hora actual
    $horaSalida = date('H:i:s');

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
        $stmt->bindParam(':horaSalida', $horaSalida);

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
