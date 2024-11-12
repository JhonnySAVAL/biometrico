<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/Turno.php';

class UbigeoController extends BaseController {
    private $model;

    public function __construct()
    {
        $this->model = new Ubigeo();
    }




}
if (isset($_GET['action'])) {
    $controller = new UbigeoController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();  
    } else {
        echo "Error: Acción no encontrada.";
    }
}
?>
