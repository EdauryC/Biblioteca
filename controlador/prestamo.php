<?php
require("../modelo/prestamo.php");
$carrera=new Prestamo; 
$con=$carrera->conexion();
$respuesta=array();
switch($_REQUEST["accion"])
{
	case 'agregar_prestamo':
		$codigo_ejemplar=$_REQUEST['codigo_ejemplar'];
		$fecha_prestamo=$_REQUEST['fecha_prestamo'];
		$fecha_vencimiento=$_REQUEST['fecha_vencimiento'];
		$libro_id_libro=$_REQUEST['libro_id_libro'];
		$usuario_id_usuario=$_REQUEST['usuario_id_usuario'];
		$empleado_id_empleado=$_REQUEST['empleado_id_empleado'];
	
		$respuesta=$carrera->insert($codigo_ejemplar, $fecha_prestamo, $fecha_vencimiento, $libro_id_libro, $usuario_id_usuario, $empleado_id_empleado,$con);
		break;

	case 'modificar_prestamo':
		$libro_id_libro=$_REQUEST['libro_id_libro'];
		$idEstudiante=$_REQUEST['idEstudiante'];
		$idPrestamo=$_REQUEST['idPrestamo'];
		$codigo_ejemplar=$_REQUEST['codigo_ejemplar'];
		$fecha_inicio=$_REQUEST['fecha_inicio'];
		$fecha_fin=$_REQUEST['fecha_fin'];

		$respuesta=$carrera->update($libro_id_libro, $idEstudiante, $idPrestamo, $codigo_ejemplar, $fecha_inicio, $fecha_fin,$con);
		break;

	case 'eliminar_prestamo':
		$id_prestamo=$_REQUEST["id_prestamo"];

		$id_prestamo=$carrera->delete($id_prestamo,$con);
		break;
}
echo implode("#",$respuesta);  