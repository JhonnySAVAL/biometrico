<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Asistencias.php';

class AsistenciaController extends BaseController
{
    private $asistenciasModel;

    public function __construct()
    {
        $this->asistenciasModel = new Asistencias();
    }

    public function marcarEntrada($empleadoId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->asistenciasModel->registrarEntrada($empleadoId, 'manual'); // Tipo de registro: manual
            echo json_encode(['success' => true, 'message' => 'Entrada registrada exitosamente.']);
        }
    }

    public function marcarReceso($empleadoId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->asistenciasModel->registrarReceso($empleadoId, 'manual');
            echo json_encode(['success' => true, 'message' => 'Receso registrado exitosamente.']);
        }
    }

    public function marcarSalida($empleadoId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->asistenciasModel->registrarSalida($empleadoId, 'manual');
            echo json_encode(['success' => true, 'message' => 'Salida registrada exitosamente.']);
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new AsistenciaController();
    $action = $_GET['action'];
    $empleadoId = $_POST['empleadoId'] ?? null;

    if (method_exists($controller, $action) && $empleadoId) {
        $controller->$action($empleadoId);
    } else {
        echo "Error: Acción o ID de empleado no válido.";
    }
}
?>
