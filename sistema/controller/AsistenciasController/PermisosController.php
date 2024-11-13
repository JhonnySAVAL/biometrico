<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Permisos.php';

class PermisosController extends BaseController
{
    private $permisosModel;

    public function __construct()
    {
        $this->permisosModel = new Permisos();
    }

    public function solicitarPermiso($empleadoId, $fechaInicio, $fechaFin, $motivo)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->permisosModel->insertarPermiso($empleadoId, $fechaInicio, $fechaFin, $motivo);
            echo json_encode(['success' => true, 'message' => 'Permiso solicitado exitosamente.']);
        }
    }

    public function aprobarPermiso($permisoId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->permisosModel->aprobarPermiso($permisoId);
            echo json_encode(['success' => true, 'message' => 'Permiso aprobado exitosamente.']);
        }
    }

    public function listarPermisos()
    {
        $permisos = $this->permisosModel->obtenerPermisos();
        $this->loadView('asistencia.permisos', ['permisos' => $permisos]);
    }
}

if (isset($_GET['action'])) {
    $controller = new PermisosController();
    $action = $_GET['action'];
    $empleadoId = $_POST['empleadoId'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($empleadoId);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
