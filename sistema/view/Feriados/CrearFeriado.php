<div class="col-sm-6">
    <h3 class="mb-0"></h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Vacaciones sin programar
        </li>
    </ol>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <div class="row">

                    
                <form method="POST">
    <label for="nombre">Nombre del Feriado:</label>
    <input type="text" name="nombre" required>
    
    <label for="fecha">Fecha (YYYY-MM-DD):</label>
    <input type="date" name="fecha" required>
    
    <label for="tipo">Tipo:</label>
    <select name="tipo">
        <option value="simple">Feriado Simple</option>
        <option value="anual">Feriado Anual</option>
    </select>
    
    <label for="año">Año:</label>
    <input type="number" name="año" value="<?= date('Y') ?>" required>
    
    <button type="submit">Crear Feriado</button>
</form>

                
                </div>
            </div>

        </div>
    </div>
</div>

