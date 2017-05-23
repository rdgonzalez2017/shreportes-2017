<!doctype html>
<html>
<head>
    <title>Listado de reportes</title>
    <link rel="stylesheet" type="text/css" href="css/estilotabla.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<div style="float: left">
    <input type="submit" class="btn btn-success btn-sm" value="Regresar" onclick = "location='sistema.php'"/>
</div>
<body>

<?php
$conexion=mysqli_connect("localhost","root","","shreportes") or
die("Problemas con la conexión");

$registros=$conexion->query("select * from reporte order by idreporte") or
die($conexion->error);

echo '<table class="tablalistado col-md-8 col-md-offset-1" >';
echo '<tr><th>Id Reporte</th><th>Titulo</th><th>Autor</th><th>Observacion</th><th>Fecha</th></tr>';
while ($reg=$registros->fetch_array())
{
    echo '<tr>';
    echo '<td>';
    echo $reg['idreporte'];
    echo '</td>';
    echo '<td>';
    echo $reg['titulo'];
    echo '</td>';
    echo '<td>';
    echo $reg['autor'];
    echo '</td>';
    echo '<td>';
    echo $reg['observacion'];
    echo '</td>';
    echo '<td>';
    echo $reg['fecha'];
    echo '</td>';
    echo '</tr>';
}
echo '<table>';

$conexion->close();

?>
</body>
</html>