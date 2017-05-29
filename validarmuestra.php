<?php
if(!empty($_REQUEST['titulo'])){ // Comprobamos que los valores recibidos no son NULL
    $conexion = mysqli_connect("localhost", "root", "", "shreportes") or
    die("Problemas con la conexión");
    echo $_REQUEST['idreporte'];
    $query_reportes = mysqli_query($conexion, "insert into reporte(idcategoria,idreplicacion,titulo,autor,observacion,fecha)
             select '$_REQUEST[categoria]', '$_REQUEST[idreporte]','$_REQUEST[titulo]','$_REQUEST[autor]','$_REQUEST[observacion]', CURDATE() FROM reporte")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    header("Location:muestra.php");
}
?>

