<?php
require_once __DIR__ . '/../conexion.php';

class Feriados extends Database {
    public function __construct() {
        parent::__construct(); 
    }

    // Obtener todos los feriados anuales
    public function obtenerFeriadosAnuales() {
        $sql = "SELECT * FROM feriados WHERE tipo = 'anual' ORDER BY fecha";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los feriados simples
    public function obtenerFeriadosSimples() {
        $sql = "SELECT * FROM feriados WHERE tipo = 'simple' ORDER BY fecha";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo feriado
    public function crearFeriado($nombre, $fecha, $tipo, $año) {
        $sql = "INSERT INTO feriados (nombre, fecha, tipo, año) VALUES (:nombre, :fecha, :tipo, :año)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':año', $año);
        return $stmt->execute();
    }

    // Eliminar un feriado
    public function eliminarFeriado($idFeriado) {
        $sql = "DELETE FROM feriados WHERE idFeriado = :idFeriado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idFeriado', $idFeriado);
        return $stmt->execute();
    }

    // Función para copiar feriados de un año a otro
    public function copiarFeriadosDeAno($añoOrigen, $añoDestino) {
        // Obtener feriados del año origen
        $sql = "SELECT * FROM feriados WHERE año = :añoOrigen";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':añoOrigen', $añoOrigen);
        $stmt->execute();
        $feriados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Insertar feriados en el año destino
        foreach ($feriados as $feriado) {
            $this->crearFeriado($feriado['nombre'], $feriado['fecha'], $feriado['tipo'], $añoDestino);
        }
    }
}
?>
