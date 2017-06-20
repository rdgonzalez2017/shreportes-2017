<?php
session_start();
include("../conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
if(isset($_POST['modificar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
    $idusuario = ($_POST['idusuario']);
    $nombre = ($_POST['nombre']);
    $nombrecompleto = ($_POST['nombrecompleto']);
    $correo = ($_POST['correo']);
    $clave = md5($_POST['clave']);
    $query_modificar = mysqli_query($conexion,"UPDATE usuarios SET nombre = '".$nombre."',nombrecompleto = '".$nombrecompleto."', correo = '".$correo."', clave = '".$clave."' WHERE idusuario = '".$idusuario."'"); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if($query_modificar)
    {
        echo 'El usuario se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        echo "<script>location.href='../modificarusuario.php';</script>";
    }
        else
        {
        echo 'El usuario no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
endif;
