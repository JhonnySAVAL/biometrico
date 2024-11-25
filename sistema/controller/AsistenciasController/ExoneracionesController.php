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
            $exoneraciones = $this->model->obtenerExoneraciones();
            
            $this->loadView(
                'Asistencias.Exoneraciones',
                ['exoneraciones' => $exoneraciones],
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
            if ($this->model->crearExoneraciones($empleado['idEmpleado'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
                header("Location: /biometrico/sistema/controller/AsistenciasController/ExoneracionesController.php?action=MostrarExoneraciones");
                exit();
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
