<?php
require_once __DIR__ . '/../conexion.php';

class ListaModel extends Database
{
    public function __construct() {
        parent::__construct(); 
    }
    
    public function getUsuarios()
    {
        $sql = "SELECT e.idEmpleado, e.nombres, e.apellidos, e.dni, e.correo, e.telefono, 
                                e.idPuesto, p.nombrePuesto AS puesto, 
                                e.idTurno, t.descripcion	 AS turno, 
                                e.habilitado
                    FROM empleados e
                    LEFT JOIN puestos p ON e.idPuesto = p.idPuesto
                    LEFT JOIN turnos t ON e.idTurno = t.idTurno";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function MostrarPuestos()
    {
        $sql = "SELECT * FROM puestos ORDER BY nombrePuesto ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function MostrarTurnos()
    {
        $sql = "SELECT * FROM turnos ORDER BY descripcion ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ActualizarEmpleado($idEmpleado, $nombres, $apellidos, $dni, $correo, $telefono, $idPuesto, $idTurno, $habilitado) {
        try {
            // Ya se reciben los ids directamente, no es necesario hacer otra consulta
            $sql = "UPDATE empleados 
                    SET nombres = :nombres, apellidos = :apellidos, dni = :dni, correo = :correo, telefono = :telefono, 
                        idPuesto = :idPuesto, idTurno = :idTurno, habilitado = :habilitado 
                    WHERE idEmpleado = :idEmpleado";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':idPuesto', $idPuesto);
            $stmt->bindParam(':idTurno', $idTurno);
            $stmt->bindParam(':habilitado', $habilitado);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
    
            // Ejecutar la actualización
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado: " . $e->getMessage());
            return false;
        }
    }
    
}
