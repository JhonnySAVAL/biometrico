<?php
require_once '../BaseController.php';
include('../../model/conexion.php'); 
session_start();
$db = new Database();
$conn = $db->getConnection();

if ($conn === null) {
    die('Error de conexión a la base de datos.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);  // Sanitización de entrada
    $dni = trim($_POST['dni']);  // Sanitización de entrada

    // Consultamos si el usuario existe en la tabla login_intentos
    $sql_attempt = "SELECT * FROM login_intentos WHERE usuario = :usuario LIMIT 1";
    $stmt_attempt = $conn->prepare($sql_attempt);
    $stmt_attempt->bindParam(':usuario', $usuario);
    $stmt_attempt->execute();
    $attempt_data = $stmt_attempt->fetch(PDO::FETCH_ASSOC);

    if ($attempt_data) {
        $intentos = $attempt_data['intentos'];
        $ultimo_intento = $attempt_data['ultimo_intento'];
        $tiempo_restante = strtotime($ultimo_intento) + 30 - time(); // 30 segundos de bloqueo

        if ($intentos >= 2 && $tiempo_restante > 0) {
            // Si el usuario ha fallado más de 2 veces y el bloqueo de 30 segundos está activo
            $_SESSION['error_message'] = 'Ha superado el límite de intentos. Espere 30 segundos antes de intentar nuevamente.';
            header('Location: /biometrico/sistema/view/login.php');
            exit();
        }
    }

    // Verificamos las credenciales del usuario
    $sql = "SELECT * FROM admin WHERE DNI = :dni AND nombre = :usuario LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Si las credenciales son correctas
        $_SESSION['usuario'] = $usuario;

        // Resetear intentos fallidos
        $sql_reset = "UPDATE login_intentos SET intentos = 0 WHERE usuario = :usuario";
        $stmt_reset = $conn->prepare($sql_reset);
        $stmt_reset->bindParam(':usuario', $usuario);
        $stmt_reset->execute();

        $_SESSION['success_message'] = 'Bienvenido al sistema.';
        header('Location: /biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard');
    } else {
        // Si las credenciales son incorrectas
        $_SESSION['error_message'] = 'Credenciales incorrectas. Por favor, intente nuevamente.';
        // Actualizar el número de intentos fallidos
        if ($attempt_data) {
            $intentos++;
            $sql_update = "UPDATE login_intentos SET intentos = :intentos, ultimo_intento = CURRENT_TIMESTAMP WHERE usuario = :usuario";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':intentos', $intentos);
            $stmt_update->bindParam(':usuario', $usuario);
            $stmt_update->execute();
        } else {
            // Si no existe el registro, lo creamos
            $sql_insert = "INSERT INTO login_intentos (usuario, intentos, ultimo_intento) VALUES (:usuario, 1, CURRENT_TIMESTAMP)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':usuario', $usuario);
            $stmt_insert->execute();
        }
        header('Location: /biometrico/sistema/view/login.php');
    }
}
?>
