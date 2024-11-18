<?php
require_once __DIR__ . '/../conexion.php';
class Feriados extends Database {
    public function __construct() {
        parent::__construct(); 
    }

    public function crearFeriado($nombre, $fecha, $tipo = 'simple', $año) {
        $sql = "INSERT INTO feriados (nombre, fecha, tipo, año)
                VALUES (:nombre, :fecha, :tipo, :año)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':año', $año);
        return $stmt->execute();
    }

    public function crearFeriadoAnual($nombre, $fecha) {
        $año = date('Y');
        return $this->crearFeriado($nombre, $fecha, 'anual', $año);
    }

    public function copiarFeriadosPorAno($añoOrigen, $añoDestino) {
        $sql = "INSERT INTO feriados (nombre, fecha, tipo, año)
                SELECT nombre, 
                       DATE_FORMAT(fecha, '%Y-') + :añoDestino, 
                       tipo, :añoDestino
                FROM feriados 
                WHERE año = :añoOrigen AND tipo = 'anual'";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':añoDestino', $añoDestino);
        $stmt->bindParam(':añoOrigen', $añoOrigen);
        return $stmt->execute();
    }

    public function obtenerFeriadosPorAno($año) {
        echo "Año recibido: " . $año;  
        if (empty($año)) {
            throw new Exception("El año no puede estar vacío.");
        }
        $sql = "SELECT * FROM feriados WHERE año = :año"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':año', $año); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }
    
}


?>

