<?php
require_once __DIR__ . '/../conexion.php';

class AgregarUsuarioModel extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function agregarUsuario($nombres, $apellidos, $dni, $correo, $telefono, $puesto, $turno, $habilitado)
    {
        // Obtener el id del puesto
        $sqlPuesto = "SELECT idPuesto FROM puestos WHERE nombrePuesto = :puesto";
        $stmtPuesto = $this->conn->prepare($sqlPuesto);
        $stmtPuesto->bindParam(':puesto', $puesto);
        $stmtPuesto->execute();
        $idPuesto = $stmtPuesto->fetchColumn();

        // Obtener el id del turno
        $sqlTurno = "SELECT idTurno FROM turnos WHERE descripcion = :turno";
        $stmtTurno = $this->conn->prepare($sqlTurno);
        $stmtTurno->bindParam(':turno', $turno);
        $stmtTurno->execute();
        $idTurno = $stmtTurno->fetchColumn();

        // Verificar que ambos IDs existen
        if ($idPuesto && $idTurno) {
            $sql = "INSERT INTO empleados (nombres, apellidos, dni, correo, telefono, idPuesto, idTurno, habilitado, codigo_barras) 
                    VALUES (:nombres, :apellidos, :dni, :correo, :telefono, :idPuesto, :idTurno, :habilitado, :codigo_barras)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':idPuesto', $idPuesto);
            $stmt->bindParam(':idTurno', $idTurno);
            $stmt->bindParam(':habilitado', $habilitado);
            $stmt->bindParam(':codigo_barras', $codigoBarrasRuta);

            // Ejecutar la inserción y retornar el resultado
            return $stmt->execute();
        } else {
            return false; // Error si no se encuentran IDs de puesto o turno
        }
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
}
