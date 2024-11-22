<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/MarcarModel/MarcarModel.php';

class MarcarController extends BaseController
{
    public function Marcado()
    {
        // $marcadoModel = new MarcarModel();

        // Obtener los datos de usuarios, puestos y turnos desde el modelo
        // $empleados = $listaModel->getUsuarios();
        // $puesto = $listaModel->MostrarPuestos(); 
        // $turno = $listaModel->MostrarTurnos();

        // Cargar la vista con los datos
        $this->loadView('Marcado.Marcado', [
            // 'usuarios' => $empleados,
            // 'puestos' => $puesto,
            // 'turnos' => $turno,
        ], [], [], 'Marcado');
    }
}

// Ejecutar el controlador si la acción está definida
if (isset($_GET['action'])) {
    $controller = new MarcarController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
