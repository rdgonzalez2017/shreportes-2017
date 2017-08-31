<?php

session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    $id_categoria = ($_POST['id_categoria']);
    $nombre_categoria = ($_POST['nombre_categoria']);
    $update_categoria = mysqli_query($conexion, "UPDATE categorias SET nombre = '" . $nombre_categoria . "' where id = '" . $id_categoria . "' "); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if ($update_categoria) {
        echo 'La categoría se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        //echo "<script>location.href='../complementos/agregarcategoria.php';</script>";
    } else {
        echo 'La categoría no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }

    if (!empty($_POST['campos_personalizados'])):
        $delete_detalle = mysqli_query($conexion, "DELETE FROM detalle_categorias WHERE id_categoria = '$id_categoria'"); // Ejecutamos la consulta para eliminar el registro de la base de datos        
        foreach ($_POST['campos_personalizados'] as $key => $id_campo_seleccionado):
            //Insertar id_categoria en campo detalle_categoria:
            $insert_detalle = mysqli_query($conexion, "insert into detalle_categorias(id_categoria,id_campo) VALUES 
                        ('$id_categoria','$id_campo_seleccionado') ")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
        endforeach;
    else:
        $delete_detalle = mysqli_query($conexion, "DELETE FROM detalle_categorias WHERE id_categoria = '$id_categoria'"); // Ejecutamos la consulta para eliminar el registro de la base de datos   
    endif;

    echo "<script>location.href='../complementos/agregarcategoria.php';</script>";
endif;