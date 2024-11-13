
<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard v3
        </li>
    </ol>
</div>
</div> 
</div> 
</div>
<div class="app-content"> 
    <div class="container-fluid"> 
        <div class="row">


        <div class="app-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#marcarEntradaModal">Registrar Entrada</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#marcarSalidaModal">Registrar Salida</button>
        </div>

        <div class="row">
            <!-- Card: Empleados que han marcado su entrada -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados con Entrada Marcada</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Iterar sobre los empleados que han marcado entrada -->
                            <?php foreach ($empleadosEntrada as $empleado): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $empleado['nombre']; ?>
                                    <span>
                                        <?php if ($empleado['tardanza']): ?>
                                            <span class="badge badge-danger">Tardanza</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">A Tiempo</span>
                                        <?php endif; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card: Empleados Ausentes -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados Ausentes</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Iterar sobre los empleados ausentes -->
                            <?php foreach ($empleadosAusentes as $empleado): ?>
                                <li class="list-group-item">
                                    <?php echo $empleado['nombre']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card: Empleados con Falta Registrada -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados con Falta</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Iterar sobre los empleados con falta registrada -->
                            <?php foreach ($empleadosConFalta as $empleado): ?>
                                <li class="list-group-item">
                                    <?php echo $empleado['nombre']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Registrar Entrada -->
<div class="modal fade" id="marcarEntradaModal" tabindex="-1" role="dialog" aria-labelledby="marcarEntradaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/biometrico/sistema/controller/AsistenciaController.php?action=marcarEntrada" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="marcarEntradaModalLabel">Registrar Entrada Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empleadoId">Seleccionar Empleado</label>
                        <select name="empleadoId" id="empleadoId" class="form-control" required>
                            <!-- Opciones de empleados -->
                            <?php foreach ($listaEmpleados as $empleado): ?>
                                <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo $empleado['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar Entrada</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Registrar Salida -->
<div class="modal fade" id="marcarSalidaModal" tabindex="-1" role="dialog" aria-labelledby="marcarSalidaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/biometrico/sistema/controller/AsistenciaController.php?action=marcarSalida" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="marcarSalidaModalLabel">Registrar Salida Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empleadoIdSalida">Seleccionar Empleado</label>
                        <select name="empleadoId" id="empleadoIdSalida" class="form-control" required>
                            <!-- Opciones de empleados -->
                            <?php foreach ($listaEmpleados as $empleado): ?>
                                <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo $empleado['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar Salida</button>
                </div>
            </form>
        </div>
    </div>
</div>


            
        </div>
    </div>
</div>