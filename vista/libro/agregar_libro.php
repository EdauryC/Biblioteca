<?php
session_start();
require_once("../../modelo/libro.php");
$carrera = new Libro;
$con = $carrera->conexion();
$registros = $carrera->selectAll("categoria_libro", $con);
?>
<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/listado.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulario para agregar un libro nuevo</title>
	</head>
	<style>
      .bg-company-red {
        background-color: #55AEEF !important;
     }
		 
		 .table-title {
				padding-bottom: 15px;
				background: #9F9FE5;
				color: #FFFFFF;
				padding: 16px 30px;
				min-width: 100%;
				margin: -20px -25px 10px;
				border-radius: 3px 3px 0 0;
			}
			.btn-danger
        {
        background-color: #CD5A5A;
        color:#FFF;
        border-color: #2F3E48;
        }
        .btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .open .dropdown-toggle.btn-danger {
        background-color: #CD5A5A;
        color:#FFF;
        border-color: #31347B;
        }
				.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
         background-color: #55AEEF  !important;
        }
  </style>
	<body>
		<?php if (isset($_SESSION["autenticado"])) {
		?>
			<nav class="navbar navbar-expand-lg  navbar-dark bg-company-red px-4">
				<a class="navbar-brand" href="#">
					<img src="../images/Libro.png" class="" width="30" height="30" alt="">
				</a>
				<a class="navbar-brand mx-auto" href="../../vista/libro/agregar_libro.php">Añadir Nuevo Libro</a>
				<a class="nav-item nav-link text-white " href="../../vista/libro/listar_libro.php">Retornar a la Lista</a>
			</nav>
			<form method="POST" name="form_car" id="form_car" onload="document.getElementById('codigo').focus();">
				<div class="container">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h2>Añadir <b>Libro Nuevo</b></h2>
									</div>
								</div>
							</div>
							<table class="table container">
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Cota</td>
									<td class="col-auto border-0"><input type="text" id="codigo" name="codigo" size="20" maxlength="50" placeholder="Ingrese la Cota del libro" onblur="soloMayusculas('codigo')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Autor del Libro</td>
									<td class="col-auto border-0"><input type="text" id="autor" name="autor" size="20" maxlength="50" placeholder="Ingrese el autor del libro" onkeypress="return soloLetras(event)" onblur="soloMayusculas('autor')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Nombre del Libro</td>
									<td class="col-auto border-0"><input type="text" id="nombre" name="nombre" size="20" maxlength="50" placeholder="Ingrese el nombre del libro" onkeypress="return soloLetras(event)" onblur="soloMayusculas('nombre')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Descripcion del Libro</td>
									<td class="col-auto border-0"><textarea id="descripcion" name="descripcion" rows="5" cols="50" placeholder="Ingrese descripcion" onkeypress="return soloLetras(event)"           onblur="soloMayusculas('descripcion')"></textarea></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Numero de Ejemplares</td>
									<td class="col-auto border-0"><input type="text" id="n_ejemplares" name="n_ejemplares" size="10" maxlength="5" placeholder="Nº libros" onkeypress="return SoloNumeros(event)"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="border-0" align="right">Status:</td>
									<td><select name="status" id="status">
											<option value="1">Unidades Disponible</option>
											<option value="2">Unidades No Disponible</option>
											<option value="3">Descontinuado</option>
										</select>
									</td>
								</tr>
								<tr class="row justify-content-center">
									<td class="border-0" align="right">ISNB</td>
									<td class="border-0"><input type="text" id="ISNB" name="ISNB" size="20" maxlength="20" placeholder="Ingrese Codigo ISNB" onkeypress="return SoloNumeros(event)"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="border-0" align="right">Categoria:</td>
									<td><select name="categoria_libro_id_categoria_libro" id="categoria_libro_id_categoria_libro">
											<?php
											while (($fila = $registros->fetch_assoc()) > 0) {
												echo "<option value='" . $fila["id_categoria_libro"] . "'>" . $fila['nombre'] . "</option>";
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="border-0" colspan="2" align="center">
										<input type="button" name="btnEnviar" id="btnEnviar" value="Guardar" class="btn btn-primary boton-submit" onclick="return validaCarrera('incluir')">
										<input type="reset" name="btnLimpiar" id="btnLimpiar" value="Deshacer" class="btn btn-danger boton-cancel">
									</td>									
								</tr>
							</table>
							
							<div id="mensaje" class="alert alert-success w-50 mx-auto text-center" style="display: none;"></div>
						</div>
					</div>
				</div>
			</form>
			<script src="../js/libreria.js"></script>
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