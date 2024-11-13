<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/ConfiguracionModel/TurnosModel.php';

class TurnosController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Turnos();
    }

    public function MostrarTurnos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $Turnos = $this->model->ObtenerTurnos();

            $this->loadView(
                'Configuracion.Turnos',
                ['Turnos' => $Turnos],
                [],
                [
                    '/biometrico/sistema/view/Configuracion/js/Turno.min.js'
                ],
                'Turnos'
            );
        }
    }

    public function CrearTurno()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descripcion = $_POST['descripcion'];
            $entrada = $_POST['entrada'];
            $salida = $_POST['salida'];
            $duracion = $_POST['duracion'];
            $receso = $_POST['receso'];

            $this->model->InsertarTurno($descripcion, $entrada, $salida, $duracion, $receso);

            header('Location: /biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos');
            exit();
        }
    }

    public function ActualizarTurno()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idTurno = $_POST['idTurno'];
            $descripcion = $_POST['descripcion'];
            $entrada = $_POST['entrada'];
            $salida = $_POST['salida'];
            $duracion = $_POST['duracion'];
            $receso = $_POST['receso'];

            $this->model->ActualizarTurno($idTurno, $descripcion, $entrada, $salida, $duracion, $receso);

            header('Location: /biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos');
            exit();
        }
    }

    public function EliminarTurno()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idTurno = $_POST['idTurno'];

            $this->model->EliminarTurno($idTurno);

            header('Location: /biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos');
            exit();
        }
    }

    // public function VerificarUsuariosPorTurno()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $idTurno = $_GET['idTurno'];
    //         $empleados = $this->model->ObtenerEmpleadosPorTurno($idTurno);
    //         echo json_encode(['empleados' => $empleados]);
    //         exit();
    //     }
    // }


    

}
if (isset($_GET['action'])) {
    $controller = new TurnosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
