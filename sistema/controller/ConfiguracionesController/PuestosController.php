<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/ConfiguracionModel/PuestosModel.php';

class PuestosController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Puestos();
    }

    public function MostrarPuestos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $Puestos = $this->model->ObtenerPuestos();

            $this->loadView(
                'Configuracion.Puestos',
                ['Puestos' => $Puestos],
                [],
                [
                    '/biometrico/sistema/view/Configuracion/js/Puesto.min.js'
                ],
                'Puestos'
            );
        }
    }


    public function CrearPuesto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombrePuesto = $_POST['nombrePuesto'];
            $area = $_POST['area'];
            $descripcion = $_POST['descripcion'];

            $this->model->InsertarPuesto($nombrePuesto, $area, $descripcion);

            header('Location: /biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=MostrarPuestos');
            exit();
        }
    }
    public function ActualizarPuesto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPuesto = $_POST['idPuesto'];
            $nombrePuesto = $_POST['nombrePuesto'];
            $area = $_POST['area'];
            $descripcion = $_POST['descripcion'];

            $this->model->ActualizarPuesto($idPuesto, $nombrePuesto, $area, $descripcion);

            header('Location: /biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=MostrarPuestos');
        }
    }

    public function EliminarPuesto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPuesto = $_POST['idPuesto'];

            if (empty($idPuesto)) {
                echo json_encode(['success' => false, 'message' => 'ID del puesto no proporcionado']);
                exit();
            }

            $empleados = $this->model->VerificarUsuariosPorPuesto($idPuesto);

            if (count($empleados) > 0) {
                echo json_encode(['success' => false, 'empleados' => $empleados]);
            } else {
                $this->model->EliminarPuesto($idPuesto);
                echo json_encode(['success' => true]);
            }
        }
    }
    public function VerificarUsuariosPorPuesto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['idPuesto']) && is_numeric($_GET['idPuesto'])) {
                $idPuesto = $_GET['idPuesto'];
                
                // Llamamos al método VerificarUsuariosPorPuesto que trae los empleados del puesto
                $empleados = $this->model->VerificarUsuariosPorPuesto($idPuesto);
                
                // Devolvemos la respuesta en formato JSON
                echo json_encode(['empleados' => $empleados]);
            } else {
                // Si el ID de puesto no es válido, respondemos con un mensaje de error
                echo json_encode(['empleados' => [], 'message' => 'ID de puesto no válido']);
            }
            exit();
        }
    }

    


}
if (isset($_GET['action'])) {
    $controller = new PuestosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
