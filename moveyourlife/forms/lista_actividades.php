<?php
header("Content-type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
//Por el momento comento $asignatura. En el futuro será el factor de entrada (CP, Tipo actividad, etc)
//$asignatura = $_GET['asignatura'];
// Create connection
//echo "<h1>Listado completo para " . $asignatura . "</h1>";
//Datos conexión DDBB
$servidor = "localhost";
$usuario = "root";
$password = "";
$tabla = "db750092745";
$maximo = 10;
//
$con = new mysqli($servidor, $usuario, $password, $tabla);
$acentos = $con -> query("SET NAMES 'utf8'");

// Check  connection
if ($con -> connect_errno > 0) {
	die('Unable to connect to database [' . $db -> connect_error . ']');
}
$stm = $con -> prepare("select SUMMARY,DESCRIPCION,TARIFA,LIM_PERSONAS,FECHA,HORA_INICIO,DURACION from ACTIVIDADES where ID_EVENTO <= ? ");
$stm -> bind_param("i", $maximo);
$stm -> execute();
$stm -> bind_result($summary,$descripcion,$precio,$limite,$fecha,$hora,$duracion);
while($stm->fetch()) {
    $datos[]=array("summary"=>$summary,"descripcion"=>$descripcion,"precio"=>$precio,"limite"=>$limite,"fecha"=>$fecha,"hora"=>$hora,"duracion"=>$duracion);
}
print json_encode($datos);
mysqli_close($con);
?>
