<?php

session_start();
if (isset($_SESSION['nombre'])):
    $id_cliente = $_POST['id_cliente'];
    require ("../config/conexion.php");
    $id_usuario = $_POST['idusuario'];
    $id_categoria = $_POST['categoria'];
    $id_estatus = $_POST['estado'];
    $id_servidor = $_POST['servidor'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ticket = $_POST['ticket'];
    $observacion = $_POST['observacion'];
    
    
    
    
    //Si el dominio fue seleccionado de la lista "Registrados":
    if (!empty($_POST['id_dominio_registrado'])) { 
        $id_dominio = $_POST['id_dominio_registrado'];
        //Insert principal del reporte
        $insert_reportes = mysqli_query($conexion, "insert into reportes(idusuario,idcategoria,idestatus,id_dominio_registrado,idservidor,titulo,autor,ticket,observacion,fecha)
                               values ('$_POST[idusuario]','$_POST[categoria]','$_POST[estado]','$id_dominio','$_POST[servidor]','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                or die("Problemas en el insert principal" . mysqli_error($conexion));
    }
    //Si el dominio fue seleccionado de la lista "No Registrados":
    if (!empty($_POST['id_dominio_noregistrado'])) {        
        $id_dominio = $_POST['id_dominio_noregistrado'];
        //Insert principal del reporte
         $insert_reporte = mysqli_query($conexion, "insert into reportes(id, idusuario, id_cliente, idestatus, idcategoria, idservidor, iddominio, titulo, autor, ticket, observacion, fecha)
                                 values (NULL,'$_POST[idusuario]','$id_cliente','$_POST[estado]','$_POST[categoria]','$_POST[servidor]','$id_dominio','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
    }
    //Si el dominio fue ingresado como nuevo:
    if (!empty($_POST['nuevo_dominio'])) {        
        $nuevo_dominio = $_POST['nuevo_dominio'];
        $busca_dominio = mysqli_query($conexion, "SELECT * FROM dominios where nombre ='$nuevo_dominio'");
        //Se valida que el dominio no exista en la tabla dominios de la BD shincidencias:
        if (mysqli_num_rows($busca_dominio) == 0) {
            //Se inserta el nuevo dominio en la BD:
            $insert_dominio = mysqli_query($conexion, "insert into dominios(id, id_cliente, nombre) VALUES (NULL,'$id_cliente','$nuevo_dominio')")or die("Problemas en el insert del dominio" . mysqli_error($conexion));
            // Se selecciona el id del dominio que se acaba de ingresar, para insertarlo en el reporte:
            $select_dominio = mysqli_query($conexion, "select * from dominios ORDER BY id DESC limit 1")or die("Problemas en el Select del dominio" . mysqli_error($conexion));
            while($columna = mysqli_fetch_array($select_dominio)){
                $id_dominio = $columna['id'];
                //Insert principal del reporte            
            $insert_reporte = mysqli_query($conexion, "insert into reportes(id, idusuario, id_cliente, idestatus, idcategoria, idservidor, iddominio, titulo, autor, ticket, observacion, fecha)
                                 values (NULL,'$_POST[idusuario]','$id_cliente','$_POST[estado]','$_POST[categoria]','$_POST[servidor]','$id_dominio','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));
            }
            
        }else{
            while($columna = mysqli_fetch_array($busca_dominio)){
                $id_dominio = $columna['id'];
                 //Insert principal del reporte            
            $insert_reporte = mysqli_query($conexion, "insert into reportes(id, idusuario, id_cliente, idestatus, idcategoria, idservidor, iddominio, titulo, autor, ticket, observacion, fecha)
                                 values (NULL,'$_POST[idusuario]','$id_cliente','$_POST[estado]','$_POST[categoria]','$_POST[servidor]','$id_dominio','$_POST[titulo]','$_POST[autor]','$_POST[ticket]','$_POST[observacion]', CURDATE())")
                    or die("Problemas en el insert principal" . mysqli_error($conexion));                
            }
            
        }
    }
    mysqli_close($conexion);
       echo "<script>location.href='../muestra.php';</script>";
        //header("Location:../muestra.php");
endif;

