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
    public function generarReporteGeneral()
    {
        $reporteGeneral = $this->reportesModel->obtenerReporteGeneral();
        $this->loadView('Asistencias.reporte_general', ['reporteGeneral' => $reporteGeneral]);
    }
    // Reporte de asistencia de un empleado específico
    public function verAsistencia($empleadoId)
    {
        $asistencia = $this->reportesModel->obtenerAsistenciaEmpleado($empleadoId);
        $this->loadView('Asistencias.reporte_asistencia', ['asistencia' => $asistencia]);
    }

    // Reporte de permisos de un empleado específico
    public function verPermisos($empleadoId)
    {
        $permisos = $this->reportesModel->obtenerPermisosEmpleado($empleadoId);
        $this->loadView('Asistencias.reporte_permisos', ['permisos' => $permisos]);
    }

    // Reporte de tardanzas de un empleado específico
    public function verTardanzas($empleadoId)
    {
        $tardanzas = $this->reportesModel->obtenerTardanzasEmpleado($empleadoId);
        $this->loadView('Asistencias.reporte_tardanzas', ['tardanzas' => $tardanzas]);
    }

    // Reporte de justificaciones de un empleado específico
    public function verJustificaciones($empleadoId)
    {
        $justificaciones = $this->reportesModel->obtenerJustificacionesEmpleado($empleadoId);
        $this->loadView('Asistencias.reporte_justificaciones', ['justificaciones' => $justificaciones]);
    }

    // Generar reporte general de todos los empleados

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
