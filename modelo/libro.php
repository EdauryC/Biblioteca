<?php
require_once("utilidades.class.php");
class Libro extends Utilidades
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
	
	public function insert($codigo,$autor,$nombre,$descripcion,$n_ejemplares,$status,$ISNB,$categoria_libro_id_categoria_libro,$con)
	{
		$respuesta=array();
		$sql="INSERT INTO libro (codigo,autor,nombre,descripcion,n_ejemplares,status,ISNB,categoria_libro_id_categoria_libro) VALUES ('$codigo','$autor','$nombre','$descripcion','$n_ejemplares','$status','$ISNB',$categoria_libro_id_categoria_libro)";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Libro registrado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al registrar los datos";
		}
		return $respuesta;
	}

	public function update($id_libro,$codigo,$nombre,$autor,$descripcion,$n_ejemplares,$status,$ISNB,$categoria_libro_id_categoria_libro,$con)
	{
		$respuesta=array();
		$sql="UPDATE libro SET id_libro='$id_libro',codigo='$codigo',nombre='$nombre',autor='$autor',descripcion='$descripcion',n_ejemplares='$n_ejemplares',status='$status',ISNB='$ISNB',categoria_libro_id_categoria_libro='$categoria_libro_id_categoria_libro' WHERE id_libro=$id_libro";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Datos Modificados con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al modificar los datos";
		}
		return $respuesta;
	}

	public function delete($id_libro,$con)
	{
		$respuesta=array();
		$sql="DELETE FROM libro WHERE id_libro=$id_libro";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Libro eliminado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al eliminar los datos";
		}
		return $respuesta;
	}

	public function search($codigo,$con)
	{
		$respuesta=array();
		$sql="SELECT * FROM libro WHERE codigo='$codigo'";
		$registros=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Libro encontrado con exito";
			$respuesta['registros'] = $registros;
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="No se ha encontrado un libro que coincida con la busqueda";
		}
		return $respuesta;
	}
}
?>