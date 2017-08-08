<?php
$servidor = "localhost";
$Usuario = "root";
$clave = "";
$DB  = "multiser_whmcs";
$conexion=mysqli_connect("$servidor","$Usuario","$clave","$DB")
or die("Problemas con la conexion " . mysqli_error($conexion));