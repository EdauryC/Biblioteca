<?php
session_start();
?>
<html5>

	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="../images/books.ico">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/listado.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Area de Nuevos Registros</title>

		<style>
			 .bg-company-red {
        background-color: #55AEEF !important;
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
				color: #FFFFFF;
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
				width: 60px;
			}

			table.table tr th:last-child {
				width: 100px;
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

	<body onload="document.getElementById('tipo_empleado_id_tipo_empleado').focus();" class="table">
		<?php if (isset($_SESSION["autenticado"])) { ?>
			<form method="POST" name="form_car" id="form_car">
				<nav class="navbar navbar-expand-lg navbar-dark bg-company-red px-4">
					<a class="navbar-brand" href="#">
						<img src="../images/Libro.png" class="" width="30" height="30" alt="">
					</a>
					<a class="navbar-brand mx-auto" href="../../vista/empleado/ingresar_empleado.php">Area de Registro de Empleados</a>
					<a class="nav-item nav-link text-white" href="../../vista/empleado/listar_empleado.php">Volver a la lista</a>
				</nav>
				<div class="container">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h2>Nuevo <b>Empleado</b></h2>
									</div>
								</div>
							</div>
							<table class="table container">

								<tr class="row justify-content-center">
									<td class="col-auto border-0">Nombres</td>
									<td class="col-auto border-0"><input type="text" id="nombres" name="nombres" size="20" maxlength="50" placeholder="Ingrese su nombre"  onkeypress="return soloLetras(event)" onblur="soloMayusculas('nombres')"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Apellidos</td>
									<td class="col-auto border-0"><input type="text" id="apellidos" name="apellidos" size="20" maxlength="50" placeholder="Ingrese su apellido"  onkeypress="return soloLetras(event)" onblur="soloMayusculas('apellidos')"></td>
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
									<td class="border-0" align="right">Cedula</td>
									<td class="border-0"><input type="text" id="n_cedula" name="n_cedula" size="20" maxlength="12" placeholder="Ejm:12345678" onkeypress="return SoloNumeros(event)"></td>
								</tr>
								<tr class="row justify-content-center">
									<td class="col-auto border-0">Correo</td>
									<td class="col-auto border-0"><input type="text" id="correo" name="correo" size="30" maxlength="50" placeholder="Correo_ejemplo@hotmail.com" onblur="soloMayusculas('correo')"></td>
									
								</tr>
								<tr class="row justify-content-center">
									<td class="border-0" align="right">Tipo de Usuario:</td>
									<td><select name="tipo_empleado_id_tipo_empleado" id="tipo_empleado_id_tipo_empleado">
											<option value="1">Ayudante</option>
											<option value="2">Empleado</option>
											<option value="3">Administrador</option>
										</select>
									</td>
								<tr class="border-0">
									<td class="border-0" colspan="2" align="center">
										<input type="button" name="btnEnviar" id="btnEnviar" value="Guardar" class="btn btn-primary boton-submit" onclick="return validaCarrera('incluir')">
										<input type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar" class="btn btn-danger boton-cancel">
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</form>
			<br>
			<div id="mensaje" class="alert alert-success" style="display: none;"></div>
			<script src="../empleado/js/libreria_ing.js"></script>
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