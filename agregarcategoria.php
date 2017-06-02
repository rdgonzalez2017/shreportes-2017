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
<!-- Conexión con base de datos-->
<?php include('conexi.php');?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form bounceInDown animated" method = "post" action="../controles/cargarcategoria.php">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <div class="panel panel-success">
            <div class="panel-heading">
                <p class="text-center">Ingresar Categoria</p>
            </div>
            <!-- Ingreso del titulo-->
            <div class="panel-body">
                <div class="form-group row">
                    <label for="nombre" class="col-md-2 control-label">Nombre de Categoría</label>
                    <div class="col-md-8">
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
<footer class="row text-center">
    <div class="col-md-2">
    </div>
</footer>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.';?>
    <br><button class="btn btn-info btn-sm navbar-btn col-md-offset-1" onclick = "location='Index.php'">Iniciar Sesión</button>
<?php endif; ?>
</html>