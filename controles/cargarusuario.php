<?php
if(!empty($_REQUEST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
    $conexion = mysqli_connect("localhost", "root", "", "shreportes") or
    die("Problemas con la conexión");
    $query_reportes = mysqli_query($conexion, "insert into usuarios(nombre,correo,clave,idtipodeusuario) VALUES 
                     ('$_REQUEST[nombre]','$_REQUEST[correo]','$_REQUEST[clave]','$_REQUEST[tipo]') ")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    header("Location:../agregarusuario.php");
}
?>