<?php
require_once __DIR__ . '/../conexion.php';  // Asegúrate de que la conexión esté incluida

class Turnos extends Database {
    
    public function __construct() {
        parent::__construct();
    }

    public function ObtenerTurnos() {
        $sql = "SELECT * FROM turnos ORDER BY descripcion ASC"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InsertarTurno($descripcion, $entrada, $salida, $duracion, $receso) {
        $sql = "INSERT INTO turnos (descripcion, entrada, salida, duracion, receso) 
                VALUES (:descripcion, :entrada, :salida, :duracion, :receso)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':entrada', $entrada);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':receso', $receso);
        
        $stmt->execute();
    }

    public function ActualizarTurno($idTurno, $descripcion, $entrada, $salida, $duracion, $receso) {
        $sql = "UPDATE turnos SET descripcion = ?, entrada = ?, salida = ?, duracion = ?, receso = ? WHERE idTurno = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$descripcion, $entrada, $salida, $duracion, $receso, $idTurno]);
    }

    public function EliminarTurno($idTurno) {
        if (empty($idTurno) || !is_numeric($idTurno)) {
            throw new Exception("ID del turno no válido.");
        }
        
        $sql = "DELETE FROM turnos WHERE idTurno = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt->execute([$idTurno])) {
            return true;
        } else {
            throw new Exception("Error al eliminar el turno.");
        }
    }

    //Usado por Asistencia este modelo
    public function obtenerDuracionTurno($idEmpleado) {
        $sql = "SELECT t.duracion FROM turnos t
                INNER JOIN empleados e ON e.idTurno = t.idTurno
                WHERE e.idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
        return $stmt->fetchColumn(); // Devuelve la duración del turno en horas
    }
}
?>
