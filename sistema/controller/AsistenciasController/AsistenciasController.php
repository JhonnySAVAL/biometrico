<?php
require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AsistenciasModel/AsistenciasModel.php';

class AsistenciaController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Asistencias();
    }
    public function mostrarEstadoAsistencias() {
        $estadoAsistencias = $this->model->obtenerEstadoAsistencias();
        
        $this->loadView('Asistencias.Asistencias', [
            'estadoAsistencias' => $estadoAsistencias,
        ],  [],  [
            '/biometrico/sistema/view/Asistencias/recursos/js/Asistencias.min.js'
        ], 'Gestion Asistencias');
    }
    public function marcarEntrada() {
        $data = json_decode(file_get_contents("php://input"));
    
        $dni = $data->dni;
        $horaEntrada = $data->horaEntrada;
        $tipo = $data->tipo;
    
        // Obtener el empleado por su DNI
        $empleado = $this->model->obtenerEmpleadoPorDNI($dni);
    
        if (!$empleado) {
            echo json_encode(['error' => true, 'message' => 'Empleado no encontrado.']);
            return;
        }
    
        $fechaHoy = date('Y-m-d');
    
        if ($this->model->esFeriado($fechaHoy)) {
            echo json_encode(['error' => true, 'message' => 'No se puede marcar la entrada. Hoy es feriado.']);
            return;
        }
    
        if ($this->model->estaDeVacaciones($empleado['idEmpleado'], $fechaHoy)) {
            echo json_encode(['error' => true, 'message' => 'No se puede marcar la entrada. El empleado está de vacaciones.']);
            return;
        }
    
        if ($this->model->tienePermiso($empleado['idEmpleado'], $fechaHoy)) {
            echo json_encode(['error' => true, 'message' => 'No se puede marcar la entrada. El empleado tiene permiso hoy.']);
            return;
        }
    
        if ($this->model->tieneExoneracion($empleado['idEmpleado'], $fechaHoy)) {
            echo json_encode(['error' => true, 'message' => 'No se puede marcar la entrada. El empleado tiene exoneración hoy.']);
            return;
        }
    
        $asistenciaExistente = $this->model->obtenerAsistenciaHoy($empleado['idEmpleado'], $fechaHoy);
        if ($asistenciaExistente) {
            echo json_encode(['error' => true, 'message' => 'El empleado ya ha marcado su entrada hoy.']);
            return;
        }
    
        $turno = $this->model->obtenerTurnoEmpleado($empleado['idTurno']);
        $horaEntradaTurno = strtotime($turno['entrada']);
        $horaSalidaTurno = strtotime($turno['salida']);
        $horaEntradaReal = strtotime($horaEntrada);
    
        // Evitar que se marque entrada después de la hora de salida del turno
        if ($horaEntradaReal > $horaSalidaTurno) {
            echo json_encode(['error' => true, 'message' => 'No se puede marcar la entrada. La hora de entrada ya ha pasado la hora de salida del turno.']);
            return;
        }
    
        // Calcular minutos de tardanza si aplica
        $minutosTardanza = 0;
        if ($horaEntradaReal > $horaEntradaTurno) {
            $minutosTardanza = ($horaEntradaReal - $horaEntradaTurno) / 60; // Diferencia en minutos
        }
    
        // Registrar la entrada con estado "presente" y la tardanza
        $this->model->registrarEntrada($empleado['idEmpleado'], $horaEntrada, $tipo, $minutosTardanza);
    
        // Actualizar el estado a "presente"
        $this->model->actualizarEstado($empleado['idEmpleado'], 'presente');
    
        echo json_encode([
            'error' => false,
            'message' => 'Entrada registrada correctamente.' . ($minutosTardanza > 0 ? " Se registraron $minutosTardanza minutos de tardanza." : '')
        ]);
    }
    
    
    
    public function verificarEntrada() {
        $dni = $_GET['dni'];
        $empleado = $this->model->obtenerEmpleadoPorDNI($dni);
    
        if ($empleado) {
            $fechaHoy = date('Y-m-d');
            $asistenciaExistente = $this->model->obtenerAsistenciaHoy($empleado['idEmpleado'], $fechaHoy);
    
            if ($asistenciaExistente) {
                echo json_encode(['error' => true, 'message' => 'El empleado ya ha marcado su entrada hoy.']);
            } else {
                echo json_encode(['error' => false, 'message' => 'No hay marca de entrada hoy para este empleado.']);
            }
        } else {
            echo json_encode(['error' => true, 'message' => 'Empleado no encontrado.']);
        }
    }
    
    public function marcarReceso() {
        $data = json_decode(file_get_contents("php://input"));
        $dniReceso = $data->dni;
        $horaReceso = $data->horaReceso;
    
        // Obtener datos del empleado por DNI
        $empleado = $this->model->obtenerEmpleadoPorDNI($dniReceso);
    
        if ($empleado) {
            $fechaHoy = date('Y-m-d');
    
            // Verificar si ya marcó entrada hoy
            $asistenciaExistente = $this->model->obtenerAsistenciaHoy($empleado['idEmpleado'], $fechaHoy);
            if (!$asistenciaExistente || empty($asistenciaExistente['hora_entrada'])) {
                echo json_encode(['error' => true, 'message' => 'El empleado debe marcar su entrada antes de registrar un receso.']);
                return;
            }
    
            // Verificar si ya marcó receso hoy
            $recesoExistente = $this->model->obtenerRecesoHoy($empleado['idEmpleado'], $fechaHoy);
            if ($recesoExistente) {
                echo json_encode(['error' => true, 'message' => 'El empleado ya ha registrado un receso hoy.']);
                return;
            }
    
            // Registrar el inicio del receso
            $this->model->registrarReceso($empleado['idEmpleado'], $horaReceso);
            echo json_encode(['error' => false, 'message' => 'Receso registrado correctamente.']);
        } else {
            echo json_encode(['error' => true, 'message' => 'Empleado no encontrado.']);
        }
    }
    
    public function marcarFinalReceso() {
        $data = json_decode(file_get_contents("php://input"));
        $dniRecesoFinal = $data->dniRecesoFinal;
        $horaRecesoFinal = $data->horaRecesoFinal;
    
        // Obtener datos del empleado por DNI
        $empleado = $this->model->obtenerEmpleadoPorDNI($dniRecesoFinal);
    
        if ($empleado) {
            $fechaHoy = date('Y-m-d');
    
            // Verificar si ya marcó receso hoy y si su estado es "receso"
            $recesoExistente = $this->model->obtenerAsistenciaHoy($empleado['idEmpleado'], $fechaHoy);
            if (!$recesoExistente || $recesoExistente['estado'] !== 'receso') {
                echo json_encode(['error' => true, 'message' => 'El empleado no está actualmente en receso o no tiene receso registrado.']);
                return;
            }
    
            // Registrar el fin del receso
            $this->model->registrarFinReceso($empleado['idEmpleado'], $horaRecesoFinal);
    
            // Actualizar el estado a "presente"
            $this->model->actualizarEstado($empleado['idEmpleado'], 'regreso');
    
            echo json_encode(['error' => false, 'message' => 'Fin de receso registrado correctamente. Estado actualizado a "presente".']);
        } else {
            echo json_encode(['error' => true, 'message' => 'Empleado no encontrado.']);
        }
    }
    
    public function marcarSalida() {
        $data = json_decode(file_get_contents("php://input"));
        $dniSalida = $data->dniSalida;
        $horaSalida = $data->horaSalida;
    
        // Obtener datos del empleado por DNI
        $empleado = $this->model->obtenerEmpleadoPorDNI($dniSalida);
    
        if ($empleado) {
            $fechaHoy = date('Y-m-d');
    
            // Verificar si el empleado tiene un registro de entrada hoy
            $asistenciaExistente = $this->model->obtenerAsistenciaHoy($empleado['idEmpleado'], $fechaHoy);
            if (!$asistenciaExistente || empty($asistenciaExistente['hora_entrada'])) {
                echo json_encode(['error' => true, 'message' => 'El empleado debe marcar su entrada antes de registrar la salida.']);
                return;
            }
    
            // Verificar si el estado es "receso" y requiere finalizar receso
            if ($asistenciaExistente['estado'] === 'receso') {
                echo json_encode(['error' => true, 'message' => 'El empleado debe finalizar su receso antes de registrar la salida.']);
                return;
            }
    
            // Obtener el turno asignado al empleado
            $turno = $this->model->obtenerTurnoEmpleado($empleado['idTurno']);
            if (!$turno) {
                echo json_encode(['error' => true, 'message' => 'No se pudo encontrar el turno asignado al empleado.']);
                return;
            }
    
            // Convertir las horas a timestamps
            $horaEntradaTurno = strtotime($turno['entrada']);
            $horaSalidaTurno = strtotime($turno['salida']);
            $horaMarcadaSalida = strtotime($horaSalida);
            $horaEntradaReal = strtotime($asistenciaExistente['hora_entrada']);
    
            // Calcular horas extras usando el método del modelo
            $horasExtras = $this->model->calcularHorasExtras(
                $horaEntradaReal,
                $horaEntradaTurno,
                $horaMarcadaSalida,
                $horaSalidaTurno
            );
    
            // Verificar si intenta salir antes de la hora de salida del turno
            if ($horaMarcadaSalida < $horaSalidaTurno) {
                echo json_encode(['error' => true, 'message' => 'El empleado no puede registrar salida antes de la hora de salida del turno.']);
                return;
            }
    
            // Registrar la salida y las horas extras acumuladas
            $this->model->registrarSalida($empleado['idEmpleado'], $horaSalida, $horasExtras);
    
            // Actualizar el estado a "salida"
            $this->model->actualizarEstado($empleado['idEmpleado'], 'salida');
    
            echo json_encode([
                'error' => false, 
                'message' => 'Salida registrada correctamente. Se han acumulado ' . number_format($horasExtras, 2) . ' horas extras.',
            ]);
        } else {
            echo json_encode(['error' => true, 'message' => 'Empleado no encontrado.']);
        }
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
