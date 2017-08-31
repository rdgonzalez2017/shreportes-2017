<?php

session_start();
if (isset($_SESSION['nombre'])):
    $nombre = $_POST['nombre'];
    $id_tipo = $_POST['tipo'];
    if (!empty($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
    } else {
        $descripcion = '';
    }
    if (!empty($_POST['validacion'])) {
        $validacion = $_POST['validacion'];
    } else {
        $validacion = '';
    }
    $visualizacion = $_POST['visualizacion'];
    $campo_obligatorio = $_POST['campo_obligatorio'];
//Insertar campo personalizable:
    include ("../config/conexion.php");
    $insert = mysqli_query($conexion, "insert into campos_personalizables(nombre,id_tipo,descripcion,validacion,visualizacion,campo_obligatorio) 
            VALUES ('$nombre','$id_tipo','$descripcion','$validacion','$visualizacion','$campo_obligatorio') ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
    if (!empty($_POST['opciones_desplegables'])) {
        //Seleccionar el campo insertado:  
        $select_campo = mysqli_query($conexion, "SELECT id FROM campos_personalizables ORDER BY id DESC LIMIT 1");
        $fila = mysqli_fetch_array($select_campo);
        $id_campo = $fila['id'];
        $opciones_desplegables = $_POST['opciones_desplegables'];
        //Convertir datos separados por comas a Array:  
        $array_opciones = explode(",", $opciones_desplegables);
        foreach ($array_opciones as $key => $opcion) :
            //Insertar opciones a la BD:
            $insert = mysqli_query($conexion, "insert into opciones_desplegables(id_campo_personalizable,nombre) 
                VALUES ('$id_campo','$opcion') ")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
        endforeach;
    }

    echo "<script>location.href='../complementos/agregar_campo.php';</script>";
    
        endif;
