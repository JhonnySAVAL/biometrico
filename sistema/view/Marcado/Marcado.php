<div class="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-lg-5 col-md-8 col-sm-10">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h3>Credenciales de Marcado</h3>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="../../controller/MarcarController/MarcarController.php?action=verificarCredenciales">
                    <!-- Campo de ID -->
                    <div class="mb-3">
                        <label for="idmarcar" class="form-label">ID de Marcado:</label>
                        <input 
                            type="text" 
                            id="idmarcar" 
                            name="idmarcar" 
                            class="form-control" 
                            placeholder="Ingrese su ID" 
                            required
                        >
                    </div>
                    <!-- Campo de Contraseña -->
                    <div class="mb-3">
                        <label for="passmarcar" class="form-label">Contraseña de Marcado:</label>
                        <input 
                            type="password" 
                            id="passmarcar" 
                            name="passmarcar" 
                            class="form-control" 
                            placeholder="Ingrese su contraseña" 
                            required
                        >
                    </div>
                    <!-- Botón de Enviar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Iniciar sesión</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                © 2024 Sistema Biométrico
            </div>
        </div>
    </div>
</div>
