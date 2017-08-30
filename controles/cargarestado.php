<?php
session_start();
if (isset($_SESSION['nombre'])):
    if (!empty($_POST['nombre'])): // Comprobamos que los valores recibidos no son NULL
        $nombre = $_POST['nombre'];
        $vencimiento = $_POST['vencimiento'];
        $permitir_comentarios = $_POST['permitir_comentarios'];
        include ("../config/conexion.php");
        $query_reportes = mysqli_query($conexion, "insert into estatus(nombre,vencimiento,permitir_comentarios) VALUES 
                     ('$nombre','$vencimiento','$permitir_comentarios') ")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
        mysqli_close($conexion);
        echo "<script>location.href='../complementos/agregarestado.php';</script>";
    endif;
endif;