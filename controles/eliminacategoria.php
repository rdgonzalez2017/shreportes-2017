<?php
include("../conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
if(isset($_POST['eliminar'])):
    $idcategoria = ($_REQUEST['idcategoria']);
    $query_eliminar = mysqli_query($conexion,"DELETE FROM categorias WHERE idcategoria = '".$idcategoria."'"); // Ejecutamos la consulta para eliminar el registro de la base de datos
    if($query_eliminar)
    {
        //header("Location:eliminareportes.php");
        echo "<script>location.href='../agregarcategoria.php';</script>";

        echo 'La categoría se eliminó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
    }
    else
    {
        echo 'La categoría no se eliminó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
endif;
?>