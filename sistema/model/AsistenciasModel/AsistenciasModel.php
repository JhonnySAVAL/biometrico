    <?php
    require_once __DIR__ . '/../conexion.php';

    class Asistencias extends Database {
        public function obtenerEmpleados() {
            $sql = "SELECT idEmpleado, nombres FROM empleados";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
    ?>
