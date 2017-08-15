<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include ("head.php");?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarsistema.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>
<?php if (isset($_SESSION['nombre'])):?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form bounceInDown animated" method = "post" action="../controles/cargarusuario.php">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Agregar Usuario</h4>
            </div>
            <div class="panel-body">
                <!-- Selección del tipo de usuario-->
                <div class="form-group row">
                    <label for="nombre" class="col-md-2 control-label">Tipo:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="tipo">
                            <?php
                            include ("../config/conexion.php");
                            $registros=mysqli_query($conexion,"select * from tiposdeusuarios") or
                            die("Problemas en el select:".mysqli_error($conexion));
                            while ($reg=mysqli_fetch_array($registros))
                            {
                                echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Nombre de Usuario-->
                <div class="form-group row">
                    <label for="nombre" class="col-md-2 control-label">Usuario:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="nombre" id="nombre"  required/>
                    </div>
                </div>
                <!-- Nombre Completo-->
                <div class="form-group row">
                    <label for="nombrecompleto" class="col-md-2 control-label">Nombre:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="nombrecompleto" required/>
                    </div>
                </div>
                <!-- Correo del usuario-->
                    <div class="form-group row">
                        <label for="correo" class="col-md-2 control-label">Correo:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" name="correo" id="correo"  required/>
                        </div>
                    </div>
                    <!-- Ingreso de la clave-->
                        <div class="form-group row">
                            <label for="correo" class="col-md-2 control-label">Clave:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="clave" id="clave"  required/>
                            </div>
                        </div>
                    </div>
                <!-- Boton para enviar datos-->
                <div class="panel-footer text-center">
                    <input type="submit" class="btn btn-info" value="Agregar"></input>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-10 col-md-offset-1 table-responsive rotateIn animated" data-wow-duration="500ms"">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Listado de Usuarios</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Usuario</h4></td>
                <td><h4>Nombre</h4></td>
                <td><h4>Correo</h4></td>
                <td><h4>Acción</h4></td>
            </tr>
            </thead>
            <tbody>
            <?php
            include("../config/conexion.php");
            $query_reportes = mysqli_query($conexion, "select * from usuarios ORDER BY id asc ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
            mysqli_close($conexion);
            while($columna = mysqli_fetch_assoc($query_reportes)):?>
                <tr class="text-center">
                    <td><h4><?php echo $columna['id']?></h4></td>
                    <td><h4><?php echo $columna['nombre'] ?></h4></td>
                    <td><h4><?php echo $columna['nombrecompleto'] ?></h4></td>
                    <td><h4><?php echo $columna['correo'] ?></h4></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>-->
                                <form action="../controles/eliminausuario.php" method="post">
                                    <input class="hidden" name="idusuario" value="<?php echo $columna['id']?>">
                                    <input onclick="return confirm('Estás seguro que deseas eliminar el usuario?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                </form>
                             <!--</ul>-->
                        </div>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>
</body>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.';?>
<?php endif; ?>
</html>