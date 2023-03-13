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
				<a class="navbar-brand mx-auto" href="../../vista/prestamo/agregar_prestamo.php">Realizar Prestamo</a>
				<a class="nav-item nav-link text-white" href="../../vista/prestamo/listar_prestamos.php">Volver a la lista</a>
			</nav>

			<?php if (!isset($_POST["stage1"]) && !isset($_POST["stage2"]) && !isset($_POST["stage3"])  && !isset($_POST["stage4"]) && !isset($_POST["stage5"])) { ?>
				<?php
				unset($_SESSION['resultados_libros']);
				unset($_SESSION['idLibro']);
				unset($_SESSION['resultados_libros']);
				unset($_SESSION['idEstudiante']);
				unset($_SESSION['cotaLibro']);
				unset($_SESSION['nombreLibro']);
				unset($_SESSION['autorLibro']);
				unset($_SESSION["nombresEstudiante"]);
				unset($_SESSION["apellidosEstudiante"]);
				unset($_SESSION["cedulaEstudiante"]);
				?>
				<div id="buscar-libro" class="container ">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h2>Buscar <b>Libro</b></h2>
									</div>
								</div>
							</div>
							<table class="table">
								<form method="POST" action="agregar_prestamo.php">
									<tr>
										<td class="border-0" align="center"><input type="text" required id="id_libro" name="id_libro" size="20" maxlength="30" class="form-control" placeholder="Ingrese la cota del libro" onblur="soloMayusculas('id_libro')"></td>
									</tr>
									<tr>
										<td class="border-0" colspan="2" align="center">
											<input type="submit" name="stage1" id="stage1" value="Consultar" onClick="buscarLibro()" class="btn btn-primary boton-submit">
										</td>
									</tr>
								</form>
							</table>
						</div>
					</div>
				</div>

			<?php } ?>

			<?php if (isset($_POST["stage1"])) { ?>
				<?php $codigo = $_REQUEST["id_libro"];
				$encontrado = false;
				$respuesta = $libros->search($codigo, $con);

				if ($respuesta['exito'] == 1) {
					$encontrado = true;
					$_SESSION["resultados_libros"] = $respuesta['registros'];
					// echo json_encode($respuesta['registros']);
				} else {
					unset($_SESSION['resultados_libros']);
				}
				?>
				<div id="resultados-libros" class="container resultados-libros">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h3>Resultados de la <b>Consulta</b></h3>
									</div>
								</div>
							</div>
							<?php
							if ($encontrado) { ?>
								<form method="POST" action="agregar_prestamo.php">
									<table class="table">
										<tr>
											<td align="center" class="cabecera_columna">Cota</td>
											<td align="center" class="cabecera_columna">Titulo</td>
											<td align="center" class="cabecera_columna">Autor</td>
											<td align="center" class="cabecera_columna">Nº Ejemplares Disp.</td>
											<td align="center" class="cabecera_columna">Status</td>
											<td align="center" class="cabecera_columna">ISNB</td>
											<td align="center" class="cabecera_columna">Seleccionar</td>
										</tr>
										<?php
										echo "<tr>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['codigo'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['nombre'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['autor'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['n_ejemplares'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['status'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_libros']['ISNB'] . "</td>";
										?>
										<input type="hidden" name="idLibroSeleccionado" value="<?php echo $_SESSION['resultados_libros']['id_libro'] ?>">
										<input type="hidden" name="cotaLibroSeleccionado" value="<?php echo $_SESSION['resultados_libros']['codigo'] ?>">
										<input type="hidden" name="nombreLibroSeleccionado" value="<?php echo $_SESSION['resultados_libros']['nombre'] ?>">
										<input type="hidden" name="autorLibroSeleccionado" value="<?php echo $_SESSION['resultados_libros']['autor'] ?>">
										<td align='center'>
											<?php if ($_SESSION['resultados_libros']['n_ejemplares'] > 0) { ?><input type='submit' name="stage2" value='Seleccionar' class='btn btn-primary boton-submit'>
											<?php } ?>
										</td>
										</tr>
									</table>
								</form>
							<?php } else { ?>
								<table class="table">
									<tr>
										<td align="center" class="cabecera_columna">
											<h3 class="h4">No se ha encontrado el libro</h3>
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
				$_SESSION["idLibro"] = $_POST["idLibroSeleccionado"];
				$_SESSION["cotaLibro"] = $_POST["cotaLibroSeleccionado"];
				$_SESSION["nombreLibro"] = $_POST["nombreLibroSeleccionado"];
				$_SESSION["autorLibro"] = $_POST["autorLibroSeleccionado"];
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
							<form method="POST" action="agregar_prestamo.php">
								<table class="table">
									<tr>
										<td class="border-0" align="center"><input type="text" id="cedula_estudiante" name="cedula_estudiante" class="form-control" size="20" maxlength="30" onkeypress="return SoloNumeros(event)" placeholder="Ingrese numero de cedula"></td>
									</tr>
									<tr>
										<td class="border-0" colspan="2" align="center">
											<input type="submit" name="stage3" id="stage3" value="Consultar" class="btn btn-primary boton-submit">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if (isset($_POST["stage3"])) { ?>
				<?php
				$cedula_estudiante = $_REQUEST["cedula_estudiante"];
				$encontrado = false;

				$respuestaEstudiante = $usuarios->search($cedula_estudiante, $conUsuarios);

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
								<form method="POST" action="agregar_prestamo.php">
									<table class="table">
										<tr>
											<td align="center" class="cabecera_columna">Nº cedula</td>
											<td align="center" class="cabecera_columna">Nombres</td>
											<td align="center" class="cabecera_columna">Apellidos</td>
											<td align="center" class="cabecera_columna">Status</td>
										</tr>
										<?php
										echo "<tr>";
										echo "<td align='center'>" . $_SESSION['resultados_usuarios']['n_cedula'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_usuarios']['nombres'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_usuarios']['apellidos'] . "</td>";
										echo "<td align='center'>" . $_SESSION['resultados_usuarios']['status'] . "</td>";
										?>
										<input type="hidden" name="idEstudiante" value="<?php echo $_SESSION['resultados_usuarios']['id_usuario'] ?>">
										<input type="hidden" name="nombresEstudiante" value="<?php echo $_SESSION['resultados_usuarios']['nombres'] ?>">
										<input type="hidden" name="apellidosEstudiante" value="<?php echo $_SESSION['resultados_usuarios']['apellidos'] ?>">
										<input type="hidden" name="cedulaEstudiante" value="<?php echo $_SESSION['resultados_usuarios']['n_cedula'] ?>">
										<td align='center'>
											<?php if ($_SESSION['resultados_usuarios']['status'] == "activo") { ?><input type='submit' name="stage4" value='Seleccionar' class='btn btn-primary boton-submit'>
											<?php } ?>
										</td>
										</tr>

									</table>
								</form>
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

			<?php if (isset($_POST["stage4"])) { ?>
				<?php
				$_SESSION["idEstudiante"] = $_POST["idEstudiante"];
				$_SESSION["nombresEstudiante"] = $_POST["nombresEstudiante"];
				$_SESSION["apellidosEstudiante"] = $_POST["apellidosEstudiante"];
				$_SESSION["cedulaEstudiante"] = $_POST["cedulaEstudiante"];

				?>
				<div id="resumen-prestamo" class="container resumen-prestamo">
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
									<input type="hidden" readonly id="libro_id_libro" name="libro_id_libro" value="<?php echo $_SESSION['idLibro'] ?>">
									<input type="hidden" readonly id="estudiante_id_estudiante" name="estudiante_id_estudiante" value="<?php echo $_SESSION['idEstudiante'] ?>">
									<input type="hidden" readonly id="empleado_id_empleado" name="empleado_id_empleado" value="<?php echo $_SESSION['idEmpleado'] ?>">

									<tr class="row justify-content-center">
										<td class="col-auto border-0">Cota del libro</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="codigo" name="codigo" value="<?php echo $_SESSION['cotaLibro'] ?>"></td>
										<td class="col-auto border-0">Nombre del libro</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="nombre_libro" name="nombre_libro" value="<?php echo $_SESSION['nombreLibro'] ?>"></td>
									</tr>
									<tr class="row justify-content-center">
										<td class="col-auto border-0">Autor del libro</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="autor_libro" name="autor_libro" value="<?php echo $_SESSION['autorLibro'] ?>"></td>
										<td class="col-auto border-0">Codigo del ejemplar</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" required id="codigo_ejemplar" name="codigo_ejemplar"></td>
									</tr>
									<tr class="row justify-content-center">
									</tr>
									<tr class="row justify-content-center">
										<td class="col-auto border-0">Nombres del estudiante</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="nombres_estudiante" name="nombres_estudiante" value="<?php echo $_SESSION['nombresEstudiante'] ?>"></td>
										<td class="col-auto border-0">Apellidos del estudiante</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="apellidos_estudiante" name="apellidos_estudiante" value="<?php echo $_SESSION['apellidosEstudiante'] ?>"></td>
									</tr>
									<tr class="row justify-content-center">
										<td class="col-auto border-0">Cedula del estudiante</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="text" readonly disabled id="cedula_estudiante" name="cedula_estudiante" value="<?php echo $_SESSION['cedulaEstudiante'] ?>"></td>
									</tr>
									<tr class="row justify-content-center">
										<td class="col-auto border-0">Fecha del prestamo</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="date" readonly disabled id="fecha_prestamo" name="fecha_prestamo" value="<?php echo date('Y-m-d'); ?>"></td>
										<td class="col-auto border-0">Fecha de devolucion</td>
										<td class="col-auto border-0"><input class="form-control w-100" type="date" required id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo date('Y-m-d'); ?>"></td>
									</tr>
									<tr class="border-0">
										<td class="border-0" colspan="2" align="center">
											<input type="button" name="btnEnviar" id="btnEnviar" value="Guardar" class="btn btn-primary boton-submit" onclick="return validaCarrera('incluir')">
											<input type="reset" name="btnLimpiar" id="btnLimpiar" value="Cancelar" class="btn btn-danger boton-submit">
										</td>
									</tr>
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