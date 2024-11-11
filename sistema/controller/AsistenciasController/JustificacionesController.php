<?php
require_once __DIR__ . '/../modelos/Justificaciones.php';

class JustificacionesController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Dashboard();
    }
    public function MostrarJustificaciones()
    {
        $justificacionesModel = new Justificaciones();
        $justificaciones = $justificacionesModel->getTodasLasJustificaciones();

        $this->loadView('Justificaciones.JustificacionesList', [
            'justificaciones' => $justificaciones
        ], [], [], 'Justificaciones');
    }

    public function MostrarJustificacionesAprobadas()
    {
        $justificacionesModel = new Justificaciones();
        $justificaciones = $justificacionesModel->getJustificacionesAprobadas();

        $this->loadView('Justificaciones.JustificacionesAprobadas', [
            'justificaciones' => $justificaciones
        ], [], [], 'Justificaciones');
    }

    public function AgregarJustificacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $motivo = $_POST['motivo'];

            $justificacionesModel = new Justificaciones();
            $justificacionesModel->agregarJustificacion($idEmpleado, $fechaInicio, $fechaFin, $motivo);

            header('Location: /justificaciones');
            exit;
        }

        $this->loadView('Justificaciones.AgregarJustificacion');
    }

    public function AprobarJustificacion($idJustificacion)
    {
        $justificacionesModel = new Justificaciones();
        $justificacionesModel->aprobarJustificacion($idJustificacion);

        header('Location: /justificaciones');
        exit;
    }

    public function RechazarJustificacion($idJustificacion)
    {
        $justificacionesModel = new Justificaciones();
        $justificacionesModel->rechazarJustificacion($idJustificacion);

        header('Location: /justificaciones');
        exit;
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
