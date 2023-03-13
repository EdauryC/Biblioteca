<?php
require_once("utilidades.class.php");
class Usuarios extends Utilidades
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

	public function insert($n_cedula,$nombres,$apellidos,$status,$usuario,$clave,$con)
	{
		$respuesta=array();
		$sql="INSERT INTO usuario (n_cedula,nombres,apellidos,status,usuario,clave) VALUES('$n_cedula','$nombres','$apellidos','activo','$usuario','$clave')";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Usuario registrado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al registrar los datos";
		}
		return $respuesta;
	}

	public function update($id_usuario,$nombres,$apellidos,$status,$usuario,$clave,$con)
	{
		$respuesta=array();
		$sql="UPDATE usuario SET id_usuario='$id_usuario',nombres='$nombres',apellidos='$apellidos',status='$status',usuario='$usuario',clave='$clave' WHERE id_usuario=$id_usuario";
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

	public function login($usuario, $clave, $con)
	{
		$respuesta=array();
		$sql="SELECT usuario FROM usuario WHERE usuario='$usuario' AND clave='$clave'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Usuario logeado exitosamente";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Usuario o contraseña incorrectas";
		}
		return $respuesta;
	}

	public function search($cedula,$con)
	{
		$respuesta=array();
		$sql="SELECT * FROM usuario WHERE n_cedula='$cedula'";
		$registros=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Usuario encontrado con exito";
			$respuesta['registros'] = $registros->fetch_assoc();
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="No se ha encontrado un usuario que coincida con la busqueda";
		}
		return $respuesta;
	}

	public function buscarPrestamo($cedula,$con)
	{
		$respuesta=array();

		$sql="SELECT usuario.id_usuario as id_usuario, usuario.n_cedula as n_cedula, usuario.nombres as nombres, usuario.apellidos as apellidos, usuario.status as user_status, prestamo.status as prestamo_status, prestamo.fecha_prestamo as fecha_prestamo, prestamo.fecha_vencimiento as fecha_vencimiento, prestamo.id_prestamo as id_prestamo, libro_x_prestamo.libro_id_libro as libro_id_libro, libro_x_prestamo.codigo_ejemplar as codigo_ejemplar FROM usuario INNER JOIN prestamo INNER JOIN libro_x_prestamo ON usuario.n_cedula='$cedula' AND usuario.id_usuario = prestamo.usuario_id_usuario AND libro_x_prestamo.prestamo_id_prestamo = prestamo.id_prestamo AND prestamo.status = 'prestado'";
		$registros=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Usuario encontrado con exito";
			$respuesta['registros'] = $registros;
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="No se ha encontrado un usuario que coincida con la busqueda";
		}
		return $respuesta;
	}
}
?>