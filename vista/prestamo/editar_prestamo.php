<?php
    session_start();
require_once("../../modelo/prestamo.php");
$carrera = new Prestamo;
$con = $carrera->conexion();
$car=$_GET["car"];
$fila=$carrera->selectOne("prestamo","id_prestamo",$car,$con);
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
		<title>Formulario para editar prestamos</title>

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
					box-shadow: 0 1px 1px rgba(0,0,0,.05);
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
				table.table tr th, table.table tr td {
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
				.pagination li.active a, .pagination li.active a.page-link {
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
	
	<body onload="document.getElementById('id_prestamo').focus();">
	<?php
	if(isset($_SESSION["autenticado"])){
		if ($fila)
		{
	?>
		<form method="POST" name="form_car" id="form_car">
			<nav class="navbar navbar-expand-lg  navbar-dark bg-company-red px-4">
			    <a class="navbar-brand" href="#">
             <img src="../images/Libro.png" class="" width="30" height="30" alt="">
          </a>
		      <a class="navbar-brand mx-auto" href="#"> Editar Datos del Prestamo</a>
		      <a class="nav-item nav-link text-white "href="../../vista/prestamo/listar_prestamos.php">Volver a la lista</a>
	    </nav>
      	<div class="container">
      			<div class="table-responsive">
      		   	<div class="table-wrapper">
      	        	<div class="table-title">
      			         <div class="row">
      				         <div class="col">
      				         	  <h2>Editar datos del <b>Prestamo</b></h2>
      			          	</div>
      		           </div>
                  </div>
						  <table class="table">
							      <tr>
							         <td class="border-0" align="right">ID del prestamo</td>
							         <td class="border-0"><input type="text" id="id_prestamo" readonly name="id_prestamo" size="30" maxlength="30" placeholder="Ingrese el nombre" onblur="soloMayusculas('id_prestamo')"value="<?php echo $fila['id_prestamo']; ?>"></td>
							    	</tr>
							       <tr hidden>
							          <td class="border-0" align="right">Cota del libro</td>
							          <td class="border-0"><input type="text" id="codigo_ejemplar" readonly  name="codigo_ejemplar" size="30" maxlength="30" placeholder="Ingrese el nombre" onblur="soloMayusculas('codigo_ejemplar')"value="<?php echo $fila['codigo_ejemplar']; ?>"></td>
							    	</tr>
							    	<tr>
							    	   <td class="border-0" align="right">Fecha de Inicio del Prestamo</td>
							    	   <td class="border-0"><input type="date" readonly id="fecha_prestamo" name="apellido" size="20" maxlength="20" placeholder="Ingrese el apellido" onblur="soloMayusculas('fecha_prestamo')"value="<?php echo $fila['fecha_prestamo']; ?>"></td>
							    	</tr>
							    	<tr>
							    	   <td class="border-0" align="right">Fecha de Vencimiento del Prestamo</td>
							    	   <td class="border-0"><input type="date" id="fecha_vencimiento" name="fecha_vencimiento" size="9" maxlength="12" placeholder="Ejm:12345678" onkeypress="return SoloNumeros(event)"value="<?php echo $fila['fecha_vencimiento']; ?>"></td>
							    	   <tr>
							         <td class="border-0" align="right">ID del libro</td>
							         <td class="border-0"><input type="text" id="libro_id_libro" readonly name="libro_id_libro" size="30" maxlength="30" placeholder="Ingrese el nombre" onblur="soloMayusculas('libro_id_libro')"value="<?php echo $fila['libro_id_libro']; ?>"></td>
							    	</tr>
							    	   <td class="border-0" align="right">ID del Usuario</td>
							    	   <td class="border-0"><input type="text" readonly id="usuario_id_usuario" name="usuario_id_usuario" size="20" maxlength="10" placeholder="Ingrese Ciudad" onblur="soloMayusculas('usuario_id_usuario')"value="<?php echo $fila['usuario_id_usuario']; ?>"></td>
							    	</tr>
							    	   <td class="border-0"align="right">ID del Empleado</td>
							    	   <td class="border-0"><input type="text" readonly id="empleado_id_empleado" name="empleado_id_empleado" size="20" maxlength="10" placeholder="Ingrese Estado" onblur="soloMayusculas('empleado_id_empleado')"value="<?php echo $fila['empleado_id_empleado']; ?>"></td>
							    	</tr>
							    	   <td class="border-0" align="right">Status del Prestamo</td>
							    	   <td class="border-0"><input type="text" readonly id="status" name="status" size="6" maxlength="10" placeholder="Ingrese Codigo Postal" onblur="soloMayusculas('status')"value="<?php echo $fila['status']; ?>"></td>
							    	</tr>
							    		<td class="border-0" colspan="2" align="center">
							    			<input type="button" name="btnEnviar" id="btnEnviar" value="Guardar" class="btn btn-primary boton-submit" onclick="return validaCarrera('modificar')">
							    			<input type="reset" name="btnLimpiar" id="btnLimpiar" value="Deshacer" class="btn btn-danger boton-cancel">
							    		</td>
							    	</tr>
						   </table>
			      </div>
				 	</div>
				</div>
		</form>
	  	<br>
		   <div id="mensaje" class="alert alert-success" style="display: none;"></div>
		   <script src="../prestamo/js/libreria_pac.js"></script> 
	
<?php
}
else
{
	echo "Falló la consulta";
}
	}
	else{?>
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