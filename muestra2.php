<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include ("head.php")?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarmuestra.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>
<body>
<div class="col-md-8 col-md-offset-2">
    <?php
    //Mostrar botón de modificar Reporte, al estar el el reporte de Muestra y esconder al estar en el reporte publicado.
    $url= $_SERVER["REQUEST_URI"];
    ob_start();
    echo strlen($url);
    $VariableURL = ob_get_contents();
    ob_end_clean();
    if (isset($_SESSION['nombre'])and $VariableURL<50){
       include ("modificarmuestra.php");
    }
    ?>
</div>

<div class="col-md-12">
    <!-- Muestra Previa del Reporte -->
    <section>
        <!-- Seccion que muestra la publicacion final del reporte-->
        <?php
        include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos



                $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                $select = "SELECT *, estatus.nombre as nombrestatus, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus order BY idreporte desc LIMIT 1";
                $query_reportes = mysqli_query($conexion,"$select")
                or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta
                //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
                if(mysqli_num_rows($query_reportes) > 0) // Si existe la noticia, la muestra
                {
                    while($columna = mysqli_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
                    {
                        $categoria =  $columna['nombrecategoria'];
                        $autor =  $columna['autor'];
                        $fecha =  $columna['fecha'];
                        $titulo =  $columna['titulo'];
                        $observacion =  $columna['observacion'];
                        $idprotegido=md5($clave.$columna['idreporte']);
                        $idreporte =  $columna['idreporte'];
                        $idestatus =  $columna['idestatus'];
                        $estatus =  $columna['nombrestatus'];
                        //Panel que muestra el Reporte Final:
                        echo'
                        
                             <div class="panel panel-primary container col-md-6 col-md-offset-3 fadeInLeftBig animated">
                                
                                    <div class="panel-heading row" style="background: orange">
                                        <h4 class="text-center">Reporte de Incidencia</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="titulo" class="col-md-3 col-md-offset-2 control-label">Titulo:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $titulo; echo' </div>            
                                        </div>
                                        <div class="row">
                                            <label for="categoria" class="col-md-3 col-md-offset-2 control-label">Categoría:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $categoria; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha" class="col-md-3 col-md-offset-2 control-label">Fecha:</label>
                                                <div class="col-md-7 col-md-pull-1">'; echo $fecha; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="autor" class="col-md-3 col-md-offset-2 control-label">Autor:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $autor; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="estado" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $estatus; echo' </div>
                                        </div>
                                    </div>
                           
                           </div>
                           
                                        <div class="row">
                                            <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                                            <div class="col-md-10 col-md-offset-1 well fadeInRight animated" style="overflow-y: auto;">'; echo $observacion; echo' </div>

                                        </div>
                       
                          
                                            ';
                        if ($idestatus <> 1) {
                            echo '
                            <BR> 
                            <!-- Formulario para envío de comentarios-->
                                <form class="form fadeInRightBig animated" name="miFormu" method="post" action="controles/cargarcomentario.php">
                                    <INPUT type="hidden" NAME="id" VALUE="' . $idreporte . '">
                                    <INPUT type="hidden" NAME="idprotegido" VALUE="' . $idprotegido . '">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <p class="text-center">Formulario de Comentarios</p>
                                            </div>
                                            <!-- Ingreso del titulo-->
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <label for="nick" class="col-md-2 control-label">Autor:</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="nick" id="nick"  required/>
                                                    </div>
                                                </div>
                                                <!-- Ingreso del Autor-->
                                              <!-- Ingreso del comentario-->
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                                                    <div class="col-md-12">
                                                        <textarea name="comentario" type="text" required class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Boton para enviar datos-->
                                            <div class="panel-footer text-center">
                                                <input type="submit" class="btn btn-info btn-sm" value="Enviar comentario">                      
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                        ';
                        }else echo '';
                    }

            }

//Comentarios:

        ?>
    </section>
</div>

<section>
    <br><br>
    <!-- Seccion de comentarios-->
    <?php
    if(!empty($idreporte)):
        $resultComen = mysqli_query($conexion,"SELECT *  FROM comentarios WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' ORDER BY id DESC")
        or die("Problemas en el select:".mysqli_error($conexion));
        while($rowComen = mysqli_fetch_assoc($resultComen))
        {
            ?>
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <!-- Muestra Autor del comentario-->
                    <div class="panel-heading text-center">
                        <div> Autor: <?php echo $rowComen["nick"]; ?> </div>
                    </div>
                    <div class="panel-body">

                        <!-- Muestra fecha del comentario-->
                        <div class="form-group row">
                            <label for="fecha" class="col-md-2 control-label">Fecha:</label>
                            <div class="col-md-8">
                                <div> <?php echo $rowComen["fecha"]; ?> </div>
                            </div>
                        </div>
                        <!-- Muestra descripción del comentario-->
                        <div class="form-group row">
                            <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                            <div class="col-md-12">
                                <textarea class="form-control" style="resize: none" readonly="readonly" name="observacion" rows="5"> <?php echo $rowComen["comentario"]; ?>  </textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }

    endif;
    ?>
</section>
</body>
<?php include("footer.php");?>
</html>