<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/ConfiguracionModel/FeriadosModel.php';

class FeriadosController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new Feriados();
    }

    // Acción para mostrar la vista de feriados
    public function mostrarFeriados() {
        $feriadosAnuales = $this->model->obtenerFeriadosAnuales();
        $feriadosSimples = $this->model->obtenerFeriadosSimples();
        $this->loadView('Feriados.Feriados', [
            'feriadosAnuales' => $feriadosAnuales,
            'feriadosSimples' => $feriadosSimples,

        ]);
    }

    // Acción para crear un nuevo feriado
    public function crearFeriado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $tipo = $_POST['tipo'];
            $año = $_POST['año'];

            $this->model->crearFeriado($nombre, $fecha, $tipo, $año);
            header("Location: /biometrico/sistema/controller/FeriadosController.php?action=MostrarFeriados");
        }
    }

    // Acción para eliminar un feriado
    public function eliminarFeriado() {
        if (isset($_GET['id'])) {
            $idFeriado = $_GET['id'];
            $this->model->eliminarFeriado($idFeriado);
            header("Location: /biometrico/sistema/controller/FeriadosController.php?action=MostrarFeriados");
        }
    }

    // Acción para copiar feriados de un año a otro
    public function copiarFeriadosDeAno() {
        if (isset($_POST['añoOrigen']) && isset($_POST['añoDestino'])) {
            $añoOrigen = $_POST['añoOrigen'];
            $añoDestino = $_POST['añoDestino'];

            $this->model->copiarFeriadosDeAno($añoOrigen, $añoDestino);
            header("Location: /biometrico/sistema/controller/FeriadosController.php?action=MostrarFeriados");
        }
    }
}
?>
