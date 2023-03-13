<?php
session_start();
require_once("../../modelo/libro.php");
$libros = new Libro;
$con = $libros->conexion();
date_default_timezone_set("America/Caracas");

require_once("../../modelo/usuarios.php");
$usuarios = new Usuarios;
$conUsuarios = $usuarios->conexion();
?>

<!DOCTYPE html>
<html5>

  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../images/books.ico">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/listado.css">
    <link rel="stylesheet" href="../css/agregar_prestamo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Area de Prestamos</title>
  </head>

  <style>
    .bg-company-red {
      background-color: #55AEEF !important;
    }

    .table-title {
      padding-bottom: 15px;
      background: #9F9FE5;
      color: #fff;
      padding: 16px 30px;
      min-width: 100%;
      margin: -20px -25px 10px;
      border-radius: 3px 3px 0 0;
    }

    .btn-danger {
      background-color: #CD5A5A;
      color: #FFF;
      border-color: #2F3E48;
    }

    .btn-danger:hover,
    .btn-danger:focus,
    .btn-danger:active,
    .btn-danger.active,
    .open .dropdown-toggle.btn-danger {
      background-color: #CD5A5A;
      color: #FFF;
      border-color: #31347B;
    }

    .btn-primary,
    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:visited {
      background-color: #55AEEF !important;
    }
  </style>

  <body>
    <?php if (isset($_SESSION["autenticado"])) { ?>

      <nav class="navbar navbar-expand-lg  navbar-dark bg-company-red px-4">
        <a class="navbar-brand" href="#">
          <img src="../images/Libro.png" class="" width="30" height="30" alt="">
        </a>
        <a class="navbar-brand mx-auto" href="../../vista/prestamo/devolver.php">Realizar Prestamo</a>
        <a class="nav-item nav-link text-white" href="../../vista/prestamo/listar_prestamos.php">Volver a la lista</a>
      </nav>

      <?php if (!isset($_POST["stage1"]) && !isset($_POST["stage2"]) && !isset($_POST["stage3"])  && !isset($_POST["stage4"]) && !isset($_POST["stage5"])) { ?>
        <?php
        unset($_SESSION['idPrestamo']);
        unset($_SESSION['resultados_usuarios']);
        unset($_SESSION['nombre_completo']);
        unset($_SESSION["idEstudiante"]);
        unset($_SESSION["nombre_completo"]);
        unset($_SESSION["fecha_prestamo"]);
        unset($_SESSION["fecha_vencimiento"]);
        unset($_SESSION["vencido"]);
        unset($_SESSION["idPrestamo"]);
        unset($_SESSION["libro_id_libro"]);
        unset($_SESSION["codigo_ejemplar"]);
        ?>

        <div id="buscar-estudiante" class="container buscar-estudiante">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col">
                    <h2>Buscar <b>Estudiante</b></h2>
                  </div>
                </div>
              </div>
              <form method="POST" action="devolver.php">
                <table class="table">
                  <tr>
                    <td class="border-0" align="center"><input type="text" id="cedula_estudiante" name="cedula_estudiante" class="form-control" size="20" maxlength="30" onkeypress="return SoloNumeros(event)" placeholder="Ingrese numero de cedula"></td>
                  </tr>
                  <tr>
                    <td class="border-0" colspan="2" align="center">
                      <input type="submit" name="stage1" id="stage1" value="Consultar" class="btn btn-primary boton-submit">
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>

      <?php } ?>

      <?php if (isset($_POST["stage1"])) { ?>
        <?php
        $cedula_estudiante = $_REQUEST["cedula_estudiante"];
        $encontrado = false;

        $respuestaEstudiante = $usuarios->buscarPrestamo($cedula_estudiante, $conUsuarios);

        if ($respuestaEstudiante['exito'] == 1) {
          $estudianteEncontrado = true;
          $_SESSION["resultados_usuarios"] = $respuestaEstudiante['registros'];
        } else {
          $estudianteEncontrado = false;
        }
        ?>
        <div id="resultados-estudiantes" class="container resultados-estudiantes">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col">
                    <h3>Resultado de la <b>Consulta</b></h3>
                  </div>
                </div>
              </div>
              <?php if ($estudianteEncontrado) { ?>

                <table class="table">
                  <tr>
                    <td align="center" class="cabecera_columna">Nº cedula</td>
                    <td align="center" class="cabecera_columna">Nombre Completo</td>
                    <td align="center" class="cabecera_columna">Fecha Inicio</td>
                    <td align="center" class="cabecera_columna">Fecha Fin</td>
                    <td align="center" class="cabecera_columna">Nº prestamo</td>
                    <td align="center" class="cabecera_columna">Id libro</td>
                    <td align="center" class="cabecera_columna">Cod. Ejemplar</td>
                    <td align="center" class="cabecera_columna">Devolver</td>
                  </tr>
                  <?php
                  echo "<tr>";
                  while (($fila = $respuestaEstudiante['registros']->fetch_assoc()) > 0) {
                    $vencidoClass = 'btn-primary';
                    $vencido = '';
                    if (date("Y/m/d") > date("Y/m/d", strtotime($fila['fecha_vencimiento']))) {
                      $vencidoClass = "btn-danger";
                      $vencido = "VENCIDO";
                    }
                    echo "<td align='center'>" . $fila['n_cedula'] . "</td>";
                    echo "<td align='center'>" . $fila['nombres'] . ' ' . $fila['apellidos'] . "</td>";
                    echo "<td align='center'>" . $fila['fecha_prestamo'] . "</td>";
                    echo "<td align='center'>" . $fila['fecha_vencimiento'] . "</td>";
                    echo "<td align='center'>" . $fila['id_prestamo'] . "</td>";
                    echo "<td align='center'>" . $fila['libro_id_libro'] . "</td>";
                    echo "<td align='center'>" . $fila['codigo_ejemplar'] . "</td>";
                  ?>
                    <form method="POST" action="devolver.php">
                      <input type="hidden" name="idEstudiante" value="<?php echo $fila['id_usuario'] ?>">
                      <input type="hidden" name="nombre_completo" value="<?php echo $fila['nombres'] . ' ' . $fila['apellidos'] ?>">
                      <input type="hidden" name="fecha_prestamo" value="<?php echo $fila['fecha_prestamo'] ?>">
                      <input type="hidden" name="fecha_vencimiento" value="<?php echo $fila['fecha_vencimiento'] ?>">
                      <input type="hidden" name="vencido" value="<?php echo $vencido ?>">
                      <input type="hidden" name="idPrestamo" value="<?php echo $fila['id_prestamo'] ?>">
                      <input type="hidden" name="libro_id_libro" value="<?php echo $fila['libro_id_libro'] ?>">
                      <input type="hidden" name="codigo_ejemplar" value="<?php echo $fila['codigo_ejemplar'] ?>">
                      <td align='center'>
                        <input type='submit' name="stage2" value='Devolver' class='btn boton-submit <?php echo $vencidoClass; ?>'>
                      </td>

                    </form>
                    </tr>
                  <?php } ?>
                </table>
              <?php } else { ?>
                <table class="table">
                  <tr>
                    <td align="center" class="cabecera_columna">
                      <h3 class="h4">No se ha encontrado el estudiante</h3>
                    </td>
                  </tr>
                </table>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if (isset($_POST["stage2"])) { ?>
        <?php
        $_SESSION["idEstudiante"] =  $_POST["idEstudiante"];
        $_SESSION["nombre_completo"] =  $_POST["nombre_completo"];
        $_SESSION["fecha_prestamo"] =  $_POST["fecha_prestamo"];
        $_SESSION["fecha_vencimiento"] =  $_POST["fecha_vencimiento"];
        $_SESSION["vencido"] =  $_POST["vencido"];
        $_SESSION["idPrestamo"] =  $_POST["idPrestamo"];
        $_SESSION["libro_id_libro"] =  $_POST["libro_id_libro"];
        $_SESSION["codigo_ejemplar"] =  $_POST["codigo_ejemplar"];
        ?>

        <div id="resumen-devolucion" class="container resumen-devolucion">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col">
                    <h3>Resumen del <b>Prestamo</b></h3>
                  </div>
                </div>
              </div>
              <form method="POST" name="form_car" id="form_car">
                <table class="table container">

                  <tr class="row justify-content-center">
                    <td class="col-auto border-0">Id del libro</td>
                    <td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="libro_id_libro" name="libro_id_libro" value="<?php echo $_SESSION['libro_id_libro'] ?>"></td>
                    <td class="col-auto border-0">Codigo del ejemplar</td>
                    <td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="codigo_ejemplar" name="codigo_ejemplar" value="<?php echo $_SESSION['codigo_ejemplar'] ?>"></td>
                  </tr>

                  <tr class="row justify-content-center">
                    <td class="col-auto border-0">Fecha del prestamo</td>
                    <td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="fecha_prestamo" name="fecha_prestamo" value="<?php echo $_SESSION['fecha_prestamo'] ?>"></td>
                    <td class="col-auto border-0">Fecha de vencimiento</td>
                    <td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $_SESSION['fecha_vencimiento'] ?>"></td>
                  </tr>

                  <tr class="row justify-content-center">
                    <td class="col-auto border-0">Nombre del estudiante</td>
                    <td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="nombre_completo" name="nombre_completo" value="<?php echo $_SESSION['nombre_completo'] ?>"></td>
                  </tr>

                  <tr class="border-0">
                    <td class="border-0" colspan="2" align="center">
                      <input type="button" name="btnEnviar" id="btnEnviar" value="Devolver" class="btn btn-primary boton-submit" onclick="return validaCarrera('modificar_prestamo')">
                      <?php if (date("Y/m/d") > date("Y/m/d", strtotime($_SESSION['fecha_vencimiento']))) { ?> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> Sancionar </button> <?php } ?>
                    </td>
                  </tr>

                  <input type="hidden" id ="idEstudiante" name="idEstudiante" value="<?php echo $_SESSION['idEstudiante'] ?>">
                  <input type="hidden" id ="idPrestamo" name="idPrestamo" value="<?php echo $_SESSION['idPrestamo'] ?>">

                  <tr class="border-0">
                    <td class="border-0" colspan="2" align="center">
                      <div id="mensaje" class="alert alert-success" style="display: none;"></div>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aplicar sanción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table">
                  <tr class="row justify-content-center">
                    <td class="col-auto border-0">Fecha de inicio</td>
                    <td class="col-auto border-0"><input type="date" id="fecha_inicio" name="fecha_inicio" size="20" maxlength="50" ></td>
                  </tr>
                  <tr class="row justify-content-center">
                    <td class="col-auto border-0">Fecha de Finalizacion</td>
                    <td class="col-auto border-0"><input type="date" id="fecha_fin" name="fecha_fin" size="20" maxlength="10" ></td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aplicar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>



      <?php } ?>

    <?php } else { ?>
      <div id="no-registrado" class="modal-dialog modal-confirm">
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

    <script src="./js/libreria_pac.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  </html>