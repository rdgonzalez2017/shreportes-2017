<!DOCTYPE html>
<html>
<?php include("head.php");?>
<?php include("navbar/navbarmodificar.php");?>
<body>

<div class="col-md-6 col-md-offset-3">
<?php
include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos
$query_MostrarCantidad = mysql_query("SELECT COUNT(*) as cantidad FROM reporte"); // Ejecutamos la consulta
while($columna= mysql_fetch_assoc($query_MostrarCantidad)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
    $cantidad =  $columna['cantidad'].'<br>';
//echo $cantidad;
if($cantidad>1):
$query_MostrarTitulos = mysql_query("SELECT COUNT(*) as cantidad, idreporte, titulo, fecha, autor FROM reporte GROUP BY 2"); // Ejecutamos la consulta
while($columna_MostrarTitulos = mysql_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
{
    echo '<div class="row well text-center">';
    echo'Id de reporte: '; echo $columna_MostrarTitulos['idreporte'].'<br/>';
    echo'Autor: '; echo $columna_MostrarTitulos['autor'].'<br/> ';
    echo'Fecha: '; echo $columna_MostrarTitulos['fecha'].'<br/> ';
    echo'Titulo: ';echo $columna_MostrarTitulos['titulo'].'  <br>';
    echo ' <a class="btn btn-danger bounce animated animated" data-wow-duration="1500ms"" href="?reporte='.$columna_MostrarTitulos['idreporte'].'">Eliminar</a> <br/>';  // Mostramos el titulo y un enlace para eliminar la noticia
    //else: echo 'Nota: No se deben Eliminar todos los reportes.';
}
else: echo 'Nota: No se deben eliminar todos los reportes y solo queda 1.';
endif;
if(isset($_GET['reporte']))
{
    $idreporte = (int) mysql_real_escape_string($_GET['reporte']);

    $query_eliminar = mysql_query("DELETE FROM reporte WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos

    if($query_eliminar)
    {
        header("Location:eliminareportes.php");
        echo 'El reporte se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
    }
    else
    {
        echo 'El reporte no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}
?>
</div>
