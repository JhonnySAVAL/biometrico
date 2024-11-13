<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Exoneraciones.php';

class ExoneracionesController extends BaseController
{
    private $exoneracionesModel;

    public function __construct()
    {
        $this->exoneracionesModel = new Exoneraciones();
    }

    public function solicitarExoneracion($empleadoId, $fecha, $motivo)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->exoneracionesModel->insertarExoneracion($empleadoId, $fecha, $motivo);
            echo json_encode(['success' => true, 'message' => 'Exoneración solicitada exitosamente.']);
        }
    }

    public function aprobarExoneracion($exoneracionId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->exoneracionesModel->aprobarExoneracion($exoneracionId);
            echo json_encode(['success' => true, 'message' => 'Exoneración aprobada exitosamente.']);
        }
    }

    public function listarExoneraciones()
    {
        $exoneraciones = $this->exoneracionesModel->obtenerExoneraciones();
        $this->loadView('asistencia.exoneraciones', ['exoneraciones' => $exoneraciones]);
    }
}

if (isset($_GET['action'])) {
    $controller = new ExoneracionesController();
    $action = $_GET['action'];
    $empleadoId = $_POST['empleadoId'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($empleadoId);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
