<?php
require_once("utilidades.class.php");
class Sancion extends Utilidades
{
	public function insert($status,$fecha_inicio,$fecha_fin,$usuario_id_usuario,$con)
	{
		$respuesta=array();
		$sql="INSERT INTO sancion (status,fecha_inicio,fecha_fin,usuario_id_usuario) VALUES ('activo','$fecha_inicio','$fecha_fin',$usuario_id_usuario)";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Sancion realizada con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al registrar los datos";
		}
		return $respuesta;
	}

	public function update($id_sancion,$status,$fecha_inicio,$fecha_fin,$usuario_id_usuario,$con)
	{
		$respuesta=array();
		$sql="UPDATE sancion SET id_sancion='$id_sancion',fecha_inicio='$fecha_inicio',fecha_fin='$fecha_fin',usuario_id_usuario='$usuario_id_usuario' WHERE id_sancion=$id_sancion";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Sancion actualizado con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al actualizar los datos";
		}
		return $respuesta;
	}

	public function delete($id_sancion,$con)
	{
		$respuesta=array();
		$sql="DELETE FROM sancion WHERE id_sancion=$id_sancion";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
		{
			$respuesta['exito']=1;
			$respuesta['mensaje']="Sancion eliminada con exito";
		}
		else
		{
			$respuesta['exito']=0;
			$respuesta['mensaje']="Error al eliminar los datos";
		}
		return $respuesta;
	}
}
?>