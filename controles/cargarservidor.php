<?php
session_start();
if (isset($_SESSION['nombre'])):
if(!empty($_POST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
    include ("../config/conexion.php");
    $query_reportes = mysqli_query($conexion, "insert into servidores(nombre) VALUES 
                     ('$_POST[nombre]') ")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    //header("Location:../agregarcategoria.php");
    echo "<script>location.href='../complementos/agregarservidor.php';</script>";
}
endif;