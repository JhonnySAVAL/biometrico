<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/PermisosModel.php';

class PermisosController extends BaseController
{
    private $model;

    public function __construct() {
        $this->model = new Permisos();
    }

    public function MostrarPermisos() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $Permisos = $this->model->obtenerPermisos(); 

            $this->loadView(
                'Asistencias.Permisos', 
                ['Permisos' => $Permisos], 
                [], 
                [
                    '/biometrico/sistema/view/Asistencias/recursos/js/Permisos.min.js' 
                ],
                'Gestión de Permisos' 
            );
        }
    }
    public function solicitarPermiso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dniEmpleado = $_POST['dniEmpleado'] ?? null;
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $motivo = $_POST['motivo'] ?? null;
            $documento = null;
    
            // Validar que exista el empleado por DNI
            $empleado = $this->model->obtenerEmpleadoPorDni($dniEmpleado);
            if (!$empleado) {
                echo "Error: Empleado no encontrado.";
                return;
            }
    
            // Manejo del archivo subido
            if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = basename($_FILES['documento']['name']);
                $rutaDestino = __DIR__ . '/../../uploads/' . $nombreArchivo;
                if (move_uploaded_file($_FILES['documento']['tmp_name'], $rutaDestino)) {
                    $documento = '/uploads/' . $nombreArchivo;
                } else {
                    echo "Error al subir el documento.";
                    return;
                }
            }
    
            // Crear el permiso
            if ($this->model->crearPermisos($empleado['id'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
                echo "Permiso solicitado exitosamente.";
            } else {
                echo "Error al solicitar el permiso.";
            }
        } else {
            echo "Método no permitido.";
        }
    }
    
    
    public function crear($idEmpleado) {
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $motivo = $_POST['motivo'] ?? null;
        $documento = $_POST['documento'] ?? null;

        if ($this->model->crearPermisos($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento)) {
            echo "Permiso creado exitosamente.";
        } else {
            echo "Error al crear el permiso.";
        }
    }

    public function actualizar($idEmpleado) {
        $idPermiso = $_POST['idPermiso'] ?? null;
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $motivo = $_POST['motivo'] ?? null;
        $documento = $_POST['documento'] ?? null;

        if ($this->model->actualizarPermisos($idPermiso, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento)) {
            echo "Permiso actualizado exitosamente.";
        } else {
            echo "Error al actualizar el permiso.";
        }
    }

    public function eliminar($idEmpleado) {
        $idPermiso = $_POST['idPermiso'] ?? null;

        if ($this->model->eliminarPermisos($idPermiso)) {
            echo "Permiso eliminado exitosamente.";
        } else {
            echo "Error al eliminar el permiso.";
        }
    }

    public function listar() {
        $permisos = $this->model->obtenerPermisos();
        echo json_encode($permisos);
    }

}

if (isset($_GET['action'])) {
    $controller = new PermisosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
