<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Turno.php';

class FeriadosController extends BaseController {
    private $model;

    public function __construct()
    {
        $this->model = new Feriados();
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
