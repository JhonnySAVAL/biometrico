<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/PermisosModel.php';

class PermisosController extends BaseController
{
    private $permisosModel;

    public function __construct()
    {
        $this->permisosModel = new Permisos();
    }
    public function listarPermisos()
    {
        $permisos = $this->permisosModel->obtenerPermisos();
        $this->loadView('Asistencias.Permisos', ['permisos' => $permisos]);
    }
    public function solicitarPermiso($idEmpleado, $fechaInicio, $fechaFin, $motivo)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->permisosModel->insertarPermiso($idEmpleado, $fechaInicio, $fechaFin, $motivo);
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


}

if (isset($_GET['action'])) {
    $controller = new PermisosController();
    $action = $_GET['action'];
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($idEmpleado);
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
