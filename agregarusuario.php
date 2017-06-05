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
<!-- Conexión con base de datos-->
<?php include('conexi.php');?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form bounceInDown animated" method = "post" action="controles/cargarusuario.php">
    <div class="col-md-6 col-md-offset-3">
        <br>
        <div class="panel panel-success">
            <div class="panel-heading">
                <p class="text-center">Ingresar Usuario</p>
            </div>
            <div class="panel-body">
                <!-- Selección del tipo de usuario-->
                <div class="form-group row">
                    <label for="nombre" class="col-md-2 control-label">Tipo:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="tipo">
                            <?php
                            include ("conexion.php");
                            $registros=mysqli_query($conexion,"select * from tipodeusuario") or
                            die("Problemas en el select:".mysqli_error($conexion));
                            while ($reg=mysqli_fetch_array($registros))
                            {
                                echo "<option value=\"$reg[idtipodeusuario]\">$reg[nombre]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Ingreso del nombre-->
                <div class="form-group row">
                    <label for="nombre" class="col-md-2 control-label">Nombre:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="nombre" id="nombre"  required/>
                    </div>
                </div>
                <!-- Ingreso del nombre-->
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="correo" class="col-md-2 control-label">Correo:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" name="correo" id="correo"  required/>
                        </div>
                    </div>
                    <!-- Ingreso de la clave-->
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="correo" class="col-md-2 control-label">Clave:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="clave" id="clave"  required/>
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
<!-- Formulario para envío de datos del sistema-->
</body>
<footer class="row text-center">
    <div class="col-md-2">
    </div>
</footer>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.';?>
<?php endif; ?>
</html>