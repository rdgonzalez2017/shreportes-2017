<?php

session_start();
if (isset($_SESSION['nombre'])):
    $id_cliente = $_POST['id_cliente'];
    require ("../conexion.php");
    
    //Si el dominio fue seleccionado de la lista "Registrados":
    if (!empty($_POST['id_dominio_registrado'])) {
        echo "Lista de registrados";
        $id_dominio = $_POST['id_dominio'];
        require ("../config/conexion2.php");
        //Insert principal
        $insert_reportes = mysqli_query($conexion, "insert into reporte(idusuario,id_cliente,idcategoria,idestatus,id_dominio_registrado,idservidor,titulo,autor,ticket,observacion,fecha)
                               values ('$_POST[idusuario]','$id_cliente','$_POST[categoria]','$_POST[estado]','$id_dominio','$_POST[servidor]','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
    }
    //Si el dominio fue seleccionado de la lista "No Registrados":
    if (!empty($_POST['id_dominio_noregistrado'])) {
        echo "Lista de no registrados";
        $id_dominio = $_POST['id_dominio_noregistrado'];
        require ("conexion.php");
        //Insert principal
        $insert_reportes = mysqli_query($conexion, "insert into reporte(idusuario,id_cliente,idcategoria,idestatus,iddominio,idservidor,titulo,autor,ticket,observacion,fecha)
                               values ('$_POST[idusuario]','$id_cliente','$_POST[categoria]','$_POST[estado]','$id_dominio','$_POST[servidor]','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
    }
    //Si el dominio fue ingresado como nuevo:
    if (!empty($_POST['nuevo_dominio'])) {
        echo "Ingreso de dominio";
        $nuevo_dominio = $_POST['nuevo_dominio'];
        $busca_dominio = mysqli_query($conexion, "SELECT * FROM dominio where nombre ='$nuevo_dominio'");
        //Se valida que el dominio no exista en la tabla dominios de la BD shincidencias:
        if (mysqli_num_rows($busca_dominio) == 0) {
            //echo "No existe en la base de datos, se inserta en la tabla dominios";
            $insert_dominio = mysqli_query($conexion, "insert into dominio(nombre,id_ciente) VALUES ('$nuevo_dominio','$id_cliente')")or die("Problemas en el insert del dominio" . mysqli_error($conexion));
            // Se selecciona el id del dominio que se acaba de ingresar, para insertarlo en el reporte:
            $id_dominio = mysqli_query($conexion, "select * from dominio ORDER BY id DESC limit 1")or die("Problemas en el Select del dominio" . mysqli_error($conexion));
            //Insert en el reporte:
            $insert_reporte = mysqli_query($conexion, "insert into reporte(idusuario,id_cliente,idcategoria,idestatus,iddominio,idservidor,titulo,autor,ticket,observacion,fecha)
                                 values ('$_POST[idusuario]','$id_cliente','$_POST[categoria]','$_POST[estado]','$id_dominio','$_POST[servidor]','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
        }
    }
    mysqli_close($conexion);
        //echo "<script>location.href='../muestra.php';</script>";
        //header("Location:../muestra.php");
endif;

