<?php
$pdo = new PDO('mysql:host=localhost;dbname=shreportes', "root", "");
$nombre = $_REQUEST['nick'];
$query = "insert into comentarios(id,idreporte,nick,comentario,fecha) 
    SELECT NULL, '$_REQUEST[id]', $nombre, '$_REQUEST[comentario]', now()
    FROM reporte where idreporte = $reporte LIMIT 1";
$sentencia = $pdo->prepare($query);
$sentencia=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$sentencia->bindParam(":idusuario",$nombre , PDO::PARAM_STR);
$sentencia->execute();
?>

