<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/ConfiguracionModel/FeriadosModel.php';

class FeriadosController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new Feriados();
    }

    public function MostrarFeriadosPorAno() {
        $año = isset($_GET['año']) ? $_GET['año'] : date('Y');  
        $feriados = $this->model->obtenerFeriadosPorAno($año);
        $this->loadView('Feriados.FeriadosPorAno', [
            'feriados' => $feriados,
            'año' => $año
        ]);
    }
    

    public function CrearFeriado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha']; 
            $tipo = $_POST['tipo'];    
            $año = $_POST['año'];     

            $this->model->crearFeriado($nombre, $fecha, $tipo, $año);
            header('Location: /biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=MostrarFeriadosPorAno&año=' . $año);
            exit;
        }
        $this->loadView('Feriados.CrearFeriado');
    }

    public function CrearFeriadoAnual() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];  

            $this->model->crearFeriadoAnual($nombre, $fecha);
            header('Location: /biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=MostrarFeriadosPorAno&año=' . date('Y'));
            exit;
        }
        $this->loadView('Feriados.CrearFeriadoAnual');
    }

    public function CopiarFeriadosPorAno() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $añoOrigen = $_POST['añoOrigen'];
            $añoDestino = $_POST['añoDestino'];

            $this->model->copiarFeriadosPorAno($añoOrigen, $añoDestino);
            header('Location: /biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=MostrarFeriadosPorAno&año=' . $añoDestino);
            exit;
        }
        $this->loadView('Feriados.CopiarFeriados');
    }

    

}

if (isset($_GET['action'])) {
    $controller = new FeriadosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}

?>
