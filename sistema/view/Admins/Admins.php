<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Registrar Admin</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6"> <!-- El formulario ahora ocupará el 80% del ancho -->
            <div class="card mb-6 align-items-center">
                <div class="card-body col-md-10">
                    <!-- Mostrar errores si existen -->
                    <?php if (!empty($errores)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errores as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form id="formCrearAdmin" action="../../controller/AdminController/AdminController.php?action=CrearAdmin" method="POST">
                        
                        <div class="row mb-4">
                            <!-- Aumenté el ancho de los campos -->
                            <div class="form-group col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo se permiten letras y espacios." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo se permiten letras y espacios." required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" pattern="^\d{8}$" maxlength="8" title="Ingrese un DNI válido (8 dígitos numéricos)." required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="regsitraremp">Registrar Admin</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <button class="btn btn-warning" id="limpiar">Limpiar</button>
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-8 -->
    </div> <!-- end::Row -->
</div> <!-- end::Container -->