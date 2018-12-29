<!doctype html>
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Move your life</title>
  <meta name="description" content="">
  <meta name="author" content="J. Izquierdo">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/style.css">
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script src="js/mylibs/script.js"></script>


</head>
<body>


<?php
header('Content-Type: text/html; charset=utf-8');
//Por el momento comento $asignatura. En el futuro será el factor de entrada (CP, Tipo actividad, etc)
//$asignatura = $_GET['asignatura'];
// Create connection
//echo "<h1>Listado completo para " . $asignatura . "</h1>";
echo "<h1>Listado completo de actividades </h1>";
//Datos conexión DDBB
$servidor = "localhost";
$usuario = "root";
$password = "contraseña";
$tabla = "db750092745";
//
$con = new mysqli("localhost", "root", "contraseÃ±a", "problemas");
$acentos = $con -> query("SET NAMES 'utf8'");

// Check  connection
if ($con -> connect_errno > 0) {
	die('Unable to connect to database [' . $db -> connect_error . ']');
}
$stm = $con -> prepare("select DISTINCT(curso) from soluciones where asignatura = ? ");
$stm -> bind_param("s", $asignatura);
$stm -> execute();
$stm -> bind_result($cursos);
$curso = array();
$i = 0;
while ($stm -> fetch()) {
	$curso[$i] = $cursos;
	$i++;
}
$iactivo = 0;

foreach ($curso as $c) {
	if($iactivo == 0){
		echo "<h2 class='titular_activo'>" . $c . "</h2>";
	}else{
		echo "<h2 class='titular_inactivo'>" . $c . "</h2>";
	}
	$stm2 = $con -> prepare("select DISTINCT(bloque) from soluciones where asignatura = ? and curso = ?");
	$stm2 -> bind_param("ss", $asignatura, $c);
	$stm2 -> execute();
	$stm2 -> bind_result($bloques);
	$curso = array();
	$i = 0;
	while ($stm2 -> fetch()) {
		$bloque[$i] = $bloques;
		$i++;
	}
	foreach ($bloque as $b) {
			if($iactivo == 0){
		echo "<h3 class='titular_activo'>" . $b . "</h3>";
	}else{
		echo "<h3 class='titular_inactivo'>" . $b . "</h3>";
	}
	}
	$stm3 = $con -> prepare("select enunciado,enlace from soluciones where asignatura = ? and curso = ? and bloque = ?");
	$stm3 -> bind_param("sss", $asignatura, $c, $b);
	$stm3 -> execute();
	$stm3 -> bind_result($enunciados, $enlaces);
	$enunciado = array();
	$enlace = array();
	$j = 0;
	while ($stm3 -> fetch()) {
		$enunciado[$j]=$enunciados;
		$enlace[$j]=$enlaces;

	}
	$length = count($enunciado);
		if($iactivo == 0){
		echo "<table class='listado_activo'>";
	}else{
		echo "<table class='listado_inactivo'>";
	}
	$iactivo = 1;	
	for ($k = 0; $k < $length; $k++) {
  	echo "<tr>";		
    					echo "<td class='enunciado'>".$enunciado[$k]."</td>";
    					echo "<td> <iframe width='420' height='315'
								src='".$enlace[$k]."'> </iframe></td>
			</tr>";
}
echo "</table>";

}
?>
</body>
</html>
