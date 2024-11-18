<div class="app-content">
    <div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#marcarEntradaModal">Registrar Entrada</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#marcarSalidaModal">Registrar Salida</button>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" id="btnTodosEmpleados">Todos los Empleados</button>
            <button class="btn btn-primary" id="btnEmpleadosConEntrada">Empleados con Entrada Marcada</button>
            <button class="btn btn-primary" id="btnEmpleadosAusentes">Empleados Ausentes</button>
            <button class="btn btn-primary" id="btnEmpleadosConFalta">Empleados con Falta</button>
        </div>

        <div class="row" id="empleadosListado">
            <div class="col-lg-12" id="empleadosGenerales">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Lista de Empleados</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($listaEmpleados as $empleado): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $empleado['nombres']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="empleadosEntrada" style="display:none;">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados con Entrada Marcada</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($empleadosEntrada as $empleado): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $empleado['nombres']; ?>
                                    <span>
                                        
                                        <?php ?>
                                            <span class="badge badge-success">A Tiempo</span>
                                        <?php  ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="empleadosAusentes" style="display:none;">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados Ausentes</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($empleadosAusentes as $empleado): ?>
                                <li class="list-group-item">
                                    <?php echo $empleado['nombres']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="empleadosConFalta" style="display:none;">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h4>Empleados con Falta</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($empleadosConFalta as $empleado): ?>
                                <li class="list-group-item">
                                    <?php echo $empleado['nombres']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        

    </div>
</div>
  <div class="modal fade" id="marcarEntradaModal" tabindex="-1" role="dialog" aria-labelledby="marcarEntradaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarEntrada" method="POST">
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
                                   
                                    <?php foreach ($listaEmpleados as $empleado): ?>
                                        <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo $empleado['nombres']; ?></option>
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
<!-- Modal para registrar la salida -->
<div class="modal fade" id="marcarSalidaModal" tabindex="-1" role="dialog" aria-labelledby="marcarSalidaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="javascript:void(0)" method="POST"> <!-- No recargamos la página -->
                <div class="modal-header">
                    <h5 class="modal-title" id="marcarSalidaModalLabel">Registrar Salida Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empleadoIdSalida">Seleccionar Empleado</label>
                        <select id="empleadoIdSalida" class="form-control" required>
                            <?php foreach ($listaEmpleados as $empleado): ?>
                                <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo $empleado['nombres']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="marcarSalida(document.getElementById('empleadoIdSalida').value)">Registrar Salida</button>
                </div>
            </form>
        </div>
    </div>
</div>


        </div>
        </div>
        </div>