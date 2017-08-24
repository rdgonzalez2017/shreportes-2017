<?php
session_start();
if (isset($_SESSION['nombre'])):
require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
if(isset($_POST['modificar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
    $id_estatus = ($_POST['id_estatus']);
    $nombre_estatus = ($_POST['nombre_estatus']);   
    $vencimiento = ($_POST['vencimiento']);   
    $permitir_comentarios = ($_POST['permitir_comentarios']);           

    $update_estado = mysqli_query($conexion,"UPDATE estatus SET nombre = '".$nombre_estatus."',vencimiento = '".$vencimiento."', permitir_comentarios = '".$permitir_comentarios."' where id = '".$id_estatus."' "); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if($update_estado)
    {
        echo 'El estado se modifico corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
      echo "<script>location.href='../complementos/agregarestado.php';</script>";
    }
        else
        {
        echo 'El estado no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
endif;
endif;