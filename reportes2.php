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

        
            <!-- Seccion que muestra la publicacion final del reporte-->
            <?php
            include("config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
            include("config/conexion2.php"); // Incluimos nuestro archivo de conexión con la base de datos

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
                    <div class="row col-md-12">
                    <div class="panel panel-primary container col-md-6 col-md-offset-3 rollIn animated" data-wow-duration="3000ms">

                        <div style="background: #2A63A2; border-bottom: 5px solid #ED782C;"  class="panel-heading row" >
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
                            <?php if (empty($_SESSION['nombre'])): ?>
                                <div class="row">
                                    <label for="autor" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                    <div class="col-md-7 col-md-pull-1"><?php echo $estatus; ?></div>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <form method="Post" action="controles/cambiar_estado.php">
                                        <input value="<?php echo $id_reporte; ?>" name="id_reporte" type="hidden">
                                        <input TYPE="hidden" NAME="id_protegido" VALUE="<?php echo $id_protegido; ?>">
                                        <label  for="estado" class="col-md-2 col-md-offset-2 control-label">Estado:</label>
                                        <div class="col-md-5 "><?php //echo $estatus;     ?>

                                            <?php
                                            include('config/conexion.php');
                                            //Establece el valor que ya está seleccionado
                                            $valor_previo = mysqli_query($conexion, "select * from estatus as B RIGHT JOIN reportes as A on A.idestatus = B.id where A.id = '" . $id_reporte . "'")
                                                    or die("Problemas en el select:" . mysqli_error($conexion));
                                            while ($columna_estatus = mysqli_fetch_array($valor_previo)) :
                                                $valorDefinido = $columna_estatus['nombre'];

                                                //Selecciona todos los valores de la base de datos
                                                $registros = mysqli_query($conexion, "select * from estatus")
                                                        or die("Problemas en el select:" . mysqli_error($conexion));
                                                $combo = '<select class="form-control" name="id_estatus" >\n';
                                                //Función que muestra el valor que se ha seleccionado previamente.
                                                while ($reg = mysqli_fetch_array($registros)) {
                                                    $selected = '';
                                                    if ($valorDefinido == $reg['nombre']) {
                                                        $selected = 'selected';
                                                    }
                                                    $combo .= '<option value="' . $reg['id'] . '"" ' . $selected . '>' . $reg['nombre'] . '</option>\n';
                                                }
                                                $combo .= "</select>";
                                                echo $combo;
                                            endwhile;
                                            ?>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="btn btn-warning" type="submit" name="modificar" value="Cambiar" />
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php if (isset($_SESSION['nombre'])): ?>
                    <div class="row">
                        <form method="Post" action="controles/enviar_correo.php">
                            <input TYPE="hidden" NAME="link" VALUE="<?php echo $Link; ?>">
                            <input TYPE="hidden" NAME="id_reporte" VALUE="<?php echo $id_reporte; ?>">
                            <input TYPE="hidden" NAME="id_protegido" VALUE="<?php echo $id_protegido; ?>">
                            <input TYPE="hidden" NAME="id_cliente" VALUE="<?php echo $id_cliente; ?>">
                            <input TYPE="hidden" NAME="correo_autor" VALUE="<?php echo $correo_autor; ?>">
                            <input TYPE="hidden" NAME="dominio" VALUE="<?php echo $nombre_dominio; ?>">
                            <button  type="submit" class="btn btn-info col-md-2 col-md-offset-5"><b>Enviar correo</b></button>
                        </form>                            
                    </div>                        
                <?php endif; ?> 
                    <div class="row">
                        <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                        <div class="col-md-10 col-md-offset-1 well bounceIn animated animated" data-wow-duration="3000ms" style="overflow-y: auto;"><?php echo $observacion; ?></div>
                    </div>
                    
                </div>


                


                <!-- Formulario para envío de comentarios-->
                <?php
                if ($idestatus == 3 or $idestatus == 4):
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

    </div>


</body>
<?php include("footer.php"); ?>
</html>