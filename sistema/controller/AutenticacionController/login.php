<?php
require_once '../BaseController.php';
include('../../model/conexion.php'); 
session_start();

if ($conn === null) {
    die('Error de conexión a la base de datos.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $dni = $_POST['dni'];

    $sql = "SELECT * FROM usuarios WHERE DNI = :dni AND nombre = :usuario LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: /biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard");
        exit();
    } else {
        echo "Nombre de usuario o DNI incorrectos.";
    }
}
?>
