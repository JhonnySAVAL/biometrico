<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/ListaModel.php';

class UsuariosController extends BaseController
{
    public function MostrarUsuario()
    {
        $listaModel = new ListaModel();
        
        $empleados = $listaModel->getUsuarios();
        $puesto = $listaModel->MostrarPuestos();
        $turno = $listaModel->MostrarTurnos();

        $this->loadView('Usuarios.Lista', [
            'usuarios' => $empleados,
            'puestos' => $puesto,
            'turnos' => $turno,
        ], [], ['/biometrico/sistema/view/usuarios/js/editarEmpleados.min.js'], 'Usuarios');
    }
    public function actualizarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener datos del formulario
            $idEmpleado = $_POST['idEmpleado'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $puesto = $_POST['puesto'];
            $turno = $_POST['turno'];
            $habilitado = isset($_POST['habilitado']) ? 1 : 0;

            $listaModel = new ListaModel();

            // Llamar al modelo para agregar el usuario
            $listaModel->ActualizarEmpleado($idEmpleado, $nombres, $apellidos, $dni, $correo, $telefono, $puesto, $turno, $habilitado);

            header('Location: /biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario');
            exit();
        }
    }
}
if (isset($_GET['action'])) {
    $controller = new UsuariosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>