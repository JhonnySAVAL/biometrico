<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Justificaciones.php';

class JustificacionesController extends BaseController
{
    private $justificacionesModel;

    public function __construct()
    {
        $this->justificacionesModel = new Justificaciones();
    }
    public function listarJustificaciones()
    {
        $justificaciones = $this->justificacionesModel->obtenerJustificaciones();
        $this->loadView('Asistencias.Justificaciones', ['justificaciones' => $justificaciones]);
    }
    public function solicitarJustificacion($empleadoId, $fecha, $motivo, $documento = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->justificacionesModel->insertarJustificacion($empleadoId, $fecha, $motivo, $documento);
            echo json_encode(['success' => true, 'message' => 'Justificación solicitada exitosamente.']);
        }
    }

    public function aprobarJustificacion($justificacionId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->justificacionesModel->aprobarJustificacion($justificacionId);
            echo json_encode(['success' => true, 'message' => 'Justificación aprobada exitosamente.']);
        }
    }

    public function rechazarJustificacion($justificacionId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->justificacionesModel->rechazarJustificacion($justificacionId);
            echo json_encode(['success' => true, 'message' => 'Justificación rechazada exitosamente.']);
        }
    }


}

if (isset($_GET['action'])) {
    $controller = new JustificacionesController();
    $action = $_GET['action'];
    $empleadoId = $_POST['empleadoId'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($empleadoId);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
