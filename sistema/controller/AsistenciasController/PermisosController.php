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
            if ($this->model->crearPermisos($empleado['idEmpleado'], $fecha_inicio, $fecha_fin, $motivo, $documento)) {
              
                header("Location: /biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=MostrarPermisos");
                exit(); // Asegúrate de incluir exit() después de header() para detener la ejecución del script.
            } else {
                echo "Error al solicitar el permiso.";
            }
            
        } else {
            echo "Método no permitido.";
        }
    }
    
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPermiso = $_POST['idPermiso'] ?? null;
            $idEmpleado = $_POST['idEmpleado'] ?? null; // Si también necesitas actualizar este campo
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $motivo = $_POST['motivo'] ?? null;
            $documento = null;
    
            // Manejar el documento si se sube uno nuevo
            if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivoOriginal = pathinfo($_FILES['documento']['name'], PATHINFO_FILENAME);
                $extension = pathinfo($_FILES['documento']['name'], PATHINFO_EXTENSION);
                $rutaCarpeta = __DIR__ . '/../../../uploads/';
    
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, true);
                }
    
                $nombreArchivo = $nombreArchivoOriginal . '.' . $extension;
                $contador = 1;
    
                while (file_exists($rutaCarpeta . $nombreArchivo)) {
                    $nombreArchivo = $nombreArchivoOriginal . "($contador)." . $extension;
                    $contador++;
                }
    
                $rutaDestino = $rutaCarpeta . $nombreArchivo;
    
                if (move_uploaded_file($_FILES['documento']['tmp_name'], $rutaDestino)) {
                    $documento = '/biometrico/uploads/' . $nombreArchivo;
                }
            } else {
                $documento = $_POST['documentoActual'] ?? null; // Mantén el archivo existente si no se sube uno nuevo
            }
    
            if ($this->model->actualizarPermisos($idPermiso, $idEmpleado, $fecha_inicio, $fecha_fin, $motivo, $documento)) {
                echo "Permiso actualizado exitosamente.";
            } else {
                echo "Error al actualizar el permiso.";
            }
        } else {
            echo "Método no permitido.";
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
