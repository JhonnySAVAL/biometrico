<?php
require_once __DIR__ . '/../modelos/Asistencia.php';

class AsistenciaController extends BaseController
{
    public function RegistrarEntrada()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $horaEntrada = $_POST['horaEntrada'];

            $asistenciaModel = new Asistencia();
            $asistenciaModel->registrarAsistencia($idEmpleado, $horaEntrada);

            header('Location: /asistencia');
            exit;
        }

        $this->loadView('Asistencia.RegistrarEntrada');
    }

    public function RegistrarSalida($idAsistencia)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $horaSalida = $_POST['horaSalida'];

            $asistenciaModel = new Asistencia();
            $asistenciaModel->registrarSalida($idAsistencia, $horaSalida);

            header('Location: /asistencia');
            exit;
        }

        $this->loadView('Asistencia.RegistrarSalida', [
            'idAsistencia' => $idAsistencia
        ]);
    }

    public function VerAsistencias($fecha)
    {
        $asistenciaModel = new Asistencia();
        $asistencias = $asistenciaModel->getAsistenciasPorFechaGeneral($fecha);

        $this->loadView('Asistencia.AsistenciasList', [
            'asistencias' => $asistencias
        ]);
    }

    public function VerAsistenciaEmpleado($idEmpleado, $fecha)
    {
        $asistenciaModel = new Asistencia();
        $asistencia = $asistenciaModel->getAsistenciasPorFecha($idEmpleado, $fecha);

        $this->loadView('Asistencia.AsistenciaEmpleado', [
            'asistencia' => $asistencia
        ]);
    }
}
if (isset($_GET['action'])) {
    $controller = new AsistenciaController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
if (isset($_GET['action'])) {
    $controller = new AsistenciaController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}