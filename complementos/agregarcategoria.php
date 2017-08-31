<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
    <?php
    if (isset($_SESSION['nombre'])):
        include("navbar/navbarsistema.php");
    else:
        include("navbar/navbarindex.php");
    endif;
    ?>
    <?php if (isset($_SESSION['nombre'])): ?>
        <?php
        if (isset($_SESSION['nombre'])) {
            echo "Sesión Abierta: " . $_SESSION['nombrecompleto'];
        }
        ?>
        <body>
            <!-- Formulario para envío de datos del sistema-->
            <div class="container">
                <div class="row bounceInDown animated">
                    <form class="form" method = "post" action="../controles/insertar_categoria.php">
                        <div class="col-md-10 col-md-offset-1" style="font-size:16px;">
                            <br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="text-center">Ingresar Categoria</h4>
                                </div>
                                <!-- Ingreso del Nombre:-->
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="text-right col-md-2 control-label">Nombre:</label>
                                        <div class="col-md-8">
                                            <input placeholder="Ingrese nombre de categoría" class="text-center form-control" type="text" name="nombre" id="nombre"  required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="campos_personalizados" class="col-md-8 col-md-offset-2 control-label text-center">Selección de campos personalizados:</label>
                                        <?php
                                        include '../config/conexion.php';
                                        $select_campo = mysqli_query($conexion, "select * from campos_personalizables")
                                                or die("Problemas en el insert principal" . mysqli_error($conexion));
                                        while ($fila = mysqli_fetch_assoc($select_campo)):
                                            $nombre = $fila['nombre'];
                                            $id_campo = $fila['id'];
                                            ?>
                                            <div class="col-md-3 text-center well">
                                                <label class="checkbox-inline"><input type="checkbox" name="campo_personalizado[]"  value="<?php echo $id_campo; ?>"/><?php echo $nombre; ?></label>
                                            </div>
                                        <?php endwhile;
                                        ?>
                                    </div>
                                    <!-- Boton para enviar datos-->
                                    <div class="panel-footer text-center">
                                        <input type="submit" class="btn btn-warning" value="Agregar"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-12 table-responsive fadeIn animated" data-wow-duration="10ms">
                        <table id="example"  class="table table-bordered table-hover table-striped">
                            <caption class="text-center"><h3>Listado de Categorías</h3></caption>
                            <thead>
                                <tr class="bg-primary text-center">
                                    <td><h4>ID</h4></td>
                                    <td><h4>Nombre</h4></td>
                                    <td><h4>Campos personalizables</h4></td>
                                    <td><h4>Acción</h4></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../config/conexion.php");
                                $query_reportes = mysqli_query($conexion, "select * from categorias ORDER BY id ASC ")
                                        or die("Problemas en el insert principal" . mysqli_error($conexion));
                                mysqli_close($conexion);
                                while ($columna = mysqli_fetch_assoc($query_reportes)):
                                    $id_categoria = $columna['id'];
                                    $nombre_categoria = $columna['nombre'];
                                    ?>
                                    <tr class="text-center" style="font-size:18px;">
                                <form action="../controles/actualizar_categoria.php" method="Post">
                                    <td class="col-md-1"><h4><?php echo $id_categoria; ?></h4></td>
                                    <td class="col-md-3"><input style="font-size:18px;"  name="nombre_categoria" class="form-control text-center" value="<?php echo $nombre_categoria; ?>"/></td>
                                    <td class="col-md-3">
                                        <?php
                                        //Selecciona el valor previamente definido:
                                        include '../config/conexion.php';
                                        $campo_previo = mysqli_query($conexion, "Select * from campos_personalizables")
                                                or die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($fila = mysqli_fetch_array($campo_previo)) :
                                            $id_campo = $fila['id'];
                                            $nombre_campo = $fila['nombre'];
                                            echo $nombre_campo;
                                            ?>
                                        <input type="checkbox" name="campos_personalizados[]"  value="<?php echo $id_campo ?>" 
                                            <?php
                                            $select_campos = mysqli_query($conexion, "SELECT C.nombre as nombre_campo, C.id as id_campo FROM categorias as A INNER JOIN detalle_categorias as B on A.id = B.id_categoria INNER JOIN campos_personalizables as C on B.id_campo = C.id where A.id = '$id_categoria'");
                                            while ($fila_campos = mysqli_fetch_array($select_campos)) {
                                                $nombre_campo_definido = $fila_campos['nombre_campo'];
                                                $id_campo_definido = $fila_campos['id_campo'];
                                                // echo '<br>Campo definido:'.$nombre_campo.'<br>';
                                                if ($id_campo == $id_campo_definido) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> 
                                                   /><br>
                                                   <?php
                                               endwhile;
                                               ?>
                                    </td>
                                    <td class="text-center col-md-2">
                                        <div class="btn-group dropdown" > 
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " style="text-align: center;">   
                                                <input class="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
                                                <input class="btn btn-info alert-info" type="submit" name="modificar" value="Grabar" />
                                                </form>
                                                <li role="separator" class="divider"></li>
                                                <form action="../controles/eliminacategoria.php" method="post">
                                                    <input class="hidden" name="idcategoria" value="<?php echo $id_categoria; ?>">
                                                    <input onclick="return confirm('Estás seguro que deseas eliminar esta categoría?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                                </form>
                                            </ul>                                       
                                        </div> 
                                    </td>
                                    </tr>

                                <?php endwhile; ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
    <?php else: echo'Debe iniciar sesión para ingresar a esta página.'; ?>
    <?php endif; ?>
</html>
