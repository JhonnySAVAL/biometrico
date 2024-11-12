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
                                e.estado
                    FROM empleados e
                    LEFT JOIN puestos p ON e.idPuesto = p.idPuesto
                    LEFT JOIN turnos t ON e.idTurno = t.idTurno";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
