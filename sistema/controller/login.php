<?php
require_once 'BaseController.php';
include('../model/conexion.php'); 
session_start();

// Verificar si la conexión es exitosa
if ($conn === null) {
    die('Error de conexión a la base de datos.');
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario']; // Nombre de usuario
    $dni = $_POST['dni']; // DNI (contraseña)

    // Preparar consulta para buscar el empleado en la base de datos
    $sql = "SELECT * FROM usuarios WHERE DNI = :dni AND nombre = :usuario LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    // Verificar si el usuario y la contraseña son correctos
    if ($stmt->rowCount() > 0) {
        // Usuario encontrado, iniciar sesión
        $_SESSION['usuario'] = $usuario; // Almacenar el nombre de usuario en la sesión
        header("Location: /biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard");
        exit();
    } else {
        // Usuario o contraseña incorrectos
        echo "Nombre de usuario o DNI incorrectos.";
    }
}
?>
