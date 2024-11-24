<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/MarcarModel/MarcarModel.php';

class MarcarController extends BaseController
{
    private $marcarModel;

    public function MarcadoVista()
    {
        $this->loadView('Marcado.MarcadoVista', [], [], [], 'Marcar Asistencia');
    }
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Inicia la sesión si no está iniciada
        }
        $this->marcarModel = new MarcarModel(); // Inicializamos el modelo
    }

    // Método para iniciar sesión
    public function iniciarSesion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idmarcar = $_POST['idmarcar'] ?? null;
            $passmarcar = $_POST['passmarcar'] ?? null;

            if ($idmarcar && $passmarcar) {
                // Llamar al modelo para autenticar al empleado
                $empleado = $this->marcarModel->autenticarEmpleado($idmarcar, $passmarcar);

                if ($empleado) {
                    // Guardar los datos en la sesión
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['idEmpleado'] = $empleado['idEmpleado'];
                    $_SESSION['nombres'] = $empleado['nombres'];
                    $_SESSION['apellidos'] = $empleado['apellidos'];
                    $_SESSION['correo'] = $empleado['correo'];
                    $_SESSION['idPuesto'] = $empleado['idPuesto'];
                    $_SESSION['idTurno'] = $empleado['idTurno'];

                    // Redirigir al usuario a la página de marcado
                    header("Location: /biometrico/sistema/view/Marcado/MarcadoVista.php");
                    exit();
                } else {
                    // Credenciales incorrectas
                    echo "Credenciales incorrectas o el usuario no está habilitado.";
                }
            } else {
                echo "Debe proporcionar el ID y la contraseña.";
            }
        }
    }

    // Método para marcar la entrada
    public function marcarEntrada()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $idEmpleado = $_SESSION['idEmpleado'] ?? null;

    if ($idEmpleado) {
        $resultado = $this->marcarModel->marcarEntrada($idEmpleado); // Ahora debería devolver un array

        // Comprobamos si el resultado es un array y tiene la clave 'success'
        if ($resultado['success']) {
            echo json_encode(['success' => true, 'message' => $resultado['message']]);
        } else {
            echo json_encode(['success' => false, 'message' => $resultado['message']]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: No se encontró el ID del empleado en la sesión.']);
    }
}



    // Método para marcar la salida
    public function marcarSalida()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idEmpleado = $_SESSION['idEmpleado'] ?? null;

        if ($idEmpleado) {
            $resultado = $this->marcarModel->marcarSalida($idEmpleado); // Aquí llamamos al método para marcar la salida

            if ($resultado) {
                // Enviar una respuesta de éxito para que el cliente maneje la redirección
                echo json_encode(['success' => true, 'message' => 'Salida marcada correctamente.']);
            } else {
                // Enviar un mensaje de error si ya se marcó la salida
                echo json_encode(['success' => false, 'message' => 'Ya has marcado tu salida hoy.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: No se encontró el ID del empleado en la sesión.']);
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
