<?php
session_start();
require_once("../../modelo/libro.php");
$libros = new Libro;
$con = $libros->conexion();
date_default_timezone_set("America/Caracas");

require_once("../../modelo/usuarios.php");
$usuarios = new Usuarios;
$conUsuarios = $usuarios->conexion();

require_once("../../modelo/prestamo.php");
$prestamos = new Prestamo;
$conPrestamo = $prestamos->conexion();
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

	<body>
		<?php if (isset($_SESSION["autenticado"])) { ?>

			<nav class="navbar navbar-expand-lg  navbar-dark bg-dark px-4">
				<a class="navbar-brand" href="#">
					<img src="../images/Libro.png" class="" width="30" height="30" alt="">
				</a>
				<a class="navbar-brand mx-auto" href="../../vista/prestamo/agregar_prestamo.php">Realizar Prestamo</a>
				<a class="nav-item nav-link text-white" href="../../vista/prestamo/listar_prestamos.php">Volver a la lista</a>
			</nav>

			<?php if (isset($_POST["idPrestamo"])) { ?>
				<div class="container">
					<div class="row">
						<div class="col text-center">
							<h1 class="h3 mt-5">Pasado por parametros</h1>
							<h1 class="h4 mt-1">Id del prestamo: <?php echo $_POST["idPrestamo"] ?></h1>
							<h1 class="h5 mt-1">Pantalla en construccion</h1>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="container">
					<div class="row">
						<div class="col text-center">
							<h1 class="h3 mt-5">No pasado por parametros</h1>
							<h1 class="h4 mt-1">Id del prestamo: No definido</h1>
							<h1 class="h5 mt-1">Pantalla en construccion</h1>
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