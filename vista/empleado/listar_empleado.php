<?php
session_start();
require_once("../../modelo/empleado.php");
$carrera = new Empleado;
$con = $carrera->conexion();
$registros = $carrera->selectAll("empleado", $con);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="../images/books.png">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/listado.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<title>Lista de empleados</title>
	</head>

	 <style>
        .bg-company-red {
        background-color: #55AEEF !important;
        }
      
        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
         background-color: #9ED876  !important;
        }
				
        /* The container <div> - needed to position the dropdown content */
				.dropdown {
        position: relative;
        display: inline-block;
        }

         /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

       /* Links inside the dropdown */
            .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }

         /* Change color of dropdown links on hover */
             .dropdown-content a:hover {background-color: #f1f1f1}

         /* Show the dropdown menu on hover */
             .dropdown:hover .dropdown-content {
        display: block;
        }
 
         /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {
          background-color: #3e8e41;
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
   </style>

	<body class="table">
		<?php
		if (isset($_SESSION["autenticado"])) {
			if ($registros) {
		?>
				<nav class="navbar navbar-expand-lg navbar-dark bg-company-red px-4">
					<a class="navbar-brand" href="#">
						<img src="../images/Libro.png" class="" width="30" height="30" alt="">
					</a>
					<a class="navbar-brand mx-auto" href="#">Lista de Empleados</a>
					<a class="nav-item nav-link text-white " href="../../vista/<?php if ($_SESSION["empleado"]) { echo 'empleado'; } else { echo 'usuarios'; }?>    /principal.php">Principal</a>
					       	<?php if ($_SESSION["empleado"]) { ?>
					     	<?php } ?>		
								 <div class="dropdown d-inline-block">
                           <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                          <div class="dropdown-menu w-100" arialabelledby="dropdownMenuButton">
                       <div class="dropdown-content">
                          <a href="../../vista/empleado/formulario_empleado.php">Reporte de Empleados</a>
                          <a href="../../vista/empleado/ingresar_empleado.php">Agregar empleado</a>
                       </div>
                   </div>	 	 
				</nav>

				<div class="container">
					<div class="table-responsive">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col">
										<h2>Lista de <b>empleados</b></h2>
									</div>
								</div>
							</div>

							<table class="table">
								<tr>
									<td align="center" class="cabecera_columna border-0">ID del Empleado</td>
									<td align="center" class="cabecera_columna border-0">Nombres</td>
									<td align="center" class="cabecera_columna border-0">Apellidos</td>
									<td align="center" class="cabecera_columna border-0">Cedula</td>
									<td align="center" class="cabecera_columna border-0">Tipo Empleado</td>
									<td align="center" class="cabecera_columna border-0">Editar</td>
									<td align="center" class="cabecera_columna border-0">Borrar</td>
								</tr>
								<?php
								while (($fila = $registros->fetch_assoc()) > 0) {
									echo "<tr>";
									echo "<td align='center'>" . $fila['id_empleado'] . "</td>";
									echo "<td>" . $fila['nombres'] . "</td>";
									echo "<td align='center'>" . $fila['apellidos'] . "</td>";
									echo "<td align='center'>" . $fila['n_cedula'] . "</td>";
									echo "<td align='center'>" . $fila['tipo_empleado_id_tipo_empleado'] . "</td>";
									echo "<td align='center'><a href='editar_empleado.php?car=$fila[id_empleado]'><img src='../images/editar.png'></a></td>";
									echo "<td align='center'><input type=image src='../images/borrar.png' onclick='eliminaCarrera(this," . $fila['id_empleado'] . ")'></td>";
									echo "</tr>";
								}
								?>
							</table>
							<br>
							<div id="mensaje" class="alert alert-success" style="display: none;"></div>
							<script src="../empleado/js/libreria_ing.js"></script>
						</div>
					</div>
				</div>
			<?php
			} else {
				echo "Falló la consulta";
			}
		} else { ?>
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