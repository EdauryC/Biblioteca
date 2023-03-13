<?php
require("../modelo/libro.php");
$carrera=new Libro; 
$con=$carrera->conexion();
$respuesta=array();
switch($_REQUEST["accion"])
{
	case 'agregar_libro':
		$codigo=$_REQUEST['codigo'];
		$autor=$_REQUEST['autor'];
		$nombre=$_REQUEST['nombre'];
		$descripcion=$_REQUEST['descripcion'];
		$n_ejemplares=$_REQUEST['n_ejemplares'];
		$status=$_REQUEST['status'];
		$ISNB=$_REQUEST['ISNB'];
		$categoria_libro_id_categoria_libro=$_REQUEST['categoria_libro_id_categoria_libro'];
		$respuesta=$carrera->insert($codigo,$autor,$nombre,$descripcion,$n_ejemplares,$status,$ISNB,$categoria_libro_id_categoria_libro,$con);
		break;

	case 'modificar_libro':
		$id_libro=$_REQUEST['id_libro'];
		$codigo=$_REQUEST['codigo'];
		$autor=$_REQUEST['autor'];
		$nombre=$_REQUEST['nombre'];
		$descripcion=$_REQUEST['descripcion'];
		$n_ejemplares=$_REQUEST['n_ejemplares'];
		$status=$_REQUEST['status'];
		$ISNB=$_REQUEST['ISNB'];
		$categoria_libro_id_categoria_libro=$_REQUEST['categoria_libro_id_categoria_libro'];
		$respuesta=$carrera->update($id_libro,$codigo,$autor,$nombre,$descripcion,$n_ejemplares,$status,$ISNB,$categoria_libro_id_categoria_libro,$con);
		break;

	case 'eliminar_libro':
		$id_libro=$_REQUEST["id_libro"];
		$respuesta=$carrera->delete($id_libro,$con);
		break;
	case 'buscar_libro':
		$id_libro=$_REQUEST['id_libro'];
		$respuesta=$carrera->search($id_libro,$con);
		break;
		break;
}
echo implode("#",$respuesta); 
?>