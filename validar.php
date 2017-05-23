<?php
session_start();
$conexion=mysqli_connect("localhost","root","","shreportes") or
die("Problemas con la conexión");

$registros=mysqli_query($conexion,"select nombre,correo, clave from usuarios
          where correo='$_REQUEST[correo]' and clave='$_REQUEST[clave]' ") or
            die("Problemas en el select:".mysqli_error($conexion));

if ($reg=mysqli_fetch_array($registros))
{
    $_SESSION['nombre']=$reg['nombre'];
    $_SESSION['usuario']=$reg['correo'];
    $_SESSION['clave']=$reg['clave'];
    if (isset($_SESSION['usuario'] ))
    {
        $url='location:sistema.php';

    } else {
        echo "No tiene permitido visitar esta página.";
    }
    header($url);
}

?>
