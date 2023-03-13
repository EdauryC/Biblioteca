<?php
require("../modelo/empleado.php");
$carrera=new Empleado; 
$con=$carrera->conexion();
$respuesta=array();
switch($_REQUEST["accion"])
{
	case 'agregar_empleado':

		$n_cedula=$_REQUEST['n_cedula'];
		$nombres=$_REQUEST['nombres'];
		$apellidos=$_REQUEST['apellidos'];
		$correo=$_REQUEST['correo'];
		$usuario=$_REQUEST['usuario'];
		$clave=$_REQUEST['clave'];
		$tipo_empleado_id_tipo_empleado=$_REQUEST['tipo_empleado_id_tipo_empleado'];
		$respuesta=$carrera->insert($nombres,$apellidos,$usuario,$clave,$n_cedula,$correo,$tipo_empleado_id_tipo_empleado,$con);
		break;

	case 'modificar_empleado':

		$id_empleado=$_REQUEST["id_empleado"];
		$n_cedula=$_REQUEST["n_cedula"];
		$nombres=$_REQUEST['nombres'];
		$apellidos=$_REQUEST['apellidos'];
		$usuario=$_REQUEST['usuario'];
		$clave=$_REQUEST['clave'];
		$correo=$_REQUEST['correo'];
		$tipo_empleado_id_tipo_empleado=$_REQUEST['tipo_empleado_id_tipo_empleado'];
		$respuesta=$carrera->update($id_empleado,$nombres,$apellidos,$n_cedula,$usuario,$clave,$correo,$tipo_empleado_id_tipo_empleado,$con);
		break;

	case 'eliminar_empleado':
		$id_empleado=$_REQUEST["id_empleado"];
		$respuesta=$carrera->delete($id_empleado,$con);
		break;
}
echo implode("#",$respuesta); 
?>