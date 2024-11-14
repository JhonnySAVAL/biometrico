<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/VacacionesModel.php';

class VacacionesController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Vacaciones();
    }
    public function MostrarVacaciones()
    {
        $vacacionesModel = new Vacaciones();
        $vacaciones = $vacacionesModel->getTodasLasVacaciones();

        $this->loadView('Vacaciones.Vacaciones', [
            'vacaciones' => $vacaciones
        ], [], [], 'Vacaciones');
    }


    public function MostrarVacacionesAprobadas()
    {
        $vacacionesModel = new Vacaciones();
        $vacaciones = $vacacionesModel->getVacaciones();

        $this->loadView('Vacaciones.VacacionesAprobadas', [
            'vacaciones' => $vacaciones
        ], [], [], 'Vacaciones');
    }

    public function AgregarVacacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $motivo = $_POST['motivo'];

            $vacacionesModel = new Vacaciones();
            $vacacionesModel->agregarVacacion($idEmpleado, $fechaInicio, $fechaFin, $motivo);

            header('Location: /vacaciones');
            exit;
        }

        $this->loadView('Vacaciones.AgregarVacacion');
    }

    public function AprobarVacacion($idVacacion)
    {
        $vacacionesModel = new Vacaciones();
        $vacacionesModel->aprobarVacacion($idVacacion);
        header('Location: /vacaciones');
        exit;
    }

    public function RechazarVacacion($idVacacion)
    {
        $vacacionesModel = new Vacaciones();
        $vacacionesModel->rechazarVacacion($idVacacion);

        header('Location: /vacaciones');
        exit;
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