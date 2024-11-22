<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/UsuarioModel/ListaModel.php';

class UsuariosController extends BaseController
{
    public function MostrarUsuario()
    {
        $listaModel = new ListaModel();

        // Obtener los datos de usuarios, puestos y turnos desde el modelo
        $empleados = $listaModel->getUsuarios();
        $puesto = $listaModel->MostrarPuestos();
        $turno = $listaModel->MostrarTurnos();

        // Cargar la vista con los datos
        $this->loadView('Usuarios.Lista', [
            'usuarios' => $empleados,
            'puestos' => $puesto,
            'turnos' => $turno,
        ], [], ['/biometrico/sistema/view/Usuarios/js/editarEmpleado.min.js'], 'Usuarios');
    }
    private function validarDatosUsuario($nombres, $apellidos, $correo, $telefono)
    {
        $errores = [];

        // Validar nombres y apellidos
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombres)) {
            $errores[] = "Nombres inválidos. Solo se permiten letras y espacios.";
        }
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellidos)) {
            $errores[] = "Apellidos inválidos. Solo se permiten letras y espacios.";
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

    public function actualizarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $puesto = $_POST['puesto'];
            $turno = $_POST['turno'];
            $habilitado = isset($_POST['habilitado']) ? 1 : 0;

            // Validación de los campos obligatorios
            if (empty($nombres) || empty($apellidos) || empty($correo) || empty($puesto) || empty($turno)) {
                header('Location: editar.php?error=1'); // Redirigir con un parámetro de error
                exit();
            }

            // Llamada al modelo para actualizar el empleado
            $listaModel = new ListaModel();
            $resultado = $listaModel->ActualizarEmpleado($idEmpleado, $nombres, $apellidos, $correo, $telefono, $puesto, $turno, $habilitado);

            // Redirigir con el parámetro 'success' si la actualización fue exitosa, o con 'error' si hubo un problema
            if ($resultado) {
                header('Location: /biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario&success=true'); // Redirigir con éxito
            } else {
                header('Location: /biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario&success=false'); // Redirigir con error
            }
            exit();
        }
    }
}

// Ejecutar el controlador si la acción está definida
if (isset($_GET['action'])) {
    $controller = new UsuariosController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
