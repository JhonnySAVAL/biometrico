<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/VacacionesModel/VacacionesModel.php';

class VacacionesController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Vacaciones();
    }

    public function MostrarEmpleadosSinVacaciones()
    {
        $empleados = $this->model->getEmpleadosSinVacaciones();
        $this->loadView('Vacaciones.VacacionesNoProgramadas', [
            'empleados' => $empleados
        ], [], ['/biometrico/sistema/view/Vacaciones/recursos/js/VacacionesNoProgramadas.min.js'], 'Vacaciones No Programadas');
    }

    public function MostrarVacacionesProgramadas()
    {
        $vacaciones = $this->model->getVacacionesProgramadas();
        $this->loadView('Vacaciones.VacacionesProgramadas', [
            'vacaciones' => $vacaciones
        ], [], ['/biometrico/sistema/view/Vacaciones/recursos/js/VacacionesProgramadas.min.js'], 'Vacaciones Programadas');
    }

    public function AsignarVacacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $motivo = $_POST['motivo'];
            if (empty($idEmpleado)) {
                echo "Error: El idEmpleado está vacío.";
                exit;
            }
            $this->model->asignarVacacion($idEmpleado, $fecha_inicio, $fecha_fin, $motivo);
            header('Location: /biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=MostrarEmpleadosSinVacaciones');
            exit;
        }
        $this->loadView('Vacaciones.AsignarVacacion');
    }

    public function EditarVacacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idVacacion = $_POST['idVacacion'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $this->model->editarVacacion($idVacacion, $fecha_inicio, $fecha_fin);

            header('Location: /biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=MostrarVacacionesProgramadas');
            exit;
        }
    }

    public function ObtenerVacacion()
    {
        if (isset($_GET['idVacacion'])) {
            $idVacacion = $_GET['idVacacion'];
            $vacacion = $this->model->getVacacionById($idVacacion);
            echo json_encode($vacacion);
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new VacacionesController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}

?>
