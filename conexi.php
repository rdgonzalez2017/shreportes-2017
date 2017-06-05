<?php

$servidor = "localhost";
$usuario = "root";
$contrasena ="";
$db = "multiser_shreportes";
$conexion = @mysql_connect($servidor, $usuario, $contrasena);
if (!$conexion) {
    die("No Conecto a servir por " .mysql_error());
} /*else {
    echo "si conectó!!";
	
}*/

mysql_select_db($db, $conexion) or die(mysql_error($conexion));



?>
