<?php
//Crear conexi�n a la Base de Datos
$conexion = mysql_connect("localhost","qvm602","password");
if (!$conexion){
	die("Fallo la conexi�n a la Base de Datos: " . mysql_error());
}
// Seleccionar la Base de Datos a utilizar
$seleccionar_bd = mysql_select_db("bbdd", $conexion);
if (!$seleccionar_bd) {
	die("Fallo la selecci�n de la Base de Datos: " . mysql_error());
}
// compruebo que la conexion es corecta
if (!$conexion || !$seleccionar_bd) {
	die('Fallo la conexi�n o la selecci�n de la Base de Datos: ');
}

$hoy = date ("Y-n-d H:i:s");
$ayer = strtotime($hoy)-86400;
$ayer = date("Y-n-d H:i:s",$ayer);
$query = "SELECT date,nombre,mensaje FROM  Mensajes WHERE date > '$ayer' ORDER BY date DESC LIMIT 20";
	
$result = mysql_query($query,$conexion);
	
if (!$result) {
	die("Fallo en la consulta: " . mysql_error());
}
// Pinto los campos de la consulta
echo "<table border='2'>";
echo "<tr>";
while ($campo = mysql_fetch_field($result)){
	echo ("<td> <b> $campo->name </b> </td>");
}
echo "</tr>";
// recorro todas las filas y saco el NI y el comentario
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	echo "<tr>";
	foreach ($row as $item){
		echo ("<td>$item</td>");
	}
	echo "</tr>";
}
echo "</table>";
mysql_close($conexion);	
?>