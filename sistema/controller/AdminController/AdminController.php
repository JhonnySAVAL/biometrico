<?php

require_once '../BaseController.php';
require_once __DIR__ . '/../../model/AdminModel/AdminModel.php';

class AdminController extends BaseController
{
    public function vistaAgregarAdmin()
    {
        $crearModel = new AdminModel();

        // Cargar la vista con datos de puestos y turnos
        $this->loadView('Admins.Admins', [
        ], [], ['/biometrico/sistema/view/Admins/js/limpiarformadmin.min.js'], 'CrearAdmin');
    }
    public function CrearAdmin()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];

        // Validación básica de los datos
        $errores = [];
        if (empty($nombres) || empty($apellidos) || empty($dni)) {
            $errores[] = "Todos los campos son obligatorios.";
        }
        if (!preg_match('/^\d{8}$/', $dni)) {
            $errores[] = "El DNI debe ser un número de 8 dígitos.";
        }

        // Si hay errores, volver a mostrar el formulario con los errores
        if (count($errores) > 0) {
            $this->loadView('Admins.Admins', [
                'errores' => $errores
            ]);
            return;
        }

        // Generar el nombre de usuario: los dos primeros caracteres de los nombres y apellidos
        $usergen = strtolower(substr($nombres, 0, 2) . substr($apellidos, 0, 2));

        // Generar la contraseña: los primeros 5 caracteres del hash MD5 del DNI
        $passgen = substr(md5($dni), 0, 5);

        // Instanciar el modelo y llamar al método de inserción
        $adminModel = new AdminModel();
        $resultado = $adminModel->insertAdmin($nombres, $apellidos, $dni, $usergen, $passgen);

        if ($resultado) {
            // Redirigir a una página de éxito o de lista de administradores
            header('Location: /biometrico/sistema/controller/AdminController/AdminController.php?action=VistaAgregarAdmin&success=true');
            exit();
        } else {
            // Si ocurrió un error, mostrarlo al usuario
            $errores[] = "Hubo un error al registrar al administrador.";
            $this->loadView('Admins.Admins', [
                'errores' => $errores
            ]);
        }
    }
}

}

// Ejecutar el controlador si la acción está definida
if (isset($_GET['action'])) {
    $controller = new AdminController();
    $action = $_GET['action'];

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
}
