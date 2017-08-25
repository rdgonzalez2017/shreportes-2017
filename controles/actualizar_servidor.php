<?php
session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['modificar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
        $id = ($_POST['id_servidor']);
        $nombre = ($_POST['nombre_servidor']);
        $update = mysqli_query($conexion, "UPDATE servidores SET nombre = '" . $nombre . "' where id = '" . $id . "' "); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($update) {
            echo 'El servidor se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
            echo "<script>location.href='../complementos/agregarservidor.php';</script>";
        } else {
            echo 'El servidor no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;