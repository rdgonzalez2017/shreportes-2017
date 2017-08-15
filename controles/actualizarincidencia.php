<?php

session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
    if (isset($_POST['modificar'])): // Si el boton de "modificar" fúe presionado ejecuta el resto del código
        $idreporte = ($_POST['idreporte']);
        //Verificar si el Dominio obtenido se encuentra en la base de datos, antes de modificarlo en el reporte.
        /*$nombredominio = $_POST['dominios'];
        $nuevo_dominio = mysqli_query($conexion, "select id from dominios where nombre='$nombredominio'");
        if (mysqli_num_rows($nuevo_dominio) == 0):
            //Si el dominio no existe, se inserta en la base de datos:
            $insert_dominio = mysqli_query($conexion, "insert into dominios(nombre) VALUES ('$_POST[dominio]')")or die("Problemas en el insert del dominio" . mysqli_error($conexion));
            //Si el dominio se insertó en la base de datos, se seleccionará para insertar en el reporte:
            if ($insert_dominio):
                //Select del dominio ingresado, para incluirlo en el insert principal
                $query_dominio = mysqli_query($conexion, "select * from dominios ORDER BY id DESC limit 1")or die("Problemas en el Select del dominio" . mysqli_error($conexion));
                while ($columna = mysqli_fetch_assoc($query_dominio)):
                    $iddominio = $columna['iddominio'];
                    //Modificar Dominio en el reporte:
                    $query_modificar = mysqli_query($conexion, "UPDATE reportes SET iddominio = '" . $iddominio . "' WHERE id = '" . $idreporte . "'")
                            or die("Problemas en el Update al modificar el dominio en el reporte" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
                endwhile;
            //Si el dominio ya existía en la base de datos, se insertará en el reporte directamente:
            endif;
        else:
            //echo "Existe en la base de datos";
            while ($columna = mysqli_fetch_assoc($nuevo_dominio)):
                $iddominio = $columna['iddominio'];
                //Modificar Dominio en el reporte:
                $query_modificar = mysqli_query($conexion, "UPDATE reportes SET iddominio = '" . $iddominio . "' WHERE id = '" . $idreporte . "'")
                        or die("Problemas en el Update al modificar el dominio en el reporte" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
            endwhile;
        endif;*/
        $idreporte = ($_POST['idreporte']);
        $titulo = ($_POST['titulo']);
        $observacion = ($_POST['observacion']);
        $idestatus = ($_POST['estatus']);
        $idservidor = ($_POST['servidor']);
        $idcategoria = ($_POST['categoria']);
        $autor = ($_POST['autor']);
        $ticket = ($_POST['ticket']);
        $query_modificar = mysqli_query($conexion, "UPDATE reportes SET titulo = '" . $titulo . "', observacion = '" . $observacion . "', idestatus = '" . $idestatus . "', idcategoria = '" . $idcategoria . "', idservidor = '" . $idservidor . "', ticket = '" . $ticket . "' WHERE id = '" . $idreporte . "'")
                or die("Problemas en el Update al modificar el reporte" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
        if ($query_modificar) {
            echo 'La incidencia se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
            echo "<script>location.href='../reportes.php';</script>";
        } else {
            echo 'La incidencia no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
        }
    endif;
endif;
