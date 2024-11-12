<?php
require_once __DIR__ . '/../conexion.php';

class Puestos extends Database {
    public function __construct() {
        parent::__construct(); 
    }

    public function ObtenerPuestos()
    {
        $sql = "SELECT * FROM puestos ORDER BY nombrePuesto ASC"; 
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertarPuesto($nombrePuesto, $area, $descripcion) {
        $sql = "INSERT INTO puestos (nombrePuesto, area, descripcion) 
                VALUES (:nombrePuesto, :area, :descripcion)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombrePuesto', $nombrePuesto);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':descripcion', $descripcion);
        
        $stmt->execute();
    }   
    public function ActualizarPuesto($idPuesto, $nombrePuesto, $area, $descripcion) {
        $sql = "UPDATE puestos SET nombrePuesto = ?, area = ?, descripcion = ? WHERE idPuesto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nombrePuesto, $area, $descripcion, $idPuesto]);
    }
    
    public function EliminarPuesto($idPuesto) {
        if (empty($idPuesto) || !is_numeric($idPuesto)) {
            throw new Exception("ID del puesto no válido.");
        }
        
        $sql = "DELETE FROM puestos WHERE idPuesto = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt->execute([$idPuesto])) {
            return true;
        } else {
            throw new Exception("Error al eliminar el puesto.");
        }
    }
    
    public function VerificarUsuariosPorPuesto($idPuesto) {
        // Validación de idPuesto antes de la consulta
        if (empty($idPuesto) || !is_numeric($idPuesto)) {
            return [];  // Si el id no es válido, devolvemos un array vacío
        }
    
        $sql = "SELECT dni, CONCAT(nombres, ' ', apellidos) AS nombre FROM empleados WHERE idPuesto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idPuesto]);
    
        // Devolver los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    


}
?>

