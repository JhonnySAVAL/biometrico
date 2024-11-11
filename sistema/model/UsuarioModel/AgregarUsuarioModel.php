<?php
require_once __DIR__ . '/../conexion.php';

class AgregarUsuarioModel extends Database{}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $horario = $_POST['horario'];
    $puesto = $_POST['puesto'];

    // Crear la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (DNI, nombre, apellido, horario, puesto) VALUES (:dni, :nombre, :apellido, :horario, :puesto)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':horario', $horario);
    $stmt->bindParam(':puesto', $puesto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear el usuario.";
    }
}
?>
