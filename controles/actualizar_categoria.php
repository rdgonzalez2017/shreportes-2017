<?php
session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['modificar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
        $id_categoria = ($_POST['id_categoria']);
        $nombre_categoria = ($_POST['nombre_categoria']);
        $update_categoria = mysqli_query($conexion, "UPDATE categorias SET nombre = '" . $nombre_categoria . "' where id = '" . $id_categoria . "' "); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($update_categoria) {
            echo 'La categoría se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
            echo "<script>location.href='../complementos/agregarcategoria.php';</script>";
        } else {
            echo 'La categoría no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;