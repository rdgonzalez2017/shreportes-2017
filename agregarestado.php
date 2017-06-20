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
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form bounceInDown animated" method = "post" action="controles/cargarestado.php">
    <div class="col-md-6 col-md-offset-3">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Nuevo Estado</h4>
            </div>
            <!-- Ingreso del titulo-->
            <div class="panel-body">
                <div class="form-group row">
                    <label for="nombre" class="col-md-3 control-label">Nombre:</label>
                    <div class="col-md-8 col-md-pull-1">
                        <input class="form-control" type="text" name="nombre" id="nombre"  required/>
                    </div>
                </div>
                <!-- Boton para enviar datos-->
                <div class="panel-footer text-center">
                    <input type="submit" class="btn btn-info btn-sm" value="Agregar"></input>

                </div>
            </div>

        </div>

    </div>
</form>
<!-- Formulario para envío de datos del sistema-->
</body>
<?php include("tablas/tablaestados.php") ?>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.';?>
<?php endif; ?>
</html>