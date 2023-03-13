<?php
session_start();
require("../../modelo/empleado.php");
$empleados = new Empleado;
$con = $empleados->conexion();
$respuesta = array();
?>
<!DOCTYPE html>
<html>

<head>
  <title> Iniciar sesion - Sistema de Gestion Bibliotecaria </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="stylesheet" href="../css/listado.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<style>
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }
</style>

<body>
  <?php
  if (isset($_SESSION["autenticado"])) { ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
      <a class="navbar-brand" href="principal.php">Sistema de Gestion Bibliotecaria</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link " href="principal.php">Principal <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link " href="listado.php">Listado</a>
          <form action="listado.php" method="post">
            <button type="submit" name="logout" value="true" class="nav-item nav-link" href="#">Logout </button>
          </form>
        </div>
      </div>
    </nav>

    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="icon-box">
            <i class="material-icons">&#xE5CD;</i>
          </div>
        </div>
        <div class="modal-body text-center">
          <h4>Sesion iniciada!</h4>
          <p>Parece que ya tienes una sesion iniciada. Por favor cerrar sesion.</p>
          <form action="login.php" method="post">
            <button type="submit" name="logout" value="true" class="btn btn-success" href="#">Cerrar sesion </button>
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
  <?php
  } else {
  ?>
    <style>
      body {
        background-image: url("../../vista/images/Biblioteca2.PNG");
        background-color: #cccccc;
        height: 1000px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
      }
    </style>

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="modal-dialog modal-login">
            <div class="modal-content">
              <div class="modal-header">
                <div class="avatar">
                  <img src="../images/avatar.png" alt="Avatar" />
                </div>
                <h4 class="modal-title">Inicio de sesion.<br><sub>Sistema de Gestion Bibliotecario</sub></br></h4>
              </div>

              <div class="modal-body">
                <form method="POST" action="login.php">
                  <input id="accion" name="accion" value="iniciar_sesion" hidden />
                  <div class="form-group">
                    <input type="text" class="form-control w-100" id="usuario" name="usuario" placeholder="Usuario" required="required" />
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control w-100" id="clave" name="clave" placeholder="Contraseña" required="required" />
                  </div>
                  <div class="form-group">
                    <button type="submit" name="enviar" class="btn btn-login btn-primary btn-lg btn-block login-btn">
                      Iniciar sesion
                    </button>
                  </div>
                </form>
                 <a href="../usuarios/login.php" class="btn btn-link mt-3 mb-0">¿Eres Usuario? Entra aqui 


                <?php
                if (isset($_POST["enviar"])) {
                  $usuario = $_REQUEST["usuario"];
                  $clave = $_REQUEST["clave"];
                  $autenticado = false;

                  $respuesta = $empleados->login($usuario, $clave, $con);

                  if ($respuesta['exito'] == 1) {
                    $_SESSION["nombre"] = $usuario;
                    $_SESSION["autenticado"] = true;
                    $_SESSION["empleado"] = true;
                    $_SESSION["idEmpleado"] =  $respuesta['registros']['id_empleado'];
                    $_SESSION["tipoEmpleado"] =  $respuesta['registros']['tipo_empleado_id_tipo_empleado'];
                    $autenticado = true;
                  }

                  if ($autenticado == true) {
                    header("Location: principal.php");
                    die();
                  } else {
                    print_r('<div class="alert alert-danger" role="alert">Usuario y/o contraseña incorrectos</div>');
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }
  ?>

</body>

</html>