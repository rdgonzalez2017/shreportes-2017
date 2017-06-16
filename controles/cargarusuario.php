<?php
if(!empty($_REQUEST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $query_reportes = mysqli_query($conexion, "insert into usuarios(nombre,nombrecompleto,correo,clave,idtipodeusuario) VALUES 
                     ('$_REQUEST[nombre]','$_REQUEST[nombrecompleto]','$_REQUEST[correo]','$_REQUEST[clave]','$_REQUEST[tipo]') ")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    echo "<script>location.href='../agregarusuario.php';</script>";
    //header("Location:../agregarusuario.php");
}
?>