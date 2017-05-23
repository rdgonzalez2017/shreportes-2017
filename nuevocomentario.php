<?php

$reporte = $_REQUEST['id'];
$idprotegido = $_REQUEST['idprotegido'];
echo $reporte;
if(!empty($_REQUEST['id'])) { // Comprobamos que los valores recibidos no son NULL
    $conexion = mysqli_connect("localhost", "root", "", "shreportes") or
    die("Problemas con la conexión");
    $query_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,comentario,fecha) 
    SELECT NULL, '$_REQUEST[id]', '$_REQUEST[nick]', '$_REQUEST[comentario]', now()
    FROM reporte where idreporte = $reporte LIMIT 1")
    or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
    mysqli_close($conexion);

    header("Location:muestra.php?reporte=" . $idprotegido);
}
?>


