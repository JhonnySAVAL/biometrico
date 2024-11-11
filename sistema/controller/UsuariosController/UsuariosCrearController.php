<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/ListaModel.php';

class UsuariosController extends BaseController
{
    public function MostrarUsuario()
    {
        $listaModel = new ListaModel();
        
        $empleados = $listaModel->getUsuarios();

        $this->loadView('Usuarios.Lista', [
            'usuarios' => $empleados,
        ], [], [], 'Usuarios');
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