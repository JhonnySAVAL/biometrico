<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $title ?? 'Sistema' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE | Dashboard v3">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha256-tAJd9aMy2uLWbOX1s+Nlrz1h4XbGPV4IMkuKb2u7wZ0=" crossorigin="anonymous">
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

                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard" class="nav-link">
                                <i class="nav-icon bi bi-house-door"></i>
                                <p> Dashboard </p>
                            </a>
                        </li>

                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Empleados <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario" class="nav-link">
                                        <i class="nav-icon bi bi-person-lines-fill"></i>
                                        <p>Lista</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/UsuariosController/UsuariosCrearController.php?action=vistaAgregarUsuario" class="nav-link">
                                        <i class="nav-icon bi bi-person-add"></i>
                                        <p>Registrar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-calendar-check"></i>
                                <p>Asistencias <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=mostrarAsistencia" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-event"></i>
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
                                        <i class="nav-icon bi bi-calendar-check"></i>
                                        <p>Justificaciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/ExoneracionesController.php?action=MostrarExoneraciones" class="nav-link">
                                        <i class="nav-icon bi bi-check-circle"></i>
                                        <p>Exoneraciones</p>
                                    </a>
                                </li>
                               <!-- <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/ReportesController.php?action=generarReporteGeneral" class="nav-link">
                                        <i class="nav-icon bi bi-file-earmark-bar-graph"></i>
                                        <p>Reportes</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>

                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-book"></i>
                                <p>Vacaciones <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=MostrarVacacionesProgramadas" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-day"></i>
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
                                <i class="nav-icon bi bi-gear"></i>
                                <p>Configuraciones <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">


                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AdminController/AdminController.php?action=vistaAgregarAdmin" class="nav-link">
                                        <i class="nav-icon bi bi-speedometer"></i>
                                        <p>Registrar Administradores</p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=mostrarFeriados" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-day"></i>
                                        <p>Ver Feriados</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=MostrarPuestos" class="nav-link">
                                        <i class="nav-icon bi bi-people"></i>
                                        <p>Puestos</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos" class="nav-link">
                                        <i class="nav-icon bi bi-clock"></i>
                                        <p>Turnos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/MarcarController/MarcarController.php?action=Marcado" class="nav-link">
                                <i class="nav-icon bi bi-house-door"></i>
                                <p> Marcar Asistencia </p>
                            </a>
                        </li>

                        <li class="nav-header">---------------------------------</li>
                        <li class="nav-item">
                            <a href="/biometrico/sistema/controller/AutenticacionController/logout.php" id="cerrarSesion" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
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