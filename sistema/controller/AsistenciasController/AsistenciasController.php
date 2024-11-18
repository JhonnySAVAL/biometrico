<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/AsistenciasModel.php';

class AsistenciaController extends BaseController
{
    private $asistenciasModel;

    public function __construct()
    {
        $this->asistenciasModel = new Asistencias();
    }
    public function mostrarAsistencia()
    {
        $listaEmpleados = $this->asistenciasModel->obtenerEmpleados();
        $empleadosEntrada = $this->asistenciasModel->obtenerEmpleadosConEntrada(date('Y-m-d'));
        $empleadosAusentes = $this->asistenciasModel->obtenerEmpleadosAusentes(date('Y-m-d'));
        $empleadosConFalta = $this->asistenciasModel->obtenerEmpleadosConFalta(date('Y-m-d'));
    
        $this->loadView('Asistencias.Asistencias', [
            'listaEmpleados' => $listaEmpleados,
            'empleadosEntrada' => $empleadosEntrada,
            'empleadosAusentes' => $empleadosAusentes,
            'empleadosConFalta' => $empleadosConFalta,
        ],  [],  [
                    '/biometrico/sistema/view/Asistencias/recursos/js/Asistencias.min.js'
        ]);
    }
    public function marcarEntrada($idEmpleado)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->asistenciasModel->registrarEntrada($idEmpleado, 'manual');
    
            header('Location: /biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=mostrarAsistencia');
        exit; 
        }
    }
    public function marcarSalida($idEmpleado)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['empleadoId'])) {
            $idEmpleado = $_POST['empleadoId'];

            // Registrar la salida
            $this->asistenciasModel->registrarSalida($idEmpleado, 'manual');

            echo json_encode([
                'success' => true,
                'message' => 'Salida registrada exitosamente.',
                'redirect' => '/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=mostrarAsistencia'
            ]);
            exit;
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'ID de empleado no proporcionado.'
            ]);
            exit;
        }
    }
}

    public function marcarReceso($idEmpleado)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->asistenciasModel->registrarReceso($idEmpleado, 'manual'); 
            
            header('Location: /biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=mostrarAsistencia');
        exit; 
        }
    }
    

    public function verificarFaltas()
    {
        $empleadosConFalta = $this->asistenciasModel->obtenerEmpleadosSinEntradaSinPermiso(date('Y-m-d'));
    
        foreach ($empleadosConFalta as $empleado) {
            $this->asistenciasModel->registrarFalta($empleado['idEmpleado']);
        }
    }
    


}
if (isset($_GET['action'])) {
    $controller = new AsistenciaController();
    $action = $_GET['action'];

    if ($action == 'marcarEntrada' && isset($_POST['empleadoId'])) {
      
        $idEmpleado = $_POST['empleadoId'];
        $controller->$action($idEmpleado);  
    } else {
        if (method_exists($controller, $action)) {
            $controller->$action(); 
        } else {
            echo "Error: Acción no válida.";
        }
    }
}



?>
