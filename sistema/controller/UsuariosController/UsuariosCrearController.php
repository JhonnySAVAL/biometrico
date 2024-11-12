<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/AgregarUsuarioModel.php';

class AgregarUsuarioController extends BaseController
{


    public function vistaAgregarUsuario()
    {
        $crearModel = new AgregarUsuarioModel();
        
        $empleados = $crearModel->agregarUsuario();
        $puestos = $crearModel ->MostrarPuestos();
        $turnos = $crearModel ->MostrarTurnos();
        
        $this->loadView('Usuarios.Crear', [
            'usuarios' => $empleados,
            'puestos' => $puestos,
            'turnos' => $turnos,
        ], [], [], 'Usuarios');
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