<?php
session_start();
if (isset($_SESSION['nombre'])):
    include("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if(isset($_POST['eliminar'])):
        $idestatus = ($_POST['idestatus']);
        $query_eliminar = mysqli_query($conexion,"DELETE FROM estatus WHERE id = '".$idestatus."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
        if($query_eliminar)
        {
            //header("Location:eliminareportes.php");
            echo "<script>location.href='../complementos/agregarestado.php';</script>";

            echo 'El estatus se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        }
        else
        {
            echo 'El estatus no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;