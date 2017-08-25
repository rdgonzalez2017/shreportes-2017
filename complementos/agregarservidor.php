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
            echo "Bienvenido: " . $_SESSION['nombre'];
        }
        ?>
        <body>
            <!-- Formulario para envío de datos del sistema-->
            <div class="container">
                <div class="row">
                    <form class="form bounceInDown animated" method = "post" action="../controles/cargarservidor.php">
                        <div class="col-md-8 col-md-offset-2" style="font-size:16px;">
                            <br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="text-center">Nuevo servidor</h4>
                                </div>
                                <!-- Ingreso del nombre-->
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="text-right col-md-2 control-label">Nombre:</label>
                                        <div class="col-md-8">
                                            <input class="form-control text-center" placeholder="Ingrese nombre del servidor" type="text" name="nombre" id="nombre"  required/>
                                        </div>
                                    </div>
                                    <!-- Boton para enviar datos-->
                                    <div class="panel-footer text-center">
                                        <input type="submit" class="btn btn-warning" value="Agregar"></input>

                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 table-responsive rotateIn animated" data-wow-duration="500ms"">
                <table id="example"  class="table table-bordered table-hover table-striped">
                    <caption class="text-center"><h3>Listado de Servidores</h3></caption>
                    <thead>
                        <tr class="bg-primary text-center">
                            <td><h4>ID</h4></td>
                            <td><h4>Nombre</h4></td>
                            <td><h4>Acción</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../config/conexion.php");
                        $query = mysqli_query($conexion, "select * from servidores ORDER BY id ASC ")
                                or die("Problemas en el insert principal" . mysqli_error($conexion));
                        mysqli_close($conexion);
                        while ($fila = mysqli_fetch_assoc($query)):
                            $id_servidor = $fila['id'];
                            $nombre_servidor = $fila['nombre'];
                            ?>
                            <tr class="text-center" style="font-size:18px;">
                        <form action="../controles/actualizar_servidor.php" method="Post">
                            <td class="col-md-1"><h4><?php echo $id_servidor; ?></h4></td>
                            <td class="col-md-3"><input style="font-size:18px;"  name="nombre_servidor" class="form-control text-center" value="<?php echo $nombre_servidor; ?>"/></td>
                            <td class="text-center col-md-1">
                                <div class="btn-group dropdown" > 
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " style="text-align: center;">   
                                        <input class="hidden" name="id_servidor" value="<?php echo $id_servidor; ?>">
                                        <input class="btn btn-warning alert-warning" type="submit" name="modificar" value="Grabar cambios" />
                                        </form>
                                        <li role="separator" class="divider"></li>
                                        <form action="../controles/eliminar_servidor.php" method="post">
                                            <input class="hidden" name="id_servidor" value="<?php echo $id_servidor; ?>">
                                            <input onclick="return confirm('Estás seguro que deseas eliminar este servidor?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
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
    </body>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.'; ?>
<?php endif; ?>
</html>
