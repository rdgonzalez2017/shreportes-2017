<?php
session_start();
if (isset($_SESSION['nombre'])):
    include("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if(isset($_POST['eliminar'])):
    $idreporte = ($_POST['idreporte']);
        $query_eliminar = mysqli_query($conexion,"DELETE FROM reportes WHERE id = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
        if($query_eliminar)
            {
                $comentarios_eliminar = mysqli_query($conexion,"DELETE FROM comentarios WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
                echo 'El reporte de incidencia se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
                echo "<script>location.href='../reportes.php';</script>";
            }
            else
            {
            echo 'La incidencia no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
            }
    endif;
endif;