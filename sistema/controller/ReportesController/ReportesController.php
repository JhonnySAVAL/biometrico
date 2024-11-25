<?php
require_once '../BaseController.php';
require_once '../../model/ReportesModel/ReportesModel.php';

class ReportesController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Reportes();
    }
    public function mostrarReportes() {

        $this->loadView('Reportes.Reportes', [

        ], [], [
            //'/biometrico/sistema/view/Reportes/recursos/js/Reportes.min.js'
        ], 'Gestión de Reportes');
    }
    
    public function generarReporteTabla()
{
    $tipo = $_GET['tipo'] ?? null;
    $fechas = json_decode($_GET['fechas'] ?? '[]', true);

    if (!$tipo || empty($fechas)) {
        $this->loadView('Reportes.Tabla', [
            'error' => 'No se seleccionaron fechas o tipo de reporte.',
            'datos' => []
        ]);
        return;
    }

    if (!method_exists($this->model, "obtener" . ucfirst($tipo))) {
        $this->loadView('Reportes.Tabla', [
            'error' => 'Tipo de reporte no válido.',
            'datos' => []
        ]);
        return;
    }

    $metodo = "obtener" . ucfirst($tipo);
    $datos = $this->model->$metodo($fechas);

    $this->loadView('Reportes.Tabla', [
        'error' => null,
        'tipo' => $tipo,
        'datos' => $datos
    ]);
}


    
    

    
}
     

if (isset($_GET['action'])) {
    $controller = new ReportesController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo json_encode(['error' => 'Acción no válida.']);
    }
}
