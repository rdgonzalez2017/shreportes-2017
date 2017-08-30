<?php
session_start();
if (isset($_SESSION['nombre'])):
    if (!empty($_POST['nombre'])): // Comprobamos que los valores recibidos no son NULL
        $nombre = $_POST['nombre'];
        $id_tipo = $_POST['tipo'];
        if(!empty('descripcion')){$descripcion = $_POST['descripcion'];}else{$descripcion= '';}
        if(!empty('validacion')){$validacion = $_POST['validacion'];}else{$validacion= '';}
        if(!empty('opciones_desplegable')){$opciones_desplegable = $_POST['opciones_desplegable'];}else{$opciones_desplegable= '';}
        $visualizacion = $_POST['visualizacion'];
        $campo_obligatorio = $_POST['campo_obligatorio'];
        include ("../config/conexion.php");
        $insert = mysqli_query($conexion, "insert into campos_personalizables(nombre,id_tipo,descripcion,validacion,opciones_desplegable,visualizacion,campo_obligatorio) 
            VALUES ('$nombre','$id_tipo','$descripcion','$validacion','$opciones_desplegable','$visualizacion','$campo_obligatorio') ")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
        mysqli_close($conexion);
        echo "<script>location.href='../complementos/agregar_campo.php';</script>";
    endif;
endif;