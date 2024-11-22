<?php

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
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook)\.(com|org|net|edu)$/i', $correo)) {
            $errores[] = "Correo inválido. Solo se permiten cuentas de Gmail, Hotmail u Outlook con dominios .com, .org, .net o .edu.";
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
            $crearModel = new AgregarUsuarioModel();
            if ($crearModel->verificarDniExistente($dni)) {
                // Agregar el error si el DNI ya existe
                $errores[] = "El DNI ya está registrado. Por favor ingresa un DNI diferente.";
            }
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
