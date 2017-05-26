<?php session_start(); ?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>	SH Reportes	</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="bootstrap.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>
</head>
<nav class="navbar navbar-inverse" style="background: darkblue;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="img-responsive" href="#"><img src="images/logo_desktop.png"></a>


        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-warning navbar-btn" onclick = "location='modificacionreportes.php'">Modificar Reportes</button>-</li>
                <li><button class="btn btn-warning navbar-btn" onclick = "location='agregar.php'">Agregar Categorias</button>-</li>
                <li><button class="btn btn-info navbar-btn" onclick = "location='reportes.php'">Ver Reportes</button></li>
                <li><a href='index.php'><span class="glyphicon glyphicon-log-in"></span> Cierre de Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conexión con base de datos-->
<?php include('conexi.php');?>

<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form" method = "post" action="muestra.php">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <p class="text-center">Ingresar Datos</p>
                </div>
                <!-- Ingreso del titulo-->
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="titulo" class="col-md-2 control-label">Titulo</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="titulo" id="titulo"  required/>
                        </div>
                    </div>
                    <!-- Ingreso de la categoria (Tipo de caso) -->
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-2 control-label">Tipo:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="categoria">
                                    <?php
                                    $conexion=mysqli_connect("localhost","root","","shreportes") or
                                    die("Problemas con la conexión");
                                    $registros=mysqli_query($conexion,"select idcategoria,nombre from categorias") or
                                    die("Problemas en el select:".mysqli_error($conexion));
                                    while ($reg=mysqli_fetch_array($registros))
                                    {
                                        echo "<option value=\"$reg[idcategoria]\">$reg[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Ingreso del Autor-->
                        <div class="form-group row">
                            <label for="autor" class="col-md-2 control-label">Autor</label>
                            <div class="col-md-8">
                                <input class="form-control" readonly="readonly" type="text" name="autor" id="autor"
                                       value="<?php
                                       if (isset($_SESSION['nombre']))
                                       {
                                           echo $_SESSION['nombre'];
                                       }?>" required/>
                            </div>
                        </div>
                        <!-- Ingreso de la observacion-->
                        <div class="form-group row">
                            <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                            <div class="col-md-12" >
                                <textarea name="observacion" style="resize:none" required class="form-control" id="observacion" rows="10"></textarea>
                                <script>
                                    CKEDITOR.replace('observacion');
                                    </script>
                            </div>
                        </div>

                    </div>
                    <!-- Boton para enviar datos-->
                    <div class="panel-footer text-center">
                        <input type="submit" class="btn btn-info" value="Mostrar"></input>

                    </div>
                </div>

            </div>

        </div>
    </div>
</form>
<!-- Formulario para envío de datos del sistema-->

</body>

</html>