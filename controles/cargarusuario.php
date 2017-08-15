<?php
session_start();
$claveencriptada = md5($_REQUEST['clave']);
//echo $claveencriptada;
if (isset($_SESSION['nombre'])):
if(!empty($_POST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
    require ("../config/conexion.php");
    $query_reportes = mysqli_query($conexion, "insert into usuarios(nombre,nombrecompleto,correo,clave,idtipodeusuario) VALUES 
                     ('$_POST[nombre]','$_POST[nombrecompleto]','$_POST[correo]','$claveencriptada','$_POST[tipo]') ")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    echo "<script>location.href='../complementos/agregarusuario.php';</script>";
    //header("Location:../agregarusuario.php");
}
endif;