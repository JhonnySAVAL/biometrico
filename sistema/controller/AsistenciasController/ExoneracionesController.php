<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/ExoneracionesModel.php';

class ExoneracionesController extends BaseController
{
    private $model;

    public function __construct() {
        $this->model = new Exoneraciones();
    }


    public function MostrarExoneraciones() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $Exoneraciones = $this->model->obtenerExoneraciones(); 

            $this->loadView(
                'Asistencias.Exoneraciones', 
                ['Exoneraciones' => $Exoneraciones], 
                [], 
                [
                    '/biometrico/sistema/view/Asistencias/recursos/js/Exoneraciones.min.js' 
                ],
                'Gestión de Exoneraciones' 
            );
        }
    }
    public function solicitarExoneracion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dniEmpleado = $_POST['dniEmpleado'] ?? null;
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $motivo = $_POST['motivo'] ?? null;
            $documento = null;

            $empleado = $this->model->obtenerEmpleadoPorDni($dniEmpleado);
            if (!$empleado) {
                echo "Error: El empleado con DNI $dniEmpleado no existe.";
                return;
            }

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

            if ($this->model->crearExoneraciones($empleado['idEmpleado'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
                echo "Exoneración solicitada exitosamente.";
            } else {
                echo "Error al solicitar la exoneración.";
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

        if ($this->model->crearExoneraciones($idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento)) {
            echo "Exoneracion creado exitosamente.";
        } else {
            echo "Error al crear el Exoneracion.";
        }
    }

    public function actualizar($idEmpleado) {
        $idExoneraciones = $_POST['idExoneraciones'] ?? null;
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $motivo = $_POST['motivo'] ?? null;
        $documento = $_POST['documento'] ?? null;

        if ($this->model->actualizarExoneraciones($idExoneraciones, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento)) {
            echo "Exoneracion actualizado exitosamente.";
        } else {
            echo "Error al actualizar el Exoneracion.";
        }
    }

    public function eliminar($idEmpleado) {
        $idExoneraciones = $_POST['idExoneraciones'] ?? null;

        if ($this->model->eliminarExoneraciones($idExoneraciones)) {
            echo "Exoneracion eliminado exitosamente.";
        } else {
            echo "Error al eliminar el Exoneraciones.";
        }
    }

    public function listar() {
        $Exoneraciones = $this->model->obtenerExoneraciones();
        echo json_encode($Exoneraciones);
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
