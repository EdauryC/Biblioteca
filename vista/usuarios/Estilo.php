<?php
session_start();
require_once("../../modelo/usuarios.php");
$carrera = new Usuarios;
$con = $carrera->conexion(); 
$registros=$carrera->selectAll("usuario",$con);
?>
<style>

table {
    border-collapse: collapse;
}
 
table,
th,
td {
    border: 1px solid black;
}
 
th,
td {
    padding: 5px;
}
</style>
<h1>Usuarios Registrados</h1>
<table>
    <thead>
        <tr>
		    <td align="center" class="cabecera_columna border-0">ID del usuario</td>
		    <td class="cabecera_columna border-0">Cedula</td>
		    <td align="center" class="cabecera_columna border-0">Nombres</td>
		    <td align="center" class="cabecera_columna border-0">Apellidos</td>
			<td align="center" class="cabecera_columna border-0">Usuario</td>
		    <td align="center" class="cabecera_columna border-0">Status</td>     	
        </tr>
    </thead>
    <tbody>
    <?php	while (($fila=$registros->fetch_assoc())>0) 
	{
	   echo "<tr>";
	   echo "<td align='center'>".$fila['id_usuario']."</td>";
	   echo "<td>".$fila['n_cedula']."</td>";
	   echo "<td align='center'>".$fila['nombres']."</td>";
	   echo "<td align='center'>".$fila['apellidos']."</td>";
	   echo "<td align='center'>".$fila['usuario']."</td>";
	   echo "<td align='center'>".$fila['status']."</td>";
	   echo "</tr>";
     }
     ?>
    </tbody>
</table>
<?php
require_once ('../dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
ob_start();
include "./formulario_usuario.php";
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->render();
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
echo $dompdf->output();
?>