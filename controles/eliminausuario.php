<?php
session_start();
if (isset($_SESSION['nombre'])):
    include("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if(isset($_POST['eliminar'])):
        $idusuario = ($_POST['idusuario']);
        $query_eliminar = mysqli_query($conexion,"DELETE FROM usuarios WHERE id = '".$idusuario."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
        if($query_eliminar)
        {
            //header("Location:eliminareportes.php");
            echo "<script>location.href='../complementos/agregarusuario.php';</script>";

            echo 'El usuario se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        }
        else
        {
            echo 'El usuario no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;