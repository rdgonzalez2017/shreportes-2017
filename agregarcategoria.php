<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>	Agregar </title>
</head>
<!-- Conexión con base de datos-->
<?php include('conexi.php');?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form" method = "post" action="cargarcategoria.php">
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
<?php include("botonInicio.php");?>
    </div>
</footer>
</html>