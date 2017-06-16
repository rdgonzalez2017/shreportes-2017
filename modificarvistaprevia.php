<?php session_start(); ?>
    <!DOCTYPE html>
    <html>
<?php include("head.php");?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarsistema.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>

<?php if (isset($_SESSION['nombre'])):?>
    <body>
<div class="col-md-12 flipInY animated">
    <?php include "conexion.php";
    $idreporte = ($_REQUEST['idreporte']); // Recibimos el id de la incidencia por medio de GET
    $query = mysqli_query($conexion,"SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio WHERE idreporte = '".$idreporte."' LIMIT 1");// Ejecutamos la consulta
    $columna = mysqli_fetch_assoc($query);
    ?>
    <!-- Formulario para envío de modificaciones al sistema-->
    <form class="form" method = "post" action="controles/actualizarvistaprevia.php">
        <input class="hidden" name="idreporte" id="idreporte" value="<?php echo $columna['idreporte'];?>"/>
        <div class="col-md-10 col-md-offset-1">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">Incidencia ID: <?php echo $columna['idreporte'];?></h4>
                </div>
                <div class="panel-body">
                    <!-- Ingreso del titulo-->
                    <div class="form-group row">
                        <label for="titulo" class="col-md-2 col-md-offset-3 control-label">Titulo:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo $columna['titulo'];?>"/>
                        </div>
                    </div>
                    <!-- Ingreso del autor-->
                    <div class="form-group row">
                        <label for="autor" class="col-md-2 col-md-offset-3 control-label">Autor:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <input class="form-control" type="text" name="autor" id="autor" value="<?php echo $columna['autor'];?>"/>
                        </div>
                    </div>
                    <!-- Ingreso de la categoría-->
                    <div class="form-group row">
                        <label for="categoria" class="col-md-2 col-md-offset-3 control-label">Categoria:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <?php
                            include("conexion.php");
                            //Selecciona el valor que ya está seleccionado
                            $categoria_previa=mysqli_query($conexion,"select * from categorias RIGHT JOIN reporte on reporte.idcategoria = categorias.idcategoria where idreporte = '".$idreporte."'")
                            or die("Problemas en el select:".mysqli_error($conexion));
                            while ($cat=mysqli_fetch_array($categoria_previa)) :
                                $categoriaDefinida = $cat['nombre'];

                                //Selecciona todos los valores de la base de datos
                                $registros=mysqli_query($conexion,"select idcategoria,nombre from categorias ORDER BY idcategoria DESC")
                                or die("Problemas en el select:".mysqli_error($conexion));
                                $combo = '<select class="form-control" name="categoria" >\n';
                                //Función para que aparezca predeterminado el valor que ya está seleccionado previamente.
                                while ($reg=mysqli_fetch_array($registros)) {
                                    $selected = '';
                                    if ($categoriaDefinida == $reg['nombre']){
                                        $selected = 'selected';
                                    }
                                    $combo .= '<option value="'.$reg['idcategoria'].'"" '.$selected.'>'.$reg['nombre'].'</option>\n';
                                }
                                $combo .= "</select>";
                                echo $combo;
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <!-- Selección del Servidor-->
                    <div class="form-group row">
                        <label for="servidor" class="col-md-2 col-md-offset-3 control-label">Servidor:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <?php
                            include("conexion.php");
                            //Selecciona el valor que ya está seleccionado
                            $valor_previo=mysqli_query($conexion,"select * from servidor RIGHT JOIN reporte on reporte.idservidor = servidor.idservidor where idreporte = '".$idreporte."'")
                            or die("Problemas en el select:".mysqli_error($conexion));
                            while ($columna_servidor=mysqli_fetch_array($valor_previo)) :
                                $valorDefinido = $columna_servidor['nombre'];

                                //Selecciona todos los valores de la base de datos
                                $registros=mysqli_query($conexion,"select * from servidor")
                                or die("Problemas en el select:".mysqli_error($conexion));
                                $combo = '<select class="form-control" name="servidor" >\n';
                                //Función para que aparezca predeterminado el valor que ya está seleccionado previamente.
                                while ($reg=mysqli_fetch_array($registros)) {
                                    $selected = '';
                                    if ($valorDefinido == $reg['nombre']){
                                        $selected = 'selected';
                                    }
                                    $combo .= '<option value="'.$reg['idservidor'].'"" '.$selected.'>'.$reg['nombre'].'</option>\n';
                                }
                                $combo .= "</select>";
                                echo $combo;
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <!-- Modificación del dominio-->
                    <div class="form-group row">
                        <label for="dominio" class="col-md-2 col-md-offset-3 control-label">Dominio:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <input class="form-control" type="text" name="dominio" id="dominio" value="<?php echo $columna['nombredominio'];?>"/>
                        </div>
                    </div>
                    <!-- Selección del estado-->
                    <div class="form-group row">
                        <label for="estatus" class="col-md-2 col-md-offset-3 control-label">Estado:</label>
                        <div class="col-md-6 col-md-pull-1">
                            <?php
                            include("conexion.php");
                            //Selecciona el valor que ya está seleccionado
                            $valor_previo=mysqli_query($conexion,"select * from estatus RIGHT JOIN reporte on reporte.idestatus = estatus.idestatus where idreporte = '".$idreporte."'")
                            or die("Problemas en el select:".mysqli_error($conexion));
                            while ($columna_estatus=mysqli_fetch_array($valor_previo)) :
                                $valorDefinido = $columna_estatus['nombre'];

                                //Selecciona todos los valores de la base de datos
                                $registros=mysqli_query($conexion,"select * from estatus")
                                or die("Problemas en el select:".mysqli_error($conexion));
                                $combo = '<select class="form-control" name="estatus" >\n';
                                //Función para que aparezca predeterminado el valor que ya está seleccionado previamente.
                                while ($reg=mysqli_fetch_array($registros)) {
                                    $selected = '';
                                    if ($valorDefinido == $reg['nombre']){
                                        $selected = 'selected';
                                    }
                                    $combo .= '<option value="'.$reg['idestatus'].'"" '.$selected.'>'.$reg['nombre'].'</option>\n';
                                }
                                $combo .= "</select>";
                                echo $combo;
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <!-- Ingreso del Ticket-->
                    <div class="form-group row">
                        <label for="ticket" class="col-md-2 col-md-offset-3 control-label">Ticket:</label>
                        <div class="col-md-2 col-md-pull-1">
                            <input class="form-control" type="text" name="ticket" id="ticket" value="<?php echo $columna['ticket'];?>"/>
                        </div>
                    </div>
                    <!-- Observacion-->
                    <div class="form-group row">
                        <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                        <div class="col-md-12">
                            <textarea name="observacion" rows="10"><?php echo $columna['observacion'];?></textarea>
                            <script>tinyMCE.init({selector: "textarea",branding: false,plugins: "image,paste,autolink",paste_data_images: true});</script>
                        </div>
                    </div>
                    <!-- Boton para enviar datos-->
                    <div class="panel-footer text-center">
                        <input class="btn btn-warning" type="submit" name="modificar" value="Modificar Incidencia" />
                    </div>
                </div>

            </div>

        </div>
    </form>
<?php endif;?>