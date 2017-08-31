<?php

session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['grabar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
        $id = ($_POST['id_campo']);
        $nombre = ($_POST['nombre']);
        $id_tipo = ($_POST['id_tipo']);
        if (!empty('descripcion')) {
            $descripcion = $_POST['descripcion'];
        } else {
            $descripcion = '';
        }
        if (!empty('validacion')) {
            $validacion = $_POST['validacion'];
        } else {
            $validacion = '';
        }
/*
        if (!empty($_POST['opciones_desplegables'])) {
            $opciones_desplegables = $_POST['opciones_desplegables'];
            //Convertir datos separados por comas a Array:  
            $array_opciones = explode(",", $opciones_desplegables);
            foreach ($array_opciones as $key => $opcion) :
                $select_opciones = mysqli_query($conexion, "Select * from opciones_desplegables where id_campo_personalizable = '$id' ");
                while ($fila = mysqli_fetch_array($select_opciones)):
                    $id_opcion = $fila['id'];
                    //Insertar opciones a la BD:
                    $update_opciones = mysqli_query($conexion, "UPDATE opciones_desplegables set nombre = '$opcion' where id = '$id_opcion'  ")
                            or die("Problemas en el insert principal" . mysqli_error($conexion));
                endwhile;
            endforeach;
        }*/
        if (!empty('visualizacion')) {
            $visualizacion = $_POST['visualizacion'];
        } else {
            $visualizacion = '';
        }
        $campo_obligatorio = ($_POST['campo_obligatorio']);
        $update = mysqli_query($conexion, "UPDATE campos_personalizables SET nombre = '" . $nombre . "', id_tipo = $id_tipo, descripcion = '" . $descripcion . "', validacion = '" . $validacion . "', visualizacion = '$visualizacion', campo_obligatorio = '$campo_obligatorio' where id = '$id.'")
                or die("Problemas de conexión" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($update) {
            //echo 'El campo se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
            echo "<script>location.href='../complementos/agregar_campo.php';</script>";
        } else {
            echo 'El estado no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;