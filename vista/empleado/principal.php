<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Principal - Sistema de Gestion Bibliotecaria</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/listado.css">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>

<body>
  <?php if (isset($_SESSION["autenticado"]) && $_SESSION["empleado"]) { ?>

    <style>
      body {
        background-image: url("../../vista/images/Biblioteca.jpg");
        background-color: #ced5f5;
        height: 500px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
      }
      .bg-company-red {
        background-color: #55AEEF !important;
     }
      
     .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
       background-color: #55AEEF  !important;
     }
     .bg-success {
    background-color: #80CD5A !important;
}
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark  bg-company-red px-4">
      <a class="navbar-brand" href="#">
        <img src="../images/Libro.png" class="" width="30" height="30" alt="">
      </a>
      <a class="navbar-brand" href="../../vista/usuarios/principal.php">Sistema de Gestion Bibliotecaria</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link text-white" href="../../vista/libro/listar_libro.php"> Libros</a>
          <a class="nav-item nav-link text-white" href="../../vista/empleado/listar_empleado.php"> Personal</a>
          <a class="nav-item nav-link text-white" href="../../vista/prestamo/listar_prestamo.php"> Prestamos</a>
          <a class="nav-item nav-link text-white" href="../../vista/sancion/listar_sancion.php"> Sanciones</a>
          <a class="nav-item nav-link text-white" href="../../vista/usuarios/listar_usuarios.php"> Usuarios</a>
          <form action="principal.php" method="post">
            <button type="submit" name="logout" value="true" class="nav-item nav-link text-white" href="principal.php">Cerrar Sesion </button>
          </form>
        </div>
      </div>
    </nav>

    <div class="modal-dialog principalModal-confirm">
      <div class="modal-content">
        <div class="modal-header bg-company-red text-white">
          <div class="icon-box bg-success text-white ">
            <i class="material-icons">&#xE876;</i>
          </div>
          <h4 class="modal-title w-100">Bienvenido<br><?php echo $_SESSION["nombre"] ?></h4>

        </div>
        <div class="modal-body">
          <p class="text-center">Has iniciado sesion exitosamente.</p>
          <p class="text-center text-success">ID de sesion:<?php echo session_id() ?></p>
          <p class="text-center text-success">ID de empleado:<?php echo $_SESSION["idEmpleado"] ?></p>
          <p class="text-center text-success">Tipo de empleado:<?php echo $_SESSION["tipoEmpleado"] ?></p>

        </div>
        <div class="modal-footer">
          <a href="../../vista/empleado/listar_empleado.php" class="btn btn-primary btn-block my-auto w-50 bg-info text-white">Ver Registro</a>
          <form class=" w-50" action="principal.php" method="post">
            <button type="submit" name="logout" value="true" class="btn btn-primary btn-block my-auto bg-info text-white">Cerrar Sesion</button>
          </form>
          <?php
          if (isset($_POST["logout"])) {
            session_unset();
            header("Location: login.php");
            die();
          }
          ?>
        </div>
      </div>
    </div>

  <?php } else { ?>

    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="icon-box">
            <i class="material-icons">&#xE5CD;</i>
          </div>
        </div>
        <div class="modal-body text-center">
          <h4>Acceso denegado!</h4>
          <p>Esta es un area restringida, para acceder debe iniciar sesion.</p>
          <a href="login.php" class="btn btn-success">Iniciar Sesion</a>
        </div>
      </div>
    </div>

  <?php } ?>

</body>

</html>