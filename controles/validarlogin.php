<?php
session_start();
include ("../conexion.php");
$registros=mysqli_query($conexion,"select nombre,correo, clave from usuarios
          where correo='$_REQUEST[correo]' and clave='$_REQUEST[clave]' ") or
            die("Problemas en el select:".mysqli_error($conexion));
if ($reg=mysqli_fetch_array($registros))
{
    $_SESSION['nombre']=$reg['nombre'];
    $_SESSION['usuario']=$reg['correo'];
    $_SESSION['clave']=$reg['clave'];
    if (isset($_SESSION['usuario']))
    {
        //header('location:../sistema.php');
        echo "<script>location.href='../sistema.php';</script>";
    } else {
        echo "No tiene permitido visitar esta página.";
    }
}
?>
