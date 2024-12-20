<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/DashboardModel/Dashboard.php';
require_once __DIR__ . '/../../model/AsistenciasModel/AsistenciasModel.php';

class DashboardController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Dashboard();
    }


        public function MostrarDashboard()
    {  $estadoAsistencias = $this->model->obtenerEstadoAsistencias();
        
        $this->loadView('Dashboard.Dashboard', [
            'estadoAsistencias' => $estadoAsistencias,
        ],  [],  [
            '/biometrico/sistema/view/Asistencias/recursos/js/Asistencias.min.js'
        ], 'Gestion Asistencias');
    }
}


if (isset($_GET['action'])) {
    $controller = new DashboardController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}

    

// public function showConsumible()
//     {
//         $nombre = $this->checkLogin();
//         $consumiblesRegulares = $this->model->getConsumibles(); ---Funciones que obtiene del model
//         $consumiblesCompuestos = $this->model->getConsumiblesCompuestos();---Funciones que obtiene del model
//         $categorias = $this->model->getAllCategorias();---Funciones que obtiene del model

//         $consumibles = array_merge($consumiblesRegulares, $consumiblesCompuestos); ---Combina lo obtenido en uno solo
        
//         $this->loadView('arsenal.showConsumible', [ ---carga la vista
//             'consumibles' => $consumibles, --- carga lo que fusiono
//             'categorias' => $categorias,-- carga funcion del modal
//             'nombre' => $nombre--- carga el nombre del chekclogin
//         ], [],--aca va el css adicional [
//             '/gestion/app/view/arsenal/recursos/js/showConsumible.min.js'---aca carga el JS
//         ]);
//     }

?>