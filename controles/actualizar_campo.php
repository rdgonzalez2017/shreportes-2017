<?php
session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['grabar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
        $id = ($_POST['id_campo']);
        $nombre = ($_POST['nombre']);        
        $id_tipo = ($_POST['id_tipo']);
        if (!empty('descripcion')){ $descripcion = $_POST['descripcion'];}else{$descripcion='';}
        if (!empty('validacion')){ $validacion = $_POST['validacion'];}else{$validacion='';}
        if (!empty('opciones_desplegable')){ $opciones_desplegable = $_POST['opciones_desplegable'];}else{$opciones_desplegable='';}
        if (!empty('visualizacion')){ $visualizacion = $_POST['visualizacion'];}else{$visualizacion='';}     
        $campo_obligatorio = ($_POST['campo_obligatorio']);
        $update = mysqli_query($conexion, "UPDATE campos_personalizables SET nombre = '" . $nombre . "', id_tipo = $id_tipo, descripcion = '".$descripcion."', validacion = '".$validacion."', opciones_desplegable = '".$opciones_desplegable."', visualizacion = '$visualizacion', campo_obligatorio = '$campo_obligatorio' where id = '$id.'")
                or die ("Problemas de conexión".mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($update) {
            echo 'El campos se modifico corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
            echo "<script>location.href='../complementos/agregar_campo.php';</script>";
        } else {
            echo 'El estado no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;