<?php
session_start();
if (isset($_SESSION['nombre'])):
    if(!empty($_POST['titulo'])){ // Comprobamos que los valores recibidos no son NULL
        include ("../conexion.php");
        //Se valida que el dominio no exista en la base de datos
        $nombredominio = $_POST['dominio'];
        $nuevo_dominio=mysqli_query($conexion,"select iddominio from dominio where nombre='$nombredominio'");
        if(mysqli_num_rows($nuevo_dominio)==0):
            //echo "No existe en la base de datos";
            //Si el dominio no existe, se inserta en la base de datos:
            $insert_dominio = mysqli_query($conexion,"insert into dominio(nombre) VALUES ('$_POST[dominio]')")or die("Problemas en el insert del dominio" . mysqli_error($conexion));
            //Si el dominio se insertó en la base de datos, se seleccionará para insertar en el reporte:
                if($insert_dominio):
                        //Select del dominio ingresado, para incluirlo en el insert principal
                        $query_dominio = mysqli_query($conexion,"select * from dominio ORDER BY iddominio DESC limit 1")or die("Problemas en el Select del dominio" . mysqli_error($conexion));;
                        while($columna = mysqli_fetch_assoc($query_dominio)):
                            $dominio =  $columna['iddominio'];
                            //Insert principal
                            $insert_reportes = mysqli_query($conexion, "insert into reporte(idusuario,idcategoria,iddominio,idservidor,titulo,autor,ticket,observacion,fecha)
                                 values ('$_POST[idusuario]','$_POST[categoria]','$dominio','$_POST[servidor]','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                            or die("Problemas en el insert principal" . mysqli_error($conexion));
                        endwhile;
                    //echo "Se insertó el nuevo dominio en la base de datos";
                //Si el dominio ya existía en la base de datos, se insertará en el reporte directamente:
                endif;
        else:
            //echo "Existe en la base de datos";
            while ($columna = mysqli_fetch_assoc($nuevo_dominio)):
                        $dominio =  $columna['iddominio'];
                        //Insert principal
                $insert_reportes = mysqli_query($conexion, "insert into reporte(idusuario,idcategoria,iddominio,idservidor,titulo,autor,ticket,observacion,fecha)
                                 values ('$_POST[idusuario]','$_POST[categoria]','$dominio','$_REQUEST[servidor]','$_REQUEST[titulo]','$_REQUEST[autor]','$_REQUEST[ticket]','$_REQUEST[observacion]', CURDATE())")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
                    endwhile;
        endif;
        mysqli_close($conexion);
        echo "<script>location.href='../muestra.php';</script>";
        //header("Location:../muestra.php");

    }
endif;

