<!--Contenido-->
<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard v3
        </li>
    </ol>
</div>
</div> <!--end::Row-->
</div> <!--end::Container-->
</div>
<div class="app-content"> <!--begin::Container-->
<div class="container-fluid">
    <div class="row">
        <!-- Asistencias -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Asistencias</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asistencias as $asistencia): ?>
                                <tr>
                                    <td><?= $asistencia['nombre'] ?></td>
                                    <td><?= $asistencia['fechaRegistro'] ?></td>
                                    <td><?= $asistencia['horaEntrada'] ?></td>
                                    <td><?= $asistencia['horaSalida'] ?></td>
                                    <td><?= $asistencia['estado'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Justificaciones -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Justificaciones</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($justificaciones as $justificacion): ?>
                                <tr>
                                    <td><?= $justificacion['nombre'] ?></td>
                                    <td><?= $justificacion['fecha_inicio'] ?></td>
                                    <td><?= $justificacion['fecha_fin'] ?></td>
                                    <td><?= $justificacion['motivo'] ?></td>
                                    <td><?= $justificacion['estado'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

 <!-- <script>
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
        </script> 
        <script>
            

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
                        colors: ["#f3f3f3", "transparent"], 
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
        </script> -->
