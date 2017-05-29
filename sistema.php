<?php session_start(); ?>
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
<!DOCTYPE html>
<html>
<?php include("head.php")?>
<?php include("navbarsistema.php")?>

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