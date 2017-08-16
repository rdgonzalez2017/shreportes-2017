<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include ("head.php"); ?>
    <header>
        <?php
        if (isset($_SESSION['nombre'])):
            include ("navbar/navbarsistema.php");
        else:
            include ("navbar/navbarindex.php");
        endif;
        ?>
    </header>
    <body>
        <div class="row col-md-12">
            <!-- Muestra Previa del Reporte -->
            <section>
                <!-- Seccion que muestra la publicacion final del reporte-->
                <?php
                require("config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
                require("config/conexion2.php"); // Incluimos nuestro archivo de conexión con la base de datos

                if (isset($_GET['reporte']))://Si seleccionó un reporte para mostrar:
                    $id_protegido = $_GET["reporte"];
                    $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                    $select = "SELECT *, A.id as id_reporte, A.id_cliente as idcliente, F.correo as correo_autor, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id  WHERE MD5(concat('" . $clave . "',A.id)) = '" . $id_protegido . "' LIMIT 1";
                    $query_reportes = mysqli_query($conexion, "$select") // Ejecutamos la consulta
                            or die("Problemas en el select:" . mysqli_error($conexion));
                    //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta

                    while ($columna = mysqli_fetch_assoc($query_reportes)): // Realizamos un bucle que muestre todas las noticias, utilizando while.
                        if (!empty($columna['nombredominio'])) {
                            $nombre_dominio = $columna['nombredominio'];
                        } elseif (!empty($columna['nombre_nuevo_dominio'])) {
                            $nombre_dominio = $columna['nombre_nuevo_dominio'];
                        }
                        $id_usuario = $columna['idusuario'];
                        $id_cliente = $columna['idcliente'];
                        $categoria = $columna['nombrecategoria'];
                        $titulo = $columna['titulo'];
                        $autor = $columna['autor'];
                        $fecha = $columna['fecha'];
                        $observacion = $columna['observacion'];
                        $id_reporte = $columna['id_reporte'];
                        $correo_autor = $columna['correo_autor'];
                        $idestatus = $columna['idestatus'];
                        $estatus = $columna['nombrestatus'];
                        $ticket = $columna['ticket'];
                        //Con esto se obtiene el Link de la página:
                        $host = $_SERVER["HTTP_HOST"];
                        $url = $_SERVER["REQUEST_URI"];
                        ob_start();
                        echo $host, $url;
                        $Link = ob_get_contents();
                        ob_end_clean();
                        ?>
                        <!--Panel que muestra el Reporte Final:-->

                        <div class="panel panel-primary container col-md-6 col-md-offset-3 rollIn animated" data-wow-duration="3000ms">

                            <div id="panel-reporte" class="panel-heading row" >
                                <div class="text-center"><h4><b>Incidencia</b></h4></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <label for="titulo" class="col-md-3 col-md-offset-2 control-label">Titulo:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $titulo; ?> </div>            
                                </div>
                                <div class="row">
                                    <label for="categoria" class="col-md-3 col-md-offset-2 control-label">Categoría:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $categoria; ?></div>
                                </div>
                                <div class="row">
                                    <label for="dominio" class="col-md-3 col-md-offset-2 control-label">Dominio:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $nombre_dominio; ?></div>
                                </div>
                                <div class="row">
                                    <label for="ticket" class="col-md-3 col-md-offset-2 control-label">Ticket:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $ticket; ?></div>
                                </div>
                                <div class="row">
                                    <label for="fecha" class="col-md-3 col-md-offset-2 control-label">Fecha:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $fecha; ?></div>
                                </div>
                                <div class="row">
                                    <label for="autor" class="col-md-3 col-md-offset-2 control-label">Autor:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $autor; ?></div>
                                </div>
                                <div class="row">
                                    <label for="estado" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $estatus; ?></div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['nombre'])):?>
                        <div class="row">
                            <form method="Post" action="controles/enviar_correo.php">
                            <input TYPE="hidden" NAME="link" VALUE="<?php echo $Link;?>">
                            <input TYPE="hidden" NAME="id_reporte" VALUE="<?php echo $id_reporte; ?>">
                            <input TYPE="hidden" NAME="id_protegido" VALUE="<?php echo $id_protegido; ?>">
                            <input TYPE="hidden" NAME="id_cliente" VALUE="<?php echo $id_cliente; ?>">
                            <input TYPE="hidden" NAME="correo_autor" VALUE="<?php echo $correo_autor; ?>">
                            <input TYPE="hidden" NAME="dominio" VALUE="<?php echo $nombre_dominio;?>">
                            <button  type="submit" class="btn btn-info col-md-2 col-md-offset-5"><b>Enviar correo</b></button>
                            </form>                            
                        </div>
                        <div class="row">
                            <form method="Post" action="controles/enviar_recordatorio.php">
                            <input TYPE="hidden" NAME="link" VALUE="<?php echo $Link;?>">
                            <input TYPE="hidden" NAME="id_reporte" VALUE="<?php echo $id_reporte; ?>">
                            <input TYPE="hidden" NAME="id_protegido" VALUE="<?php echo $id_protegido; ?>">
                            <input TYPE="hidden" NAME="id_cliente" VALUE="<?php echo $id_cliente; ?>">
                            <input TYPE="hidden" NAME="correo_autor" VALUE="<?php echo $correo_autor; ?>">
                            <input TYPE="hidden" NAME="dominio" VALUE="<?php echo $nombre_dominio;?>">
                            <button  type="submit" class="btn btn-warning col-md-2 col-md-offset-5"><b>Enviar recordatorio</b></button>
                            </form>                            
                        </div>
                        <?php endif;?>
                        <div class="row">
                            <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                            <div class="col-md-10 col-md-offset-1 well bounceIn animated animated" data-wow-duration="3000ms" style="overflow-y: auto;"><?php echo $observacion; ?></div>
                        </div><br>
                        
                        <!-- Formulario para envío de comentarios-->
                        <?php
                        if ($idestatus == 3):
                            include ("formulariocomentarios.php");
                        endif;
                        // Sección que muestra los comentarios-->

                        include "muestracomentario.php";

                    endwhile; //Fin de While que muestra el reporte de incidencia

                else://Muestra la tabla de reportes, hasta que elija un reporte para mostrar:
                    if (isset($_SESSION['nombre'])):
                        include "tablas/tablareportes.php";

                    else: echo"Debe iniciar sesión para ingresar a esta página";
                    endif;
                endif; //Fin del condicional controla si se muestra la tabla de reportes o el reporte.
                ?>

            </section>
        </div>


    </body>
<?php include("footer.php"); ?>
</html>