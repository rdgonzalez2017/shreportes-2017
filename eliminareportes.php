<!DOCTYPE html>
<html>
<?php include("head.php");?>
<?php include("navbar/navbarmodificar.php");?>
<body>
<div class="col-md-6 col-md-offset-3">
<?php
include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos

$query_MostrarTitulos = mysql_query("SELECT idreporte, titulo, fecha, autor FROM reporte"); // Ejecutamos la consulta

while($columna_MostrarTitulos = mysql_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
{
    echo '<div class="row well text-center">';
    echo'Id de reporte: '; echo $columna_MostrarTitulos['idreporte'].'<br/>';
    echo'Autor: '; echo $columna_MostrarTitulos['autor'].'<br/> ';
    echo'Fecha: '; echo $columna_MostrarTitulos['fecha'].'<br/> ';
    echo'Titulo: ';echo $columna_MostrarTitulos['titulo'].'  <br>
    <a class="btn btn-danger bounce animated animated" data-wow-duration="1500ms"" href="?reporte='.$columna_MostrarTitulos['idreporte'].'">Eliminar</a> <br/>';  // Mostramos el titulo y un enlace para eliminar la noticia
    echo '</div>';
}

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
