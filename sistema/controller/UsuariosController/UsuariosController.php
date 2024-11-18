<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/ListaModel.php';

class UsuariosController extends BaseController
{
    public function MostrarUsuario()
    {
        $listaModel = new ListaModel();

        // Obtener los datos de usuarios, puestos y turnos desde el modelo
        $empleados = $listaModel->getUsuarios();
        $puesto = $listaModel->MostrarPuestos();
        $turno = $listaModel->MostrarTurnos();

        // Cargar la vista con los datos
        $this->loadView('Usuarios.Lista', [
            'usuarios' => $empleados,
            'puestos' => $puesto,
            'turnos' => $turno,
        ], [], ['/biometrico/sistema/view/Usuarios/js/editarEmpleados.min.js'], 'Usuarios');
    }

    public function actualizarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener datos del formulario
            $idEmpleado = $_POST['idEmpleado'];
            $nombres = trim($_POST['nombres']);
            $apellidos = trim($_POST['apellidos']);
            $dni = trim($_POST['dni']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $puesto = $_POST['puesto'];
            $turno = $_POST['turno'];
            $habilitado = isset($_POST['habilitado']) ? 1 : 0;

            // Validación de los datos
            if (empty($nombres) || empty($apellidos) || empty($dni) || empty($correo) || empty($puesto) || empty($turno)) {
                echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
                exit();
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
                exit();
            }

            $listaModel = new ListaModel();
            $resultado = $listaModel->ActualizarEmpleado($idEmpleado, $nombres, $apellidos, $dni, $correo, $telefono, $puesto, $turno, $habilitado);

            // Manejo del resultado de la actualización
            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Empleado actualizado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Hubo un error al actualizar el usuario.']);
            }
            exit();
        }
    }
}

// Ejecutar el controlador si la acción está definida
if (isset($_GET['action'])) {
    $controller = new UsuariosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
