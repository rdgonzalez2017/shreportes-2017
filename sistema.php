<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>	SH Reportes	</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap.js"></script>


    <script src="js/ckeditor/ckeditor.js"></script>
</head>
<!-- Botòn que lleva a modificar los reportes-->
<div style="float: right">
    <input type="submit" class="btn btn-info btn-sm" value="Modificar Reportes" onclick = "location='modificacionreportes.php'"/>
</div>
<!-- Botòn que lleva a la tabla de reportes-->
<div style="float: right">
    <input type="submit" class="btn btn-info btn-sm" value="Tabla de Reportes" onclick = "location='tabla2.php'"/>
</div>
<!-- Botòn que lleva al ingreso de categorías-->
<div style="float: right">
    <input type="submit" class="btn btn-info btn-sm" value="Agregar Categorias" onclick = "location='agregar.php'"/>
</div>
<!-- Botòn que muestra todos los reportes-->
<div style="float: right">
    <input type="submit" class="btn btn-info btn-sm" value="Ver todos los reportes" onclick = "location='reportes.php'"/>
</div>


<!-- Conexión con base de datos-->
<?php include('conexi.php');?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form" method = "post" action="muestra.php">
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
</form>
<!-- Formulario para envío de datos del sistema-->

</body>
</html>