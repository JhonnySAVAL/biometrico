<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Turno.php';

class TurnoController extends BaseController {
    private $model;

    public function __construct()
    {
        $this->model = new Dashboard();
    }
    public function registrarTurno() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descripcion = $_POST['descripcion'];
            $entrada = $_POST['entrada'];
            $salida = $_POST['salida'];
            $duracion = $_POST['duracion'];
            $receso = $_POST['receso'];

            $turno = new Turno();
            if ($turno->registrarTurno($descripcion, $entrada, $salida, $duracion, $receso)) {
                header("Location: /turnos/listar"); 
            } else {
                echo "Error al registrar el turno.";
            }
        } else {
            $this->loadView('Turno.registrar');
        }
    }

    public function listarTurnos() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $turno = new Turno();
            $turnos = $turno->obtenerTurnos();
            $this->loadView('Turno.listar', ['turnos' => $turnos]);
        }
    }

    public function verTurno($idTurno) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $turno = new Turno();
            $turnoDetalle = $turno->obtenerTurnoPorId($idTurno);
            $this->loadView('Turno.ver', ['turno' => $turnoDetalle]);
        }
    }

    public function actualizarTurno() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idTurno = $_POST['idTurno'];
            $descripcion = $_POST['descripcion'];
            $entrada = $_POST['entrada'];
            $salida = $_POST['salida'];
            $duracion = $_POST['duracion'];
            $receso = $_POST['receso'];

            $turno = new Turno();
            if ($turno->actualizarTurno($idTurno, $descripcion, $entrada, $salida, $duracion, $receso)) {
                header("Location: /turnos/listar"); 
            } else {
                echo "Error al actualizar el turno.";
            }
        }
    }

    public function eliminarTurno($idTurno) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $turno = new Turno();
            if ($turno->eliminarTurno($idTurno)) {
                header("Location: /turnos/listar"); 
            } else {
                echo "Error al eliminar el turno.";
            }
        }
    }
}
if (isset($_GET['action'])) {
    $controller = new TurnoController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
