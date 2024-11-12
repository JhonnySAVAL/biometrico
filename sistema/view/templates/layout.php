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
        <link rel="stylesheet" href="../../resources/dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
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
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                        <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="../resources/dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <li class="user-header text-bg-primary"> <img src="../resources/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2023</small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                        <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                                        <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                    </div>
                                </li>
                                <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Profile</a> <a href="/biometrico/web/view/index.html" class="btn btn-default btn-flat float-end">Sign out</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
                <div class="sidebar-brand"> <a href="./index.php" class="brand-link"> <img src="../../resources/img/minaLogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <span class="brand-text fw-light">316 Mining</span> </a> </div>
                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false" color="#8b783d">
                            <li class="nav-item"> <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item"> <a href="/biometrico/sistema/controller/AsistenciaController/AsistenciaController.php?=VerAsistencias" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>
                                        Asistencia</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item menu-close"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Empleados
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"> <a href="/biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                                            <p>Lista</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="/biometrico/sistema/controller/UsuariosController/UsuariosCrearController.php?action=vistaAgregarUsuario" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Registrar</p>
                                        </a> </li>
                                </ul>
                            </li>

                            <li class="nav-item menu-close"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Puestos
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"> <a href="/biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=MostrarUsuario" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                                            <p>Lista</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="./index2.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Registrar</p>
                                        </a> </li>
                                </ul>

                            <li class="nav-item menu-close"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Configuraciones
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"> <a href="/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=MostrarPuestos" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                                            <p>Puestos</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=MostrarTurnos" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Turnos</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="./index2.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Feriados</p>
                                        </a> </li>
                                </ul>

                            </li>
                            <li class="nav-header">-------------------------------------------</li>
                            <li class="nav-item"> <a href="#" id="cerrarSesion" class="nav-link">
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

        <script src="../../public/js/sweetalert2@11.all.min.js"></script>
        <script src="../../public/js/logout.min.js"></script>
        <script src="../../resources/dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
        <script>
            const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
            const Default = {
                scrollbarTheme: "os-theme-light",
                scrollbarAutoHide: "leave",
                scrollbarClickScroll: true,
            };
            document.addEventListener("DOMContentLoaded", function() {
                const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
                if (
                    sidebarWrapper &&
                    typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
                ) {
                    OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                        scrollbars: {
                            theme: Default.scrollbarTheme,
                            autoHide: Default.scrollbarAutoHide,
                            clickScroll: Default.scrollbarClickScroll,
                        },
                    });
                }
            });
        </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- apexcharts -->
        <script>
            // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
            // IT'S ALL JUST JUNK FOR DEMO
            // ++++++++++++++++++++++++++++++++++++++++++

            const visitors_chart_options = {
                series: [{
                        name: "High - 2023",
                        data: [100, 120, 170, 167, 180, 177, 160],
                    },
                    {
                        name: "Low - 2023",
                        data: [60, 80, 70, 67, 80, 77, 100],
                    },
                ],
                chart: {
                    height: 200,
                    type: "line",
                    toolbar: {
                        show: false,
                    },
                },
                colors: ["#0d6efd", "#adb5bd"],
                stroke: {
                    curve: "smooth",
                },
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.5,
                    },
                },
                legend: {
                    show: false,
                },
                markers: {
                    size: 1,
                },
                xaxis: {
                    categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
                },
            };

            const visitors_chart = new ApexCharts(
                document.querySelector("#visitors-chart"),
                visitors_chart_options
            );
            visitors_chart.render();

            const sales_chart_options = {
                series: [{
                        name: "Net Profit",
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                    },
                    {
                        name: "Revenue",
                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                    },
                    {
                        name: "Free Cash Flow",
                        data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                    },
                ],
                chart: {
                    type: "bar",
                    height: 200,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                legend: {
                    show: false,
                },
                colors: ["#0d6efd", "#20c997", "#ffc107"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: [
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                    ],
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands";
                        },
                    },
                },
            };

            const sales_chart = new ApexCharts(
                document.querySelector("#sales-chart"),
                sales_chart_options
            );
            sales_chart.render();
        </script> <!--end::Script-->
    </body><!--end::Body-->

    <!-- Scripts adicionales -->
    <?php if (!empty($additionalJs)) : ?>
        <?php foreach ($additionalJs as $jsFile) : ?>
            <script src="<?= $jsFile ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    </body>

    </html>