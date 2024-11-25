<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
    }

    td {
        height: 50px;
    }

    .btn-fecha {
        width: 100%;
        padding: 10px;
        background-color: #f8f9fa;
        border: none;
        cursor: pointer;
    }

    .btn-fecha:hover {
        background-color: #e2e6ea;
    }

    .seleccionable {
        cursor: pointer;
        border: none;
        background-color: #f8f9fa;
        transition: background-color 0.2s;
    }

    .seleccionable:hover {
        background-color: #e2e6ea;
    }
</style>
<div class="col-sm-6">
    <h3 class="mb-0">Reportes</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reportes</li>
    </ol>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button id="btnVacaciones" class="btn btn-primary mx-1" style="display: none;">Reporte de Vacaciones</button>
                            <button id="btnAsistencias" class="btn btn-success mx-1" style="display: none;">Reporte de Asistencias</button>
                            <button id="btnFeriados" class="btn btn-warning mx-1" style="display: none;">Reporte de Feriados</button>
                            <button id="btnPermisos" class="btn btn-secondary mx-1" style="display: none;">Reporte de Permisos</button>
                            <button id="btnExoneraciones" class="btn btn-danger mx-1" style="display: none;">Reporte de Exoneraciones</button>
                        </div>

                        <?php
                        // Generar el calendario
                        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
                        function generarCalendario($mes, $año) {
                            $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
                            $primerDiaMes = mktime(0, 0, 0, $mes, 1, $año);
                            $diasEnMes = date('t', $primerDiaMes);
                            $diaSemanaInicio = date('N', $primerDiaMes);
                            $nombreMes = strftime('%B', $primerDiaMes);

                            echo "<table border='1' style='width:100%; text-align:center;'>";
                            echo "<tr><th colspan='7' style='background-color: #f4f4f4;'>" . ucfirst($nombreMes) . " $año</th></tr>";
                            echo "<tr>";
                            foreach ($diasSemana as $dia) {
                                echo "<th style='background-color: #f0f0f0;'>$dia</th>";
                            }
                            echo "</tr><tr>";

                            for ($i = 1; $i < $diaSemanaInicio; $i++) {
                                echo "<td></td>";
                            }
                            for ($dia = 1; $dia <= $diasEnMes; $dia++) {
                                $fechaCompleta = $año . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT);
                                echo "<td><button class='seleccionable' data-fecha='$fechaCompleta' style='width:100%; padding:10px;'>$dia</button></td>";
                                if (($dia + $diaSemanaInicio - 1) % 7 == 0) echo "</tr><tr>";
                            }

                            $espaciosRestantes = (7 - (($diasEnMes + $diaSemanaInicio - 1) % 7)) % 7;
                            for ($i = 0; $i < $espaciosRestantes; $i++) {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                            echo "</table>";
                        }
                        $mes = date('m');
                        $año = date('Y');
                        generarCalendario($mes, $año);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    let seleccionando = false;
    const botones = document.querySelectorAll('.seleccionable');
    const fechasSeleccionadas = new Set(); // Almacena las fechas seleccionadas
    const botonesReportes = {
        vacaciones: document.getElementById('btnVacaciones'),
        asistencias: document.getElementById('btnAsistencias'),
        feriados: document.getElementById('btnFeriados'),
        permisos: document.getElementById('btnPermisos'),
        exoneraciones: document.getElementById('btnExoneraciones'),
    };

    // Manejo de selección de fechas
    botones.forEach(boton => {
        boton.addEventListener('mousedown', () => {
            seleccionando = true;
            agregarFecha(boton);
        });
        boton.addEventListener('mouseover', () => {
            if (seleccionando) agregarFecha(boton);
        });
    });

    document.addEventListener('mouseup', () => {
        if (seleccionando) {
            seleccionando = false;
            activarBotones();
        }
    });

    // Agregar una fecha al conjunto
    function agregarFecha(boton) {
        const fecha = boton.getAttribute('data-fecha');
        if (!fechasSeleccionadas.has(fecha)) {
            fechasSeleccionadas.add(fecha);
            boton.style.backgroundColor = '#d1e7dd';
        }
    }

    // Activa los botones de reporte si hay fechas seleccionadas
    function activarBotones() {
        const hayFechasSeleccionadas = fechasSeleccionadas.size > 0;
        Object.values(botonesReportes).forEach(boton => {
            boton.style.display = hayFechasSeleccionadas ? 'block' : 'none';
        });
    }

    // Redirigir según el reporte seleccionado
    function redirigirReporte(tipo) {
        if (fechasSeleccionadas.size === 0) {
            alert('Selecciona al menos una fecha.');
            return;
        }

        const fechasArray = Array.from(fechasSeleccionadas); // Convertir Set a Array
        const params = new URLSearchParams({
            action: 'generarReporteTabla',
            tipo,
            fechas: JSON.stringify(fechasArray),
        });

        // Redirigir a la vista correspondiente
        window.location.href = `/biometrico/sistema/controller/ReportesController/ReportesController.php?${params.toString()}`;
    }

    // Asociar eventos a los botones de reporte
    botonesReportes.asistencias.addEventListener('click', () => redirigirReporte('asistencias'));
    botonesReportes.vacaciones.addEventListener('click', () => redirigirReporte('vacaciones'));
    botonesReportes.feriados.addEventListener('click', () => redirigirReporte('feriados'));
    botonesReportes.permisos.addEventListener('click', () => redirigirReporte('permisos'));
    botonesReportes.exoneraciones.addEventListener('click', () => redirigirReporte('exoneraciones'));
});

</script>