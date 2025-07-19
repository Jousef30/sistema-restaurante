<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['correo']) || empty($_POST['pass'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese correo y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['correo']);
            $pass = md5(mysqli_real_escape_string($conexion, $_POST['pass']));
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$user' AND pass = '$pass'");
            mysqli_close($conexion);
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['id'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['rol'] = $dato['rol'];
                header('Location: src/dashboard.php');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<!-- Reemplaza tu <body> y su contenido con este: -->

<body class="hold-transition login-page" style="background: #f8f9fa;">
<div class="login-box">
  <div class="login-logo">
    <img src="src/img/DIANA_LOGO2.png" alt="Logo del Restaurante" class="img-fluid mb-2" style="width: 150px;">
  </div>

  <div class="card shadow-lg rounded">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-muted">Bienvenido 👋, por favor ingresa tus credenciales</p>

      <?php echo (isset($alert)) ? $alert : '' ; ?>  

      <form action="" method="post" autocomplete="off">
        <div class="input-group mb-3">
          <input type="email" class="form-control rounded-pill" name="correo" placeholder="Correo electrónico" required>
          <div class="input-group-append" style="margin-left:7px;">
            <div class="input-group-text rounded-pill">
              <span class="fas fa-envelope text-primary"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control rounded-pill" name="pass" placeholder="Contraseña" required>
          <div class="input-group-append" style="margin-left:7px;">
            <div class="input-group-text rounded-pill">
              <span class="fas fa-lock text-primary"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-8">
            <button type="submit" class="btn btn-success btn-block rounded-pill shadow-sm">
              <i class="fas fa-sign-in-alt mr-1"></i> Ingresar
            </button>
          </div>
        </div>
      </form>

      <div class="mt-4 text-center">
        <small class="text-muted">Sistema desarrollado para Restaurante DIANA 🍽️</small>
      </div>
    </div>
  </div>
</div>

</html>
