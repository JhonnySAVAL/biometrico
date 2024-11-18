<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .vh-100 {
      background: url('/biometrico/sistema/resources/img/login.png') no-repeat center center;
      background-size: cover;
    }
    .card {
      border-radius: 1rem;
      background-color: rgba(0,0,0, 0.6); /* Fondo blanco con opacidad */
      border: none; 
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.8); 
    }
    .btn-dark {
      background-color: #343a40; /* Mantener el color del botón */
      border: none; 
      
    transition: all 0.3s ease;
    }
    .btn-dark:hover {
      background-color: #191c1f; 
      
    transition: all 0.3s ease;
    }
  </style>
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-9">
          <div class="card">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="/biometrico/sistema/resources/img/form.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form action="/biometrico/sistema/controller/AutenticacionController/login.php" method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mb-0" style="color: white;">316 Mining</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style=" color: white">Bienvenido, por favor ingrese sus credenciales</h5>
                    <div class="form-outline mb-4">
                      <input type="text" id="usuario" name="usergen" class="form-control form-control-lg" placeholder="ID de administrador" required />
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" id="dni" name="passgen" class="form-control form-control-lg"placeholder="Contraseña de administrador" required />
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Iniciar sesión</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    <?php if (isset($_SESSION['success_message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Acceso exitoso',
            text: '<?php echo $_SESSION['success_message']; ?>',
            timer: 3000
        });
        <?php unset($_SESSION['success_message']); // Limpiar el mensaje ?>
    <?php endif; ?>

    // Verifica si hay un mensaje de error
    <?php if (isset($_SESSION['error_message'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo $_SESSION['error_message']; ?>',
            timer: 5000
        });
        <?php unset($_SESSION['error_message']); // Limpiar el mensaje ?>
    <?php endif; ?>
</script>


</script>
</body>
</html>
