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
       
        $this->loadView('Asistencias.Asistencias', [
            'listaEmpleados' => $listaEmpleados,
        ],  [],  [
                    '/biometrico/sistema/view/Asistencias/recursos/js/Asistencias.min.js'
        ]);
    }
  


}
if (isset($_GET['action'])) {
    $controller = new AsistenciaController();
    $action = $_GET['action'];

    if ($action == 'marcarEntrada' && isset($_POST['idEmpleado'])) {
      
        $idEmpleado = $_POST['idEmpleado'];
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
