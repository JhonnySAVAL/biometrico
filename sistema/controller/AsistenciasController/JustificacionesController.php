<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/JustificacionesModel.php';

class JustificacionesController extends BaseController
{
    private $model;

    public function __construct() {
        $this->model = new Justificaciones();
    }

    public function MostrarJustificaciones() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $justificaciones = $this->model->obtenerJustificaciones();
            $this->loadView(
                'Asistencias.Justificaciones',
                ['justificaciones' => $justificaciones],
                [],
                [
                    '/biometrico/sistema/view/Asistencias/recursos/js/Justificaciones.min.js'
                ],
                'Gestión de Justificaciones'
            );
        }
    }

    public function solicitarJustificacion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dniEmpleado = $_POST['dniEmpleado'] ?? null;
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $motivo = $_POST['motivo'] ?? null;
            $documento = null;

            // Verificar si el empleado existe
            $empleado = $this->model->obtenerEmpleadoPorDni($dniEmpleado);
            if (!$empleado) {
                echo "Error: El empleado con DNI $dniEmpleado no existe.";
                return;
            }

            if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivoOriginal = pathinfo($_FILES['documento']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['documento']['name'], PATHINFO_EXTENSION); 
            $rutaCarpeta = __DIR__ . '/../../../uploads/'; 

            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true); 
            }

            $nombreArchivo = $nombreArchivoOriginal . '.' . $extension; 
            $contador = 1;

            // Verificar si ya existe un archivo con el mismo nombre
            while (file_exists($rutaCarpeta . $nombreArchivo)) {
                $nombreArchivo = $nombreArchivoOriginal . "($contador)." . $extension; 
                $contador++;
            }

            $rutaDestino = $rutaCarpeta . $nombreArchivo;

            if (move_uploaded_file($_FILES['documento']['tmp_name'], $rutaDestino)) {
                $documento = '/biometrico/uploads/' . $nombreArchivo; 
            } else {
                echo "Error al subir el documento.";
                return;
            }
        } else {
            $documento = null; 
        }

            
    
            // Crear el permiso
            if ($this->model->crearJustificaciones($empleado['idEmpleado'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
                header("Location: /biometrico/sistema/controller/AsistenciasController/JustificacionesController.php?action=MostrarJustificaciones");
                exit();
            } else {
                echo "Error al solicitar el permiso.";
            }
        } else {
            echo "Método no permitido.";
        }
    }
    

    public function actualizarJustificaciones($dniEmpleado) {
        $idJustificaciones = $_POST['idJustificaciones'] ?? null;
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $motivo = $_POST['motivo'] ?? null;
        $documento = $_POST['documento'] ?? null;

        // Verificar si el empleado existe
        $empleado = $this->model->obtenerEmpleadoPorDni($dniEmpleado);
        if (!$empleado) {
            echo "Error: El empleado con DNI $dniEmpleado no existe.";
            return;
        }

        if ($this->model->actualizarJustificaciones($idJustificaciones, $empleado['idEmpleado'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
            echo "Justificación actualizada exitosamente.";
        } else {
            echo "Error al actualizar la justificación.";
        }
    }

    public function eliminar($idJustificaciones) {
        if ($this->model->eliminarJustificaciones($idJustificaciones)) {
            echo "Justificación eliminada exitosamente.";
        } else {
            echo "Error al eliminar la justificación.";
        }
    }

    public function listar() {
        $justificaciones = $this->model->obtenerJustificaciones();
        echo json_encode($justificaciones);
    }


}

if (isset($_GET['action'])) {
    $controller = new JustificacionesController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
