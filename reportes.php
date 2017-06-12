<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include ("head.php");?>
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
<div class="row col-md-10 col-md-offset-1">

    <!-- Muestra Previa del Reporte -->
    <section>
        <!-- Seccion que muestra la publicacion final del reporte-->
        <?php
        include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
        if(isset($_GET['reporte']))
        {
            if(!empty($_GET['reporte'])) // Si el valor de "noticia" no es NULL, continua con el proceso
            {
                $idreporte = $_GET["reporte"];
                $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                $select = "SELECT *, estatus.nombre as nombrestatus, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN usuarios ON reporte.idusuario = usuarios.idusuario WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1";
                $query_reportes = mysqli_query($conexion,"$select") // Ejecutamos la consulta
                or die("Problemas en el select:".mysqli_error($conexion));
                //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
                if(mysqli_num_rows($query_reportes) > 0) // Si existe la noticia, la muestra
                {
                    while($columna = mysqli_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
                    {
                        $categoria =  $columna['nombrecategoria'];
                        $titulo =  $columna['titulo'];
                        $autor =  $columna['autor'];
                        $fecha =  $columna['fecha'];
                        $observacion =  $columna['observacion'];
                        $idreplicacion =  $columna['idreporte'];
                        $correoautor =  $columna['correo'];
                        $idestatus =  $columna['idestatus'];
                        $estatus =  $columna['nombrestatus'];
                        //Con esto se obtiene el Link de la página:
                        $host= $_SERVER["HTTP_HOST"];
                        $url= $_SERVER["REQUEST_URI"];
                        ob_start();
                        echo $host,$url;
                        $Link = ob_get_contents();
                        ob_end_clean();
                        //Panel que muestra el Reporte Final:
                        echo'
                             <div class="panel panel-primary container col-md-8 col-md-offset-2 rotateIn animated animated" data-wow-duration="3000ms"">
                                
                                    <div class="panel-heading row" style="background: orange">
                                        <h4 class="text-center">Incidencia</h4>
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
                                            <label for="observacion" class="col-md-10 control-label">Observacion:</label><br>
                                        <div class="col-md-12 well bounceIn animated animated" data-wow-duration="3000ms" " style="overflow-y: auto;">'; echo $observacion; echo' </div>

                                        </div>
                       
                                            ';
                    if ($idestatus <> 1):?>

                            <BR>
                                                 
                            <!-- Formulario para envío de comentarios-->
                                <form class="form fadeInRightBig animated" name="miFormu" method="post" action="controles/cargarcomentario.php">
                                    <INPUT TYPE="hidden" NAME="link" VALUE="<?php echo $Link;?>">
                                    <INPUT TYPE="hidden" NAME="correoautor" VALUE="<?php echo $correoautor?>">
                                    <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $idreplicacion?>">
                                    <INPUT TYPE="hidden" NAME="idprotegido" VALUE="<?php echo $idreporte?>">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <p class="text-center">Formulario de Comentarios</p>
                                            </div>
                                            <div class="panel-body">
                                               <!-- Ingreso del Autor-->
                                                <div class="form-group row">
                                                    <label for="nick" class="col-md-2 control-label">Autor:</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" value="<?php if (isset($_SESSION['nombre'])) {echo $_SESSION['nombre'];}?>" required/>
                                                    </div>
                                                </div>
                                                <!-- Ingreso del Correo-->
                                                <div class="form-group row">
                                                    <label for="correo" class="col-md-2 control-label">Correo:</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="email" name="correocliente" value="<?php if (isset($_SESSION['correo'])) {echo $_SESSION['correo'];}?>" required/>
                                                    </div>
                                                </div>
                                              <!-- Ingreso del comentario-->
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

                    <?php endif;?>
<?php
                }
            }
            else
            {
                echo ''; // Si no, muestra un error
            }
        }
        else
        {
            echo 'Debes seleccionar una noticia.'; // Si GET no recibe ningún valor, muestra un error
        }
//Comentarios:
    }
    else
    {
        ?>
        <!-- Tabla de Reportes -->
            <div class="row">
                <div class="col-md-12 table-responsive rotateIn animated" data-wow-duration="500ms"">
                    <table id="example"  class="table table-bordered table-hover table-striped">
                        <caption class="text-center"><h3>Reportes de Incidencias</h3></caption>
                        <thead>
                        <tr class="bg-primary text-center">
                            <td><h4>ID</h4></td>
                            <td><h4>Titulo</h4></td>
                            <td><h4>Autor</h4></td>
                            <td><h4>Categoria</h4></td>
                            <td><h4>Estado</h4></td>
                            <td><h4>Fecha</h4></td>
                            <td><h4>Mostrar</h4></td>
                            <td><h4>Eliminar</h4></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_SESSION['nombre'])):
                        $select = "SELECT *, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus order by idreporte desc";
                        $query_reportes = mysqli_query($conexion,"$select")
                        or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta
                        $limite = 100; // Número de carácteres a mostrar antes de el "Leer más"
                        $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                        while($columna = mysqli_fetch_assoc($query_reportes)):?>
                            <?php $idprotegido=md5($clave.$columna['idreporte']);?>
                            <tr class="text-center">
                                <td><h4><?php echo $columna['idreporte']?></h4></td>
                                <td><h4><?php echo $columna['titulo'] ?></h4></td>
                                <td><h4><?php echo $columna['autor'] ?></h4></td>
                                <td><h4><?php echo $columna['nombrecategoria'] ?></h4></td>
                                <td><h4><?php echo $columna['nombrestatus'] ?></h4></td>
                                <td><h4><?php echo $columna['fecha'] ?></h4></td>
                                <td><a class="btn btn-warning alert-warning" href="?reporte=<?php echo $idprotegido;?>">Mostrar</a>
                    <td class="text-center">
                        <div class="btn-group">
                            <!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <!--<ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>-->
                                <form action="controles/eliminareporte.php" method="post">
                                    <input class="hidden" name="idreporte" value="<?php echo $columna['idreporte']?>">
                                    <input onclick="return confirm('Estás seguro que deseas eliminar el registro?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                </form>
                                <!--</ul>-->
            </div>
        </td>
                            </tr>
                        </tbody>
                        <?php endwhile;?>
                    </table>
                </div>
            </div>
            <?php
             else: echo"Debe iniciar sesión para ingresar a esta página";
            endif;

    }
        ?>

</section>
</div>

<section>
    <br><br>
    <!-- Muestra los comentarios-->
    <?php include ("muestracomentario.php")?>
</section>
</body>
<?php include("footer.php");?>
</html>