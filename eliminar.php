<?php
include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos

$query_MostrarTitulos = mysql_query("SELECT idreporte, titulo, fecha FROM reporte"); // Ejecutamos la consulta

while($columna_MostrarTitulos = mysql_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
{
    echo $columna_MostrarTitulos['titulo'].' - <a href="?reporte='.$columna_MostrarTitulos['idreporte'].'">Eliminar</a> <br />';  // Mostramos el titulo y un enlace para eliminar la noticia
}

if(isset($_GET['reporte']))
{
    $idreporte = (int) mysql_real_escape_string($_GET['reporte']);

    $query_eliminar = mysql_query("select idreplicacion FROM reporte WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
    //$query_eliminar = mysql_query("DELETE FROM reporte WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
    while($columna = mysql_fetch_assoc($query_eliminar)) // Realizamos un bucle que muestre los títulos de las noticias, utilizando while.
    {
        $idreplicacion = $columna['idreplicacion'];
        echo $idreplicacion;
    }
        if($query_eliminar)
    {
        $query_insertar = mysql_query("insert into reporte (idreplicacion) select idreporte from reporte order by idreporte DESC limit 1")
        echo 'La noticia se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
    }
    else
    {
        echo 'La noticia no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}
?>
