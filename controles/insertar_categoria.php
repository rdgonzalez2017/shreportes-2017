<?php
session_start();
if (isset($_SESSION['nombre'])):
    require ("../config/conexion.php");
    $nombre = $_POST['nombre'];
    $insert_categoria = mysqli_query($conexion, "insert into categorias(nombre) VALUES 
                    ('$nombre') ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
//Seleccionar el id de la categoria insertada:
    $select_categoria = mysqli_query($conexion, "select id from categorias order by id desc limit 1")
            or die("Problemas de conexion" . mysqli_error($conexion));
    while ($fila = mysqli_fetch_assoc($select_categoria)) {
        $id_categoria = $fila['id'];
        echo "Id categoria:" . $id_categoria . "<br>";
    }    

    if (!empty($_POST['campo_personalizado'])):
        foreach ($_POST['campo_personalizado'] as $key => $id_campo_seleccionado):
            echo "Id campos seleccionados:" . $id_campo_seleccionado . "<br>";
            //Insertar id_categoria en campo detalle_categoria:
            $insert_detalle = mysqli_query($conexion, "insert into detalle_categorias(id_categoria,id_campo) VALUES 
                        ('$id_categoria','$id_campo_seleccionado') ")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
           
        endforeach;
    endif;
        
        
    
    echo "<script>location.href='../complementos/agregarcategoria.php';</script>";
    endif;

