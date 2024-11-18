<?php
require_once __DIR__ . '/../conexion.php';

class ListaModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios()
    {
        $sql = "SELECT e.idEmpleado, e.nombres, e.apellidos, e.dni, e.correo, e.telefono, 
                                e.idPuesto, p.nombrePuesto AS puesto, 
                                e.idTurno, t.descripcion AS turno, e.codigo_barras, 
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

    public function ActualizarEmpleado($idEmpleado, $nombres, $apellidos, $dni, $correo, $telefono, $idPuesto, $idTurno, $habilitado)
    {
        // Preparar la consulta SQL para actualizar el empleado
        $sql = "UPDATE empleados 
            SET nombres = ?, apellidos = ?, dni = ?, correo = ?, telefono = ?, 
                idPuesto = ?, idTurno = ?, habilitado = ? 
            WHERE idEmpleado = ?";
        $stmt = $this->conn->prepare($sql);

        // Ejecutar la actualización
        $stmt->execute([$nombres, $apellidos, $dni, $correo, $telefono, $idPuesto, $idTurno, $habilitado, $idEmpleado]);

        // Retornar si la consulta fue exitosa
        return $stmt->rowCount() > 0;  // Retorna true si al menos una fila fue actualizada
    }
}
