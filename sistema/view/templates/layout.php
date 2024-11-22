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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../resources/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">

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
                                <!-- <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=listarPermisos" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-minus"></i>
                                        <p>Permisos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/JustificacionesController.php?action=listarJustificaciones" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-check"></i>
                                        <p>Justificaciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/biometrico/sistema/controller/AsistenciasController/ExoneracionesController.php?action=listarExoneraciones" class="nav-link">
                                        <i class="nav-icon bi bi-check-circle"></i>
                                        <p>Exoneraciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
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
                            <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php" class="nav-link">
                                <i class="nav-icon bi bi-house-door"></i>
                                <p> Marcar Asistencia </p>
                            </a>
                        </li>

                        <li class="nav-header">-------------------------------------------</li>
                        <li class="nav-item">
                            <a href="#" id="cerrarSesion" class="nav-link">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <!-- Agregar Bootstrap JS y jQuery antes de cerrar el </body> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../public/js/sweetalert2@11.all.min.js"></script>
    <script src="../../public/js/logout.min.js"></script>
    <script src="../../resources/dist/js/adminlte.js"></script>

    <!-- Scripts adicionales -->
    <?php if (!empty($additionalJs)) : ?>
        <?php foreach ($additionalJs as $jsFile) : ?>
            <script src="<?= $jsFile ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>