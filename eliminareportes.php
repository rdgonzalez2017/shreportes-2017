<?php session_start();?>
<!DOCTYPE html>
<html>
<?php include("head.php");?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarsistema.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>
<?php if (isset($_SESSION['nombre'])):?>
<body>
<div class="col-md-6 col-md-offset-3">
<?php
include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
$query_MostrarTitulos = mysqli_query($conexion,"SELECT COUNT(*) as cantidad, idreporte, titulo, fecha, autor FROM reporte GROUP BY 2")
or die("Problemas en el select:".mysqli_error($conexion));
while($columna_MostrarTitulos = mysqli_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
{
    echo '<div class="row well text-center">';
    echo'Id de Incidencia: '; echo $columna_MostrarTitulos['idreporte'].'<br/>';
    echo'Autor: '; echo $columna_MostrarTitulos['autor'].'<br/> ';
    echo'Fecha: '; echo $columna_MostrarTitulos['fecha'].'<br/> ';
    echo'Titulo: ';echo $columna_MostrarTitulos['titulo'].'  <br>';
    echo ' <a class="btn btn-danger bounce animated animated" data-wow-duration="1500ms"" href="?reporte='.$columna_MostrarTitulos['idreporte'].'">Eliminar</a> <br/>';  // Mostramos el titulo y un enlace para eliminar la noticia
    //else: echo 'Nota: No se deben Eliminar todos los reportes.';
    echo '</div>';
}

if(isset($_GET['reporte']))
{
    $idreporte = ($_GET['reporte']);

    $query_eliminar = mysqli_query($conexion,"DELETE FROM reporte WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos

    if($query_eliminar)
    {
        //header("Location:eliminareportes.php");
        echo 'La incidencia se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
    }
    else
    {
        echo 'La incidencia no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}
?>
<?php else: echo"Debe iniciar sesión para ingresar a esta página";
endif;?>
</div>
<html>
