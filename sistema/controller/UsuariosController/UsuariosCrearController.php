<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/AgregarUsuarioModel.php';

class AgregarUsuarioController extends BaseController
{
    // Método para cargar la vista de agregar usuario
    public function vistaAgregarUsuario()
    {
        $crearModel = new AgregarUsuarioModel();
        $puestos = $crearModel->MostrarPuestos();
        $turnos = $crearModel->MostrarTurnos();

        // Cargar la vista con datos de puestos y turnos
        $this->loadView('Usuarios.Crear', [
            'puestos' => $puestos,
            'turnos' => $turnos,
        ], [], ['/biometrico/sistema/view/usuarios/js/limpiar.min.js', '/biometrico/sistema/view/usuarios/js/alertaCrear.min.js'], 'Usuarios');
    }

    // Método para procesar la creación de un nuevo usuario
    public function agregarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener datos del formulario
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $puesto = $_POST['puesto'];
            $turno = $_POST['turno'];
            $habilitado = isset($_POST['habilitado']) ? 1 : 0;

            $crearModel = new AgregarUsuarioModel();

            // Llamar al modelo para agregar el usuario
            $exito = $crearModel->agregarUsuario($nombres, $apellidos, $dni, $correo, $telefono, $puesto, $turno, $habilitado);

            // Preparar respuesta en JSON
            header('Content-Type: application/json');
            if ($exito) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario creado exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el usuario.']);
            }
        }
    }
}
if (isset($_GET['action'])) {
    $controller = new AgregarUsuarioController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>