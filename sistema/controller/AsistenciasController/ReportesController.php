<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Reportes.php';

class ReportesController extends BaseController
{
    private $reportesModel;

    public function __construct()
    {
        $this->reportesModel = new Reportes();
    }

    public function generarReporteMensual($empleadoId)
    {
        $reporte = $this->reportesModel->obtenerReporteMensual($empleadoId);
        $this->loadView('asistencia.reportes', ['reporte' => $reporte]);
    }

    public function reporteHorasExtras()
    {
        $reporte = $this->reportesModel->obtenerReporteHorasExtras();
        $this->loadView('asistencia.reportes', ['reporte' => $reporte]);
    }
}

if (isset($_GET['action'])) {
    $controller = new ReportesController();
    $action = $_GET['action'];
    $empleadoId = $_POST['empleadoId'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($empleadoId);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
