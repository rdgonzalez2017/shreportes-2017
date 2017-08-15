<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
    <div class="container-fluid row">
        <?php
        if (isset($_SESSION['nombre'])):
            include ("navbar/navbarsistema.php");
        else:
            include ("navbar/navbarindex.php");
        endif;
        ?>
        <?php if (isset($_SESSION['nombre'])): ?>
        </div>
        <body>
            <div class="container col-md-6 col-md-offset-3">
                <?php
                include ("../config/conexion.php");
                if (isset($_SESSION['idusuario'])) {
                    ob_start();
                    echo $_SESSION['idusuario'];
                    $idusuario = ob_get_contents();
                    ob_end_clean();
                }
                // Recibimos el id de la noticia por medio de GET
                $query_usuarios = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '" . $idusuario . "'")
                        or die("Problemas en el insert principal" . mysqli_error($conexion));
                mysqli_close($conexion); // Ejecutamos la consulta
                while ($columna = mysqli_fetch_assoc($query_usuarios)):
                    ?>
                    <!-- Formulario para envío de modificaciones al sistema-->
                    <form class="form rotateIn animated" method = "post" action="../controles/actualizarusuario.php">
                        <input class="hidden" name="idusuario" value="<?php echo $columna['idusuario']; ?>"/>
                        <div class="col-md-12">
                            <br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="text-center">Id de Usuario: <?php echo $columna['id']; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <!-- Ingreso del Nombre-->
                                    <div class="form-group row">
                                        <label for="nombre" class="col-md-2 col-md-offset-2 control-label">Usuario:</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $columna['nombre']; ?>"/>
                                        </div>
                                    </div>
                                    <!-- Ingreso del Nombre-->
                                    <div class="form-group row">
                                        <label for="nombrecompleto" class="col-md-2 col-md-offset-2 control-label">Nombre:</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="nombrecompleto" value="<?php echo $columna['nombrecompleto']; ?>"/>
                                        </div>
                                    </div>
                                    <!-- Ingreso del Correo-->
                                    <div class="form-group row">
                                        <label for="titulo" class="col-md-2 col-md-offset-2 control-label">Correo:</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="correo" value="<?php echo $columna['correo']; ?>"/>
                                        </div>
                                    </div>
                                    <!-- Ingreso del autor-->
                                    <div class="form-group row">
                                        <label for="autor" class="col-md-2 col-md-offset-2 control-label">Clave:</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="clave" value="<?php echo $columna['clave']; ?>"/>
                                        </div>
                                    </div>
                                    <!-- Boton para enviar datos-->
                                    <div class="panel-footer text-center">
                                        <input class="btn btn-warning" type="submit" name="modificar" value="Modificar" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                <?php endwhile ?>
            <?php else: echo 'Debe Iniciar Sesión para entrar a esta página.';
            endif;
            ?>
            <?php ?>
        </div>
    </body>

</html>
