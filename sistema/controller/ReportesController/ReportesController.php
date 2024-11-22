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
    public function verAsistencia($idEmpleado)
    {
        $asistencia = $this->reportesModel->obtenerAsistenciaEmpleado($idEmpleado);
        $this->loadView('Asistencias.reporte_asistencia', ['asistencia' => $asistencia]);
    }

    // Reporte de permisos de un empleado específico
    public function verPermisos($idEmpleado)
    {
        $permisos = $this->reportesModel->obtenerPermisosEmpleado($idEmpleado);
        $this->loadView('Asistencias.reporte_permisos', ['permisos' => $permisos]);
    }

    // Reporte de tardanzas de un empleado específico
    public function verTardanzas($idEmpleado)
    {
        $tardanzas = $this->reportesModel->obtenerTardanzasEmpleado($idEmpleado);
        $this->loadView('Asistencias.reporte_tardanzas', ['tardanzas' => $tardanzas]);
    }

    // Reporte de justificaciones de un empleado específico
    public function verJustificaciones($idEmpleado)
    {
        $justificaciones = $this->reportesModel->obtenerJustificacionesEmpleado($idEmpleado);
        $this->loadView('Asistencias.reporte_justificaciones', ['justificaciones' => $justificaciones]);
    }

    // Generar reporte general de todos los empleados

}
if (isset($_GET['action'])) {
    $controller = new ReportesController();
    $action = $_GET['action'];
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($idEmpleado);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
