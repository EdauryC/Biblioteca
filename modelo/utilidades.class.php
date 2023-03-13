<?php
class Utilidades
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

	function selectAll($tabla,$con)
	{
		$sql="SELECT * FROM $tabla";
		$registros=$con->query($sql);
		return $registros;
	}

	function selectOne($tabla,$campo,$valor,$con)
	{
		$sql="SELECT * FROM $tabla WHERE $campo='$valor' LIMIT 1";
		$registros=$con->query($sql);
		return $registros->fetch_assoc();
	}

	function selectSQL($tabla,$sql,$con)
	{
		$registros=$con->query($sql);
		return $registros;
	}
}
?>