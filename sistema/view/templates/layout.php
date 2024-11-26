<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="../../resources/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">

    <?php if (!empty($additionalCss)) : ?>
        <?php foreach ($additionalCss as $cssFile) : ?>
            <link rel="stylesheet" href="<?= $cssFile ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard" class="nav-link">Inicio</a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li>

                </ul>
            </div>
        </nav>


        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard" class="brand-link">
                    <img src="../../resources/img/minaLogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">316 Mining</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                        <!-- Menú de navegación -->
                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard" class="nav-link">
                                <i class="nav-icon bi bi-house-door"></i>
                                <p> Dashboard </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario" class="nav-link">
                            <i class="nav-icon bi bi-person-fill"></i>
                            <p> Empleados </p>
                            </a>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-calendar-check"></i>
                                <p>Asistencias <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=mostrarEstadoAsistencias" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-event-fill"></i>
                                        <p>Ver Asistencias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=MostrarPermisos" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-minus"></i>
                                        <p>Permisos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/JustificacionesController.php?action=MostrarJustificaciones" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-check-fill"></i>
                                        <p>Justificaciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/ExoneracionesController.php?action=MostrarExoneraciones" class="nav-link">
                                        <i class="nav-icon bi bi-check-circle-fill"></i>
                                        <p>Exoneraciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ReportesController/ReportesController.php?action=mostrarReportes" class="nav-link">
                                        <i class="nav-icon bi bi-graph-up-arrow"></i>
                                        <p>Reportes</p>
                                    </a>
                                </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-book-fill"></i>
                                <p>Vacaciones <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=MostrarVacacionesProgramadas" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-day-fill"></i>
                                        <p>Vacaciones Asignadas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=MostrarEmpleadosSinVacaciones" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-day"></i>
                                        <p>Vacaciones Sin Asignar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear-fill"></i>
                                <p>Configuraciones <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AdminController/AdminController.php?action=vistaAgregarAdmin" class="nav-link">
                                        <i class="nav-icon bi bi-person-plus-fill"></i>
                                        <p>Registrar Administradores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=mostrarFeriados" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-date-fill"></i>
                                        <p>Ver Feriados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=MostrarPuestos" class="nav-link">
                                        <i class="nav-icon bi bi-people-fill"></i>
                                        <p>Puestos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos" class="nav-link">
                                        <i class="nav-icon bi bi-clock-fill"></i>
                                        <p>Turnos</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/MarcarController/MarcarController.php?action=Marcado" class="nav-link">
                                <i class="nav-icon bi bi-clipboard-check-fill"></i>
                                <p> Marcar Asistencia </p>
                            </a>
                        </li>

                        <li class="nav-header">---------------------------------</li>
                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/AutenticacionController/logout.php" id="cerrarSesion" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Cerrar Sesión</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>




        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <?php include $viewPath; ?>
                    </div>
                </div>
            </div>
        </main>

    </div>
   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="../../public/js/sweetalert2@11.all.min.js"></script>
    <script src="../../resources/dist/js/adminlte.js"></script>
    <!-- Scripts adicionales -->
    <?php if (!empty($additionalJs)) : ?>
        <?php foreach ($additionalJs as $jsFile) : ?>
            <script src="<?= $jsFile ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>