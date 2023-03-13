<?php
require("../modelo/sancion.php");
$carrera=new Sancion;
$con=$carrera->conexion();
$respuesta=array();
switch($_REQUEST["accion"])
{
	case 'agregar_sancion':
		$status=$_REQUEST['status'];
		$fecha_inicio=$_REQUEST['fecha_inicio'];
		$fecha_fin=$_REQUEST['fecha_fin'];
		$usuario_id_usuario=$_REQUEST['usuario_id_usuario'];

		$respuesta=$carrera->insert($status,$fecha_inicio,$fecha_fin,$usuario_id_usuario,$con);
		break;

	case 'modificar_sancion':
		$id_sancion=$_REQUEST['id_sancion'];
		$status=$_REQUEST['status'];
		$fecha_inicio=$_REQUEST['fecha_inicio'];
		$fecha_fin=$_REQUEST['fecha_fin'];
		$usuario_id_usuario=$_REQUEST['usuario_id_usuario'];
	
		$respuesta=$carrera->update($id_sancion,$status,$fecha_inicio,$fecha_fin,$usuario_id_usuario,$con);
		break;

	case 'eliminar_sancion':
		$id_sancion=$_REQUEST["id_sancion"];
	
		$respuesta=$carrera->delete($id_sancion,$con);
		break;
}
echo implode("#",$respuesta); 
?>