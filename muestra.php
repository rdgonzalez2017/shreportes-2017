<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include ("head.php") ?>
    <?php
    if (isset($_SESSION['nombre'])):
        include ("navbar/navbarsistema.php");
    else:
        include ("navbar/navbarindex.php");
    endif;
    ?>
    <body>
        <div class="col-md-8 col-md-offset-2">
        </div>
        <div class="col-md-12">
            <!-- Muestra Previa del Reporte -->
            <section>
                <!-- Seccion que muestra la publicacion final del reporte-->
                <?php
                require("config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
                require 'config/conexion2.php';
                if (isset($_GET['reporte'])) {
                    if (!empty($_GET['reporte'])) { // Si el valor de "noticia" no es NULL, continua con el proceso
                        $idreporte = $_GET["reporte"];
                        $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                        $select = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id  WHERE MD5(concat('" . $clave . "',A.id)) = '" . $idreporte . "' LIMIT 1";
                        $query_reportes = mysqli_query($conexion, "$select")
                                or die("Problemas en el select:" . mysqli_error($conexion)); // Ejecutamos la consulta
                        //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
                        if (mysqli_num_rows($query_reportes) > 0) { // Si existe la noticia, la muestra
                            while ($columna = mysqli_fetch_assoc($query_reportes)) { // Realizamos un bucle que muestre todas las noticias, utilizando while.
                                if (!empty($columna['nombredominio'])) {
                                    $nombre_dominio = $columna['nombredominio'];
                                } elseif (!empty($columna['nombre_nuevo_dominio'])) {
                                    $nombre_dominio = $columna['nombre_nuevo_dominio'];
                                }

                                $categoria = $columna['nombrecategoria'];
                                $autor = $columna['autor'];
                                $fecha = $columna['fecha'];
                                $titulo = $columna['titulo'];
                                $correoautor = $columna['correo'];
                                $observacion = $columna['observacion'];
                                $idreplicacion = $columna['id_reporte'];
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
                                //Panel que muestra el Reporte Final:
                                ?>                    
                                <div class="panel panel-primary container col-md-6 col-md-offset-3 rollIn animated">

                                    <div class="panel-heading row" style="background: orange">
                                        <h4 class="text-center">Reporte de Incidencia</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="titulo" class="col-md-3 col-md-offset-2 control-label">Titulo:</label>
                                            <div class="col-md-7 col-md-pull-1"><?php echo $titulo; ?></div>            
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
                                            <div class="col-md-7 col-md-pull-1"><?php echo $ticket; ?> </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha" class="col-md-3 col-md-offset-2 control-label">Fecha:</label>
                                            <div class="col-md-7 col-md-pull-1"><?php echo $fecha; ?></div>
                                        </div>
                                        <div class="row">
                                            <label for="autor" class="col-md-3 col-md-offset-2 control-label">Autor:</label>
                                            <div class="col-md-7 col-md-pull-1"><?php echo $autor; ?> </div>
                                        </div>
                                        <div class="row">
                                            <label for="estado" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                            <div class="col-md-7 col-md-pull-1"><?php echo $estatus; ?></div>
                                        </div>
                                    </div>

                                </div>                           
                                <div class="row">
                                    <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                                    <div class="col-md-10 col-md-offset-1 well" style="overflow-y: auto;"><?php echo $observacion; ?> </div>

                                </div>
                                <div class="row">
                                    <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Enviar Correo:</label><br>
                                    <form class="form" name="miFormu" method="post" action="controles/cargarcomentario.php">
    <INPUT TYPE="hidden" NAME="link" VALUE="<?php echo $Link;?>">

                                </div>
                <?php if ($idestatus == 3): ?>
                                    <!-- Formulario para envío de comentarios-->
                    <?php include ("formulariocomentarios.php"); ?>
                                <?php
                                endif;
                            }
                        }
                        else {
                            echo ''; // Si no, muestra un error
                        }
                    } else {
                        echo 'Debes seleccionar una noticia.'; // Si GET no recibe ningún valor, muestra un error
                    }
//Comentarios:
                } else {
                    if (isset($_SESSION['nombre'])):
                        ?>
                        <!-- Muestra la Vista Previa del Reporte-->
                        <!-- Tabla de Reportes -->
                        <div class="row">
                            <div class="col-md-12 table-responsive rubberBand animated">
                                <table id="example"  class="table table-bordered table-hover table-striped">
                                    <caption class="text-center"><h3>Vista Previa:</h3></caption>
                                    <thead>
                                        <tr class="bg-primary text-center">
                                            <td><h4>ID</h4></td>
                                            <td><h4>Titulo</h4></td>
                                            <td><h4>Autor</h4></td>
                                            <td><h4>Categoria</h4></td>
                                            <td><h4>Servidor</h4></td>
                                            <td><h4>Dominio</h4></td>
                                            <td><h4>Ticket</h4></td>
                                            <td><h4>Estado</h4></td>
                                            <td><h4>Fecha</h4></td>
                                            <!--<td><h4>Aciones</h4></td>-->
                                        </tr>
                                    </thead>
                                    <tbody>
        <?php
        $select = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id order by A.id desc limit 1 ";
        $query_reportes = mysqli_query($conexion, "$select")
                or die("Problemas en el select:" . mysqli_error($conexion)); // Ejecutamos la consulta
        $limite = 100; // Número de carácteres a mostrar antes de el "Leer más"
        $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
        while ($columna = mysqli_fetch_assoc($query_reportes)):
            $id_reporte = $columna['id_reporte'];
            if (!empty($columna['nombredominio'])) {
                $nombre_dominio = $columna['nombredominio'];
            } elseif (!empty($columna['nombre_nuevo_dominio'])) {
                $nombre_dominio = $columna['nombre_nuevo_dominio'];
            }

            $idprotegido = md5($clave . $columna['id_reporte']);
            ?>
                                            <tr class="text-center">
                                                <td><h4><?php echo $id_reporte; ?></h4></td>
                                                <td><h4><?php echo $columna['titulo'] ?></h4></td>
                                                <td><h4><?php echo $columna['autor'] ?></h4></td>
                                                <td><h4><?php echo $columna['nombrecategoria'] ?></h4></td>
                                                <td><h4><?php echo $columna['nombreservidor'] ?></h4></td>
                                                <td><h4><?php echo $nombre_dominio; ?></h4></td>
                                                <td><h4><?php echo $columna['ticket'] ?></h4></td>
                                                <td><h4><?php echo $columna['nombrestatus'] ?></h4></td>
                                                <td><h4><?php echo $columna['fecha'] ?></h4></td>
                                                <!--<td><a class="btn btn-warning alert-warning" href="?reporte=<?php // echo $idprotegido;?>">Mostrar</a><br><br></td>-->
                                                <!--
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="sistema.php?pag=marcas&idc=<?php // echo base64_encode($columna['idcategoria']) ?>">Modificar</a></li>
                                                        <li role="separator" class="divider"></li>
                                                        <li><a href="sistema.php?pag=marcas">Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </td>-->
                                            </tr>
                                        </tbody>


                                    </table>
                                    <section class="text-center">
                                        <div class=" col-md-6">
                                            <form action="modificarvistaprevia.php" method="post">
                                                <input class="hidden" name="idreporte" value="<?php echo $columna['idreporte'] ?>">
                                                <input class="btn btn-info alert-info btn-lg" type="submit" name="modificar" value="Modificar" />
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-warning alert-warning btn-lg" href="?reporte=<?php echo $idprotegido; ?>">Mostrar</a><br><br>
                                        </div>
                                    </section>
                                </div>
                            </div>
        <?php endwhile; ?>

                        <!-- Final de Validación de usuario-->
        <?php
    else: echo"Debe iniciar sesión para ingresar a esta página";
    endif;
}
?>
            </section>
        </div>
    </body>
                <?php include("footer.php"); ?>
</html>