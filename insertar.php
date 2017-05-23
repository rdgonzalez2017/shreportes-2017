<html>
<html>
<head>
    <title>Insertar</title>
</head>
<body>
<?php
$conexion=mysqli_connect("localhost","root","","shreportes") or
die("Problemas con la conexión");

mysqli_query($conexion,"insert into reporte(titulo,autor,observacion) values 
                       ('$_REQUEST[titulo]','$_REQUEST[autor]','$_REQUEST[observacion]')")
or die("Problemas en el select".mysqli_error($conexion));

mysqli_close($conexion);

echo "Se ingresaron los datos.";
?>
<?php include('conexi.php');?>

<?php

//Mostrar Datos Guardados

$select = "titulo,autor,observacion,fecha";//Campos de la tabla
$idreporte = "idreporte";
$sql_tabla = "reporte";
$consulta = mysql_query("SELECT $select FROM $sql_tabla ORDER BY $idreporte DESC LIMIT 1") or die("error mysql");
while($resultados = mysql_fetch_array($consulta)) {

    $titulo = $resultados['titulo'];
    $autor = $resultados['autor'];
    $observacion = $resultados['observacion'];
    $fecha = $resultados['fecha'];

}
echo "<font face=verdana size=2 color=black><center>";
echo "Titulo: <b>".$titulo."</b>
, autor: <b>".$autor."</b>
, observacion: <b>".$observacion."</b>
, fecha: <b>".$fecha."</b>";
?>
</body>
</html>