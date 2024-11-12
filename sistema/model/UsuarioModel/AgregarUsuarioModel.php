<?php
require_once __DIR__ . '/../conexion.php';

class AgregarUsuarioModel extends Database{

    public function __construct() {
        parent::__construct(); 
    }

    public function agregarUsuario(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['apellido'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $puesto = $_POST['puesto'];
            $turno = $_POST['turno'];
            $habilitado = $_POST['habilitado'];
        
            $sql = "INSERT INTO usuarios (nombres, apellidos, dni, correo, telefono, idPuesto, idTurno, habilitado) 
                    VALUES (:nombres, :apellidos, :dni, :correo, :telefono, :puesto, :turno, :habilitado)";
        
            $stmt = $this->conn->prepare($sql);
        
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':puesto', $puesto);
            $stmt->bindParam(':turno', $turno);
            $stmt->bindParam(':habilitado', $habilitado);
        
            if ($stmt->execute()) {
                echo "Usuario creado exitosamente.";
            } else {
                echo "Error al crear el usuario.";
            }
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
?>
