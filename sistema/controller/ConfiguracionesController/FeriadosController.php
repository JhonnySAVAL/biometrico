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
        $aniosDisponibles = $this->model->obtenerAniosDisponibles();
        
        // Pasar los feriados anuales a la vista para ser usados en el modal
        $this->loadView('Feriados.Feriados', [
            'feriadosAnuales' => $feriadosAnuales,
            'feriadosSimples' => $feriadosSimples,
            'aniosDisponibles' => $aniosDisponibles,
        ], [], ['/biometrico/sistema/view/Feriados/recursos/js/Feriados.min.js'], 'Feriados');
    }
    
    // Acción para obtener los feriados de un año para copiar
    public function obtenerFeriadosPorAnio() {
        if (isset($_GET['anio'])) {
            $anio = $_GET['anio'];
            $feriados = $this->model->obtenerFeriadosPorAnio($anio);
            echo json_encode($feriados);
            exit();
        }
    }
  
    // Acción para crear un nuevo feriado
    public function crearFeriado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $tipo = $_POST['tipo'];
            $anio = $_POST['anio'];

            $this->model->crearFeriado($nombre, $fecha, $tipo, $anio);
            header("Location: /biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=MostrarFeriados");
            exit();
        }
    }

    // Acción para eliminar un feriado
    public function eliminarFeriado() {
        if (isset($_GET['id'])) {
            $idFeriado = $_GET['id'];
            $this->model->eliminarFeriado($idFeriado);
            header("Location: /biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=MostrarFeriados");
            exit();
        }
    }

    // Acción para copiar feriados de un anio a otro
    public function copiarFeriadosDeAno() {
        if (isset($_POST['añoOrigen']) && isset($_POST['añoDestino'])) {
            $añoOrigen = $_POST['añoOrigen'];
            $añoDestino = $_POST['añoDestino'];

            $this->model->copiarFeriadosDeAno($añoOrigen, $añoDestino);
            header("Location: /biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=MostrarFeriados");
            exit();
        }
    }
    public function copiarFeriados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $añoOrigen = $_POST['añoOrigen'];   
            $añoDestino = $_POST['añoDestino']; 

            $this->model->copiarFeriadosDeAno($añoOrigen, $añoDestino);

            header('Location: /ruta/donde/quieras/redirigir');
            exit();
        }
    }
     // Acción para obtener los datos de un feriado y cargarlos en el modal
     public function editarFeriado() {
        if (isset($_GET['id'])) {
            $idFeriado = $_GET['id'];
            $feriado = $this->model->obtenerFeriadoPorId($idFeriado); // Asumiendo que existe este método en el modelo
            if ($feriado) {
                // Mostrar el modal con los datos del feriado
                $this->loadView('Feriados.EditarFeriado', [
                    'feriado' => $feriado,
                ]);
            }
        }
    }

    // Acción para actualizar los datos del feriado
    public function actualizarFeriado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idFeriado = $_POST['idFeriado'];
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $tipo = $_POST['tipo'];
            $anio = $_POST['anio'];

            $this->model->actualizarFeriado($idFeriado, $nombre, $fecha, $tipo, $anio);
            header("Location: /biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=MostrarFeriados");
            exit();
        }
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
