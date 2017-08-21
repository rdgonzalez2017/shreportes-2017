<?php
session_start();
if (isset($_SESSION['nombre'])):
    include("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
        $idusuario = ($_POST['idusuario']);
        $nombre = ($_POST['nombre']);
        $nombrecompleto = ($_POST['nombrecompleto']);
        $correo = ($_POST['correo']);
        $clave = md5($_POST['clave']);
    $update_usuario = mysqli_query($conexion,"UPDATE usuarios SET nombre = '".$nombre."',nombrecompleto = '".$nombrecompleto."', correo = '".$correo."', clave = '".$clave."' WHERE id = '".$idusuario."'") // Ejecutamos la consulta para actualizar el registro en la base de datos
                or die ("Problemas de conexion" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($update_usuario) {
            echo 'El usuario se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
           echo "<script>location.href='../complementos/modificarusuario.php';</script>";
        } else {
            echo 'El usuario no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
   
endif;
