<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/MarcarModel/MarcarModel.php';

class MarcarController extends BaseController
{
    // Método para cargar la vista principal
    public function Marcado()
    {
        $this->loadView('Marcado.Marcado', [], [], [], 'Marcado');
    }

    public function verificarCredenciales()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener datos del formulario
        $idEmpleado = $_POST['idmarcar'] ?? null;
        $passmarcar = $_POST['passmarcar'] ?? null;

        if ($idEmpleado && $passmarcar) {
            // Instancia del modelo
            $marcarModel = new MarcarModel();
            $empleado = $marcarModel->autenticarEmpleado($idEmpleado, $passmarcar);

            if ($empleado) {
                // Si las credenciales son válidas, guardar datos en sesión
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['idEmpleado'] = $empleado['idEmpleado'];
                $_SESSION['nombres'] = $empleado['nombres'];
                $_SESSION['apellidos'] = $empleado['apellidos'];
                $_SESSION['correo'] = $empleado['correo'];
                $_SESSION['idPuesto'] = $empleado['idPuesto'];
                $_SESSION['idTurno'] = $empleado['idTurno'];

                // Redirigir a la vista de marcado
                header("Location: /biometrico/sistema/controller/MarcarController/MarcadoVistaController.php?action=MarcadoVista");
                exit();
            } else {
                // Si las credenciales no son válidas
                echo "Error: Credenciales incorrectas o usuario no habilitado.";
            }
        } else {
            echo "Error: Debe proporcionar ID y contraseña.";
        }
    }
}
    
}

// Ejecutar el controlador si la acción está definida
if (isset($_GET['action'])) {
    $controller = new MarcarController();
    $action = $_GET['action'];

    // Llamar a la acción correspondiente del controlador
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
