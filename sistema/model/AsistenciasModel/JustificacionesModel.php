<?php
require_once __DIR__ . '/../conexion.php';

class Justificaciones extends Database {
        // Obtener todas las justificaciones
        public function obtenerJustificaciones() {
            $sql = "SELECT * FROM justificaciones";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    // Insertar una nueva justificación
    public function insertarJustificacion($empleadoId, $fecha, $motivo, $documento = null) {
        $sql = "INSERT INTO justificaciones (empleadoId, fecha, motivo, documento, estado) VALUES (:empleadoId, :fecha, :motivo, :documento, 'pendiente')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':empleadoId', $empleadoId);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':documento', $documento);
        $stmt->execute();
    }



    // Aprobar una justificación
    public function aprobarJustificacion($justificacionId) {
        $sql = "UPDATE justificaciones SET estado = 'aprobada' WHERE idJustificacion = :justificacionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':justificacionId', $justificacionId);
        $stmt->execute();
    }

    // Rechazar una justificación
    public function rechazarJustificacion($justificacionId) {
        $sql = "UPDATE justificaciones SET estado = 'rechazada' WHERE idJustificacion = :justificacionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':justificacionId', $justificacionId);
        $stmt->execute();
    }
}
?>
