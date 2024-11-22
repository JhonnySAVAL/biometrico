<?php
require_once __DIR__ . '/../../../vendor/autoload.php';


use Picqer\Barcode\BarcodeGeneratorPNG;

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/AgregarUsuarioModel.php';

class AgregarUsuarioController extends BaseController
{
    public function vistaAgregarUsuario()
    {
        $crearModel = new AgregarUsuarioModel();
        $puestos = $crearModel->MostrarPuestos();
        $turnos = $crearModel->MostrarTurnos();

        // Cargar la vista con datos de puestos y turnos
        $this->loadView('Usuarios.Crear', [
            'puestos' => $puestos,
            'turnos' => $turnos,
        ], [], ['/biometrico/sistema/view/usuarios/js/limpiar.min.js'], 'Usuarios');
    }

    private function validarDatosUsuario($nombres, $apellidos, $dni, $correo, $telefono)
    {
        $errores = [];

        // Validar nombres y apellidos
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombres)) {
            $errores[] = "Nombres inválidos. Solo se permiten letras y espacios.";
        }
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellidos)) {
            $errores[] = "Apellidos inválidos. Solo se permiten letras y espacios.";
        }

        // Validar DNI (exactamente 8 dígitos)
        if (!preg_match('/^\d{8}$/', $dni)) {
            $errores[] = "DNI inválido. Debe contener 8 dígitos numéricos.";
        }

        // Validar correo electrónico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || !preg_match('/\.(com|org|net|edu)$/', $correo)) {
            $errores[] = "Correo inválido. Debe ser un correo válido con dominio permitido.";
        }

        // Validar teléfono (exactamente 9 dígitos)
        if (!preg_match('/^\d{9}$/', $telefono)) {
            $errores[] = "Teléfono inválido. Debe contener 9 dígitos numéricos.";
        }

        return $errores;
    }

    // Método para procesar la creación de un nuevo usuario
    public function agregarUsuario()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener datos del formulario
        $nombres = trim($_POST['nombres']);
        $apellidos = trim($_POST['apellidos']);
        $dni = trim($_POST['dni']);
        $correo = trim($_POST['correo']);
        $telefono = trim($_POST['telefono']);
        $puesto = $_POST['puesto'];
        $turno = $_POST['turno'];
        $habilitado = isset($_POST['habilitado']) ? 1 : 0;

        $errores = $this->validarDatosUsuario($nombres, $apellidos, $dni, $correo, $telefono);
        if (!empty($errores)) {
            // Si hay errores, recargar la vista con mensajes de error
            $crearModel = new AgregarUsuarioModel();
            $puestos = $crearModel->MostrarPuestos();
            $turnos = $crearModel->MostrarTurnos();

            $this->loadView('Usuarios.Crear', [
                'puestos' => $puestos,
                'turnos' => $turnos,
                'errores' => $errores, // Pasar los errores a la vista
            ]);
            return;
        }

        // Ahora ya no se genera ni guarda el código de barras
        // Solo se agregan los datos del usuario
        $crearModel = new AgregarUsuarioModel();
        $crearModel->agregarUsuario($nombres, $apellidos, $dni, $correo, $telefono, $puesto, $turno, $habilitado);

        if (!headers_sent()) {
            header('Location: /biometrico/sistema/controller/UsuariosController/UsuariosCrearController.php?action=VistaAgregarUsuario&success=true');
            exit();
        }
    }
}

}
if (isset($_GET['action'])) {
    $controller = new AgregarUsuarioController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
