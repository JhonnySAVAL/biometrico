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
    // Obtener los feriados de un año específico
public function obtenerFeriadosPorAnio($anio) {
    $sql = "SELECT * FROM feriados WHERE anio = :anio ORDER BY fecha";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Método para obtener todos los años de feriados disponibles
public function obtenerAniosDisponibles() {
    $sql = "SELECT DISTINCT anio FROM feriados ORDER BY anio DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function crearFeriado($nombre, $fecha, $tipo, $anio) {
        $sql = "INSERT INTO feriados (nombre, fecha, tipo, anio) VALUES (:nombre, :fecha, :tipo, :anio)";
        $stmt = $this->conn->prepare($sql);
        
        // Asegúrate de que estos valores están correctamente pasados y asignados
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':anio', $anio);
        
        // Ejecuta la consulta
        $stmt->execute();
    }
    

    // Eliminar un feriado
    public function eliminarFeriado($idFeriado) {
        $sql = "DELETE FROM feriados WHERE idFeriado = :idFeriado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idFeriado', $idFeriado);
        return $stmt->execute();
    }

    // Función para copiar feriados de un anio a otro
   
    public function copiarFeriadosDeAno($añoOrigen, $añoDestino) {
        $sql = "SELECT * FROM feriados WHERE anio = :añoOrigen";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':añoOrigen', $añoOrigen);
        $stmt->execute();
        $feriados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($feriados as $feriado) {
            $fechaOriginal = $feriado['fecha'];
            $nuevoFecha = str_replace(explode('-', $fechaOriginal)[0], $añoDestino, $fechaOriginal);
     
            $sqlVerificar = "SELECT COUNT(*) FROM feriados WHERE fecha = :fecha AND anio = :añoDestino";
            $stmtVerificar = $this->conn->prepare($sqlVerificar);
            $stmtVerificar->bindParam(':fecha', $nuevoFecha);
            $stmtVerificar->bindParam(':añoDestino', $añoDestino);
            $stmtVerificar->execute();
            $existe = $stmtVerificar->fetchColumn();
            
            if ($existe == 0) {
                $this->crearFeriado($feriado['nombre'], $nuevoFecha, $feriado['tipo'], $añoDestino);
            }
        }
    }

 // Método para obtener un feriado por su ID
 public function obtenerFeriadoPorId($idFeriado) {
    $sql = "SELECT * FROM feriados WHERE idFeriado = :idFeriado";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idFeriado', $idFeriado, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Método para actualizar un feriado
public function actualizarFeriado($idFeriado, $nombre, $fecha, $tipo, $anio) {
    $sql = "UPDATE feriados SET nombre = :nombre, fecha = :fecha, tipo = :tipo, anio = :anio WHERE idFeriado = :idFeriado";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idFeriado', $idFeriado, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
    $stmt->execute();
}

}
?>
