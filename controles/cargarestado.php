<?php
session_start();
if (isset($_SESSION['nombre'])):
if(!empty($_POST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $query_reportes = mysqli_query($conexion, "insert into estatus(nombre) VALUES 
                     ('$_POST[nombre]') ")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    echo "<script>location.href='../agregarestado.php';</script>";
    //header("Location:../agregarestado.php");
}
endif;