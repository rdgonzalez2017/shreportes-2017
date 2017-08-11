<?php
$servidor = "localhost";
$Usuario = "root";
$clave = "";
$DB_2  = "multiser_whmcs";
$conexion=mysqli_connect("$servidor","$Usuario","$clave","$DB_2")
or die("Problemas con la conexion " . mysqli_error($conexion));