<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/ExoneracionesModel.php';

class ExoneracionesController extends BaseController
{
    private $exoneracionesModel;

    public function __construct()
    {
        $this->exoneracionesModel = new Exoneraciones();
    }
    public function listarExoneraciones()
    {
        $exoneraciones = $this->exoneracionesModel->obtenerExoneraciones();
        $this->loadView('Asistencias.Exoneraciones', ['exoneraciones' => $exoneraciones]);
    }
    public function solicitarExoneracion($idEmpleado, $fecha_inicio, $fecha_fin, $motivo)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->exoneracionesModel->agregarExoneracion($idEmpleado, $fecha_inicio, $fecha_fin, $motivo);
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

   
}

if (isset($_GET['action'])) {
    $controller = new ExoneracionesController();
    $action = $_GET['action'];
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($idEmpleado);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
