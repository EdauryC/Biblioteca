<?php session_start(); ?>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/listado.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de Usuarios</title>

	<style>
		.bg-company-red {
        background-color: #55AEEF !important;
      }
		body {
			color: #566787;
			background: #f5f5f5;
			font-family: 'Varela Round', sans-serif;
			font-size: 13px;
		}

		.table-responsive {
			margin: 30px 0;
		}

		.table-wrapper {
			background: #fff;
			padding: 20px 25px;
			border-radius: 3px;
			min-width: 1000px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
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

		.table-title h2 {
			margin: 5px 0 0;
			font-size: 24px;
		}

		.table-title .btn-group {
			float: right;
		}

		.table-title .btn {
			color: #fff;
			float: right;
			font-size: 13px;
			border: none;
			min-width: 50px;
			border-radius: 2px;
			border: none;
			outline: none !important;
			margin-left: 10px;
		}

		.table-title .btn i {
			float: left;
			font-size: 21px;
			margin-right: 5px;
		}

		.table-title .btn span {
			float: left;
			margin-top: 2px;
		}

		table.table tr th,
		table.table tr td {
			border-color: #e9e9e9;
			padding: 12px 15px;
			vertical-align: middle;
		}

		table.table tr th:first-child {
			width: 100px !important;
		}

		table.table tr th:last-child {
			width: 100px !important;
		}

		table.table-striped tbody tr:nth-of-type(odd) {
			background-color: #fcfcfc;
		}

		table.table-striped.table-hover tbody tr:hover {
			background: #f5f5f5;
		}

		table.table th i {
			font-size: 13px;
			margin: 0 5px;
			cursor: pointer;
		}

		table.table td:last-child i {
			opacity: 0.9;
			font-size: 22px;
			margin: 0 5px;
		}

		table.table td a {
			font-weight: bold;
			color: #566787;
			display: inline-block;
			text-decoration: none;
			outline: none !important;
		}

		table.table td a:hover {
			color: #2196F3;
		}

		table.table td a.edit {
			color: #FFC107;
		}

		table.table td a.delete {
			color: #F44336;
		}

		table.table td i {
			font-size: 19px;
		}

		table.table .avatar {
			border-radius: 50%;
			vertical-align: middle;
			margin-right: 10px;
		}

		.pagination {
			float: right;
			margin: 0 0 5px;
		}

		.pagination li a {
			border: none;
			font-size: 13px;
			min-width: 30px;
			min-height: 30px;
			color: #999;
			margin: 0 2px;
			line-height: 30px;
			border-radius: 2px !important;
			text-align: center;
			padding: 0 6px;
		}

		.pagination li a:hover {
			color: #666;
		}

		.pagination li.active a,
		.pagination li.active a.page-link {
			background: #03A9F4;
		}

		.pagination li.active a:hover {
			background: #0397d6;
		}

		.pagination li.disabled i {
			color: #ccc;
		}

		.pagination li i {
			font-size: 16px;
			padding-top: 6px
		}

		.hint-text {
			float: left;
			margin-top: 10px;
			font-size: 13px;
		}
	</style>
</head>

<body>
	<?php
	if (isset($_POST["logout"])) {
		session_unset();
		header("Location: registrar_usuarios.php");
		die();
	}

	if (!isset($_SESSION["autenticado"])) { ?>
		<div onload="document.getElementById('usuario').focus();">
			<nav class="navbar navbar-expand-lg  navbar-dark bg-company-red px-4">
				<a class="navbar-brand" href="#">
					<img src="../images/Libro.png" class="" width="30" height="30" alt="">
				</a>
				<a class="navbar-brand mx-auto" href="principal.php">Sistema de Registro de Usuarios</a>
				<a class="nav-item nav-link text-white" href="../../vista/usuarios/login.php">Inicio de Sesion</a>
			</nav>
			<form method="POST" name="form_car" id="form_car">

				<div class="container">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h2>Añadir nuevo <b>Usuario</b></h2>
									</div>
								</div>
							</div>

							<table class="table container">
								<tr class="row justify-content-center">
									<td class="border-0" align="right">Cedula</td>
									<td class="border-0"><input type="text" id="n_cedula" name="n_cedula" size="20" maxlength="12" placeholder="Ejm:12345678" onkeypress="return SoloNumeros(event)"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Nombres</td>
									<td class="col-auto border-0"><input type="text" id="nombres" name="nombres" size="20" maxlength="50" placeholder="Ingrese su nombre" onkeypress="return soloLetras(event)" onblur="soloMayusculas('nombres')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Apellidos</td>
									<td class="col-auto border-0"><input type="text" id="apellidos" name="apellidos" size="20" maxlength="50" placeholder="Ingrese su apellido" onkeypress="return soloLetras(event)" onblur="soloMayusculas('apellidos')"></td>
								</tr>
								<tr class="row justify-content-center d-none">
									<td class="col-auto border-0">Status</td>
									<td class="col-auto border-0"><input type="checkbox" id="status" name="status" checked disabled></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Usuario</td>
									<td class="col-auto border-0"><input type="text" id="usuario" name="usuario" size="20" maxlength="10" placeholder="Ingrese su usuario" onkeypress="return soloLetras(event)" onblur="soloMayusculas('usuario')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Contraseña</td>
									<td class="col-auto border-0"><input type="password" id="clave" name="clave" size="20" maxlength="30" placeholder="Ingrese su contraseña" onblur="soloMayusculas('clave')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td colspan="2" align="center">
										<input type="button" name="btnEnviar" id="btnEnviar" value="Guardar" class="btn btn-primary boton-submit" onclick="return validaCarrera('incluir')">
										<input type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar" class="btn btn-danger boton-cancel">
									</td>
								</tr>
							</table>
							<div id="mensaje" class="alert alert-success" style="display: none;"></div>
						</div>
					</div>
				</div>
			</form>
			<br>

			<script src="./js/libreria_usu.js"></script>
		<?php } else { ?>
			<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
				<a class="navbar-brand" href="principal.php">Sistema de Gestion Bibliotecario</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-item nav-link " href="principal.php">Principal</a>
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
						<p>Parece que ya tienes una sesion iniciada. Para acceder a esta funcionalidad por favor cerrar sesion.</p>
						<form action="registrar_usuarios.php" method="post">
							<button type="submit" name="logout" value="true" class="btn btn-success">Cerrar sesion </button>
						</form>
					</div>
				</div>
			</div>
		<?php }
		?>
</body>

</html>