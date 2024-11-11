<?php
require_once __DIR__ . '/../conexion.php';

class Turno extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function registrarTurno($descripcion, $entrada, $salida, $duracion, $receso) {
        $query = "INSERT INTO turnos (descripcion, entrada, salida, duracion, receso) 
                  VALUES (:descripcion, :entrada, :salida, :duracion, :receso)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':entrada', $entrada);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':receso', $receso);
        
        return $stmt->execute();
    }

    public function obtenerTurnos() {
        $query = "SELECT * FROM turnos";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTurnoPorId($idTurno) {
        $query = "SELECT * FROM turnos WHERE idTurno = :idTurno";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idTurno', $idTurno);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarTurno($idTurno, $descripcion, $entrada, $salida, $duracion, $receso) {
        $query = "UPDATE turnos SET descripcion = :descripcion, entrada = :entrada, salida = :salida, 
                  duracion = :duracion, receso = :receso WHERE idTurno = :idTurno";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idTurno', $idTurno);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':entrada', $entrada);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':receso', $receso);
        
        return $stmt->execute();
    }

    public function eliminarTurno($idTurno) {
        $query = "DELETE FROM turnos WHERE idTurno = :idTurno";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idTurno', $idTurno);
        
        return $stmt->execute();
    }
}
?>
