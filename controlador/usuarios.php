<?php
require("../modelo/usuarios.php");
$carrera=new Usuarios; 
$con=$carrera->conexion();
$respuesta=array();
switch($_REQUEST["accion"])
{
	case 'agregar_usuarios':
		$n_cedula=$_REQUEST['n_cedula'];
		$nombres=$_REQUEST['nombres'];
		$apellidos=$_REQUEST['apellidos'];
		$status=$_REQUEST['status'];
		$usuario=$_REQUEST['usuario'];
		$clave=$_REQUEST['clave'];
		$respuesta=$carrera->insert($n_cedula,$nombres,$apellidos,$status,$usuario,$clave,$con);
		break;

  case 'modificar_usuarios':
	  	$id_usuario=$_REQUEST['id_usuario'];
			$n_cedula=$_REQUEST['n_cedula'];
			$nombres=$_REQUEST['nombres'];
			$apellidos=$_REQUEST['apellidos'];
			$status=$_REQUEST['status'];
			$usuario=$_REQUEST['usuario'];
			$clave=$_REQUEST['clave'];
			$respuesta=$carrera->insert($id_usuario,$n_cedula,$nombres,$apellidos,$status,$usuario,$clave,$con);
			break;

	case 'iniciar_sesion':
		$usuario=$_REQUEST["usuario"];
		$clave=$_REQUEST["clave"];

		$respuesta=$carrera->login($usuario,$clave,$con);
		break;
}
echo implode("#",$respuesta); 
?>