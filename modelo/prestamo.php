<?php
require_once("utilidades.class.php");
class Prestamo extends Utilidades
{
	function conexion()
	{
		$con = new mysqli("localhost", "root", "", "biblioteca");
		if ($con->connect_errno) {
			echo "Fallo al conectar al servidor: (" . $con->connect_errno . ") " . $con->connect_error;
		} else
			return $con;
	}

	public function insert($codigo_ejemplar, $fecha_prestamo, $fecha_vencimiento, $libro_id_libro, $usuario_id_usuario, $empleado_id_empleado, $con)
	{
		$respuesta = array();
		$status = 'prestado';
		$fechaPrestamo = date("Y-m-d", strtotime($fecha_prestamo));
		$fechaVencimiento = date("Y-m-d", strtotime($fecha_vencimiento));
		$sql = "INSERT INTO prestamo (status, fecha_prestamo, fecha_vencimiento, usuario_id_usuario, empleado_id_empleado) VALUES ('$status','$fechaPrestamo','$fechaVencimiento',$usuario_id_usuario,$empleado_id_empleado)";
		$ok = $con->query($sql);
		$afectadas = $con->affected_rows;
		if ($afectadas > 0) {
			$prestamoId = $con->insert_id;
			$sql = "INSERT INTO libro_x_prestamo (prestamo_id_prestamo, libro_id_libro, codigo_ejemplar) VALUES ($prestamoId,$libro_id_libro,'$codigo_ejemplar')";
			$ok = $con->query($sql);
			$afectadasDetalle = $con->affected_rows;
			if ($afectadasDetalle > 0) {
				$sql = "SELECT * FROM libro WHERE id_libro=$libro_id_libro";
				$ok = $con->query($sql);
				$afectadasEjemplares = $ok->fetch_assoc();
				$n_ejemplares = $afectadasEjemplares['n_ejemplares'] - 1;

				$sql = "UPDATE libro SET n_ejemplares=$n_ejemplares WHERE id_libro=$libro_id_libro";
				$ok = $con->query($sql);
				$afectadasLibro = $con->affected_rows;
				if ($afectadasLibro > 0) {
					$respuesta['exito'] = 1;
					$respuesta['mensaje'] = "Prestamo registrado con exito";
				} else {
					$respuesta['exito'] = 0;
					$respuesta['mensaje'] = "Error al actualizar el libro";
				}
			} else {
				$respuesta['exito'] = 0;
				$respuesta['mensaje'] = "Error al registrar los datos del detalle";
			}
		} else {
			$respuesta['exito'] = 0;
			$respuesta['mensaje'] = "Error al registrar los datos del prestamo";
		}
		return $respuesta;
	}

	public function update($libro_id_libro, $idEstudiante, $idPrestamo, $codigo_ejemplar, $fecha_inicio, $fecha_fin, $con)
	{
		$respuesta = array();
		$sql = "UPDATE prestamo SET status='cerrado' WHERE id_prestamo=$idPrestamo";
		$ok = $con->query($sql);
		$afectadas = $con->affected_rows;
		if ($afectadas > 0) {
			$sql = "SELECT * FROM libro WHERE id_libro=$libro_id_libro";
			$ok = $con->query($sql);
			$afectadasEjemplares = $ok->fetch_assoc();
			$n_ejemplares = $afectadasEjemplares['n_ejemplares'] + 1;

			$sql = "UPDATE libro SET n_ejemplares=$n_ejemplares WHERE id_libro=$libro_id_libro";
			$ok = $con->query($sql);

			if($afectadasEjemplares > 0){
				if($fecha_inicio != "na" && $fecha_fin != "na"){
					$sql="INSERT INTO sancion (status,fecha_inicio,fecha_fin,usuario_id_usuario) VALUES ('activo','$fecha_inicio','$fecha_fin',$idEstudiante)";
					$ok=$con->query($sql);
					$afectadasSansion=$con->affected_rows;
					if ($afectadasSansion>0)
					{
						$respuesta['exito']=1;
						$respuesta['mensaje']="Sancion realizada con exito";
					}
					else{
						$respuesta['exito'] = 0;
						$respuesta['mensaje'] = "Error al realizar sansion";
					}
				}
				else{
					$respuesta['exito'] = 1;
					$respuesta['mensaje'] = "Datos del prestamo actualizados con exito";
				}
			}
			else {
				$respuesta['exito'] = 0;
				$respuesta['mensaje'] = "Error al modificar los datos";
			}
		} else {
			$respuesta['exito'] = 0;
			$respuesta['mensaje'] = "Error al devolver prestamo";
		}
		return $respuesta;
	}

	public function delete($id_prestamo, $con)
	{
		$respuesta = array();
		$sql = "DELETE FROM prestamo WHERE id_prestamo=$id_prestamo";
		$ok = $con->query($sql);
		$afectadas = $con->affected_rows;
		if ($afectadas > 0) {
			$respuesta['exito'] = 1;
			$respuesta['mensaje'] = "Prestamo eliminado con exito";
		} else {
			$respuesta['exito'] = 0;
			$respuesta['mensaje'] = "Error al eliminar los datos";
		}
		return $respuesta;
	}
}
