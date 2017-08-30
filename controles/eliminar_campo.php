<?php
session_start();
if (isset($_SESSION['nombre'])):
    include("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['eliminar'])):
        $id = ($_POST['id_campo']);
        $delete= mysqli_query($conexion, "DELETE FROM campos_personalizables WHERE id = '" . $id . "'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
        if ($delete) {
            //header("Location:eliminareportes.php");
            echo "<script>location.href='../complementos/agregar_campo.php';</script>";
            echo 'El valor se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        } else {
            echo 'El valor no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;