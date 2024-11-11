<?php
require_once __DIR__ . '/../modelos/Exoneraciones.php';

class ExoneracionesController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Dashboard();
    }
    public function MostrarExoneraciones()
    {
        $exoneracionesModel = new Exoneraciones();

        $exoneraciones = $exoneracionesModel->getTodasLasExoneraciones();

        // Pasar los datos a la vista
        $this->loadView('Exoneraciones.ExoneracionesList', [
            'exoneraciones' => $exoneraciones
        ], [], [], 'Exoneraciones');
    }

    public function MostrarExoneracionesAprobadas()
    {
        $exoneracionesModel = new Exoneraciones();
        $exoneraciones = $exoneracionesModel->getExoneracionesAprobadas();

        $this->loadView('Exoneraciones.ExoneracionesAprobadas', [
            'exoneraciones' => $exoneraciones
        ], [], [], 'Exoneraciones');
    }

    public function AgregarExoneracion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $motivo = $_POST['motivo'];

            $exoneracionesModel = new Exoneraciones();
            $exoneracionesModel->agregarExoneracion($idEmpleado, $fechaInicio, $fechaFin, $motivo);

            header('Location: /exoneraciones');
            exit;
        }

        $this->loadView('Exoneraciones.AgregarExoneracion');
    }

    public function AprobarExoneracion($idExoneracion)
    {
        $exoneracionesModel = new Exoneraciones();
        $exoneracionesModel->aprobarExoneracion($idExoneracion);

        header('Location: /exoneraciones');
        exit;
    }

    public function RechazarExoneracion($idExoneracion)
    {
        $exoneracionesModel = new Exoneraciones();
        $exoneracionesModel->rechazarExoneracion($idExoneracion);

        header('Location: /exoneraciones');
        exit;
    }
}
if (isset($_GET['action'])) {
    $controller = new ExoneracionesController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
if (isset($_GET['action'])) {
    $controller = new ExoneracionesController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}