<?php
require_once("utilidades.class.php");
class Empleado extends Utilidades
{

	function conexion()
	{
		$con = new mysqli("localhost","root","","biblioteca");
		if ($con->connect_errno)
		{
		    echo "Fallo al conectar al servidor: (" . $con->connect_errno . ") " . $con->connect_error;
		}		
		else		
			return $con;
	}

	public function insert($nombres,$apellidos,$usuario,$clave,$n_cedula,$correo,$tipo_empleado_id_tipo_empleado,$con)
	{
		$respuesta=array();
		$sql="INSERT INTO empleado (n_cedula,nombres,apellidos,correo,usuario,clave,tipo_empleado_id_tipo_empleado) VALUES ('$n_cedula','$nombres','$apellidos','$correo','$usuario','$clave',$tipo_empleado_id_tipo_empleado)";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Empleado registrado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al registrar los datos";
		}
		return $respuesta;
	}

	public function update($id_empleado,$nombres,$apellidos,$n_cedula,$usuario,$clave,$correo,$tipo_empleado_id_tipo_empleado,$con)
	{
		$respuesta=array();
		$sql="UPDATE empleado SET nombres='$nombres',apellidos='$apellidos',n_cedula='$n_cedula',correo='$correo',usuario='$usuario',clave='$clave',tipo_empleado_id_tipo_empleado='$tipo_empleado_id_tipo_empleado' WHERE id_empleado=$id_empleado";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Datos del usuario actualizados con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al modificar los datos";
		}
		return $respuesta;
	 }
	public function delete($id_empleado,$con)
	{
		$respuesta=array();
		$sql="DELETE FROM empleado WHERE id_empleado=$id_empleado";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Empleado eliminado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al eliminar los datos";
		}
		return $respuesta;
	}

	public function login($usuario, $clave, $con)
	{
		$respuesta=array();
		$sql="SELECT id_empleado, nombres, usuario, tipo_empleado_id_tipo_empleado FROM empleado WHERE usuario='$usuario' AND clave='$clave'";
		$registros=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Usuario logeado exitosamente";
			$respuesta['registros']= $registros->fetch_assoc();
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Usuario o contraseña incorrectas";
		}
		return $respuesta;
	}
	
}
