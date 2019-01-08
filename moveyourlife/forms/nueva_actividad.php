<?php
header('Content-Type: text/html; charset=utf-8');

if (isset($_POST["summary"])) {
	$summary = $_POST["summary"];
} else {
	echo '<p>Erro. No se ha introducido un título correcto</p>';
}
if (isset($_POST["descripcion"])) {
    $descripcion = $_POST["descripcion"];
} else {
    echo '<p>Erro. No se ha introducido una descripción correcta</p>';
}
if (isset($_POST["tipo"])) {
    $tipo = $_POST["tipo"];
} else {
    echo '<p>Erro. No se ha introducido un tipo de actividad correcto</p>';
}
if (isset($_POST["limite"])) {
    $limite = $_POST["limite"];
} else {
    echo '<p>Erro. No se ha introducido un límite de personas correcto</p>';
}
if (isset($_POST["precio"])) {
    $precio = $_POST["precio"];
} else {
    echo '<p>Erro. No se ha introducido un precio correcto</p>';
}
if (isset($_POST["fecha"])) {
    $fecha = $_POST["fecha"];
} else {
    echo '<p>Erro. No se ha introducido una fecha correcta</p>';
}
if (isset($_POST["hora"])) {
    $hora = $_POST["hora"];
} else {
    echo '<p>Erro. No se ha introducido una hora correcta</p>';
}
if (isset($_POST["duracion"])) {
    $duracion = $_POST["duracion"];
} else {
    echo '<p>Erro. No se ha introducido una duracion correcta</p>';
}
if (isset($_POST["ubicacionx"])) {
    $ubicacionx = $_POST["ubicacionx"];
} else {
    echo '<p>Erro. No se ha introducido una ubicacion X correcta</p>';
}
if (isset($_POST["ubicaciony"])) {
    $ubicaciony = $_POST["ubicaciony"];
} else {
    echo '<p>Erro. No se ha introducido una ubicacion y correcta</p>';
}

//Variables temporales. Se deberán sustituir por los valores de sesión
$creador = 2;

//Datos conexión DDBB
$servidor = "localhost";
$usuario = "root";
$password = "";
$tabla = "db750092745";
//
$con = new mysqli($servidor, $usuario, $password, $tabla);
$acentos = $con -> query("SET NAMES 'utf8'");
if ($con -> connect_errno > 0) {
    die('Unable to connect to database [' . $db -> connect_error . ']');
}
$stm = $con->prepare("INSERT INTO actividades (ID_CREADOR,LIM_PERSONAS,SUMMARY,DESCRIPCION,UBICACION_X,UBICACION_Y,TARIFA,TIPO_ACT,FECHA,HORA_INICIO,DURACION) values (?,?,?,?,?,?,?,?,?,?,?) ");
$stm -> bind_param("iissdddsiid",$creador,$limite,$summary,$descripcion,$ubicacionx,$ubicaciony,$precio,$tipo, $fecha,$hora,$duracion);
$stm -> execute();
printf("Error: %s.\n", $stm->error);
// Check  connection

echo "<p>Se ha introducido el nuevo contenido. Eres un máquina!</p>";

//echo "<a href='http://www.solucionatusproblemas.es/metedatos.html'>Volver a la pÃ¡gina de introducciÃ³n de datos</a>";


?>