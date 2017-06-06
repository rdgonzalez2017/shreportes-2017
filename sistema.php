<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php")?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarinicio.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>
<?php if (isset($_SESSION['nombre'])):?>
<p class="bounceInRight animated animated" data-wow-duration="1500ms"">
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombre'];} ?>
</p>
<!-- Conexión con base de datos-->
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form" method = "post" action="controles/validarmuestra.php">

    <div class="container flipInY animated animated" data-wow-duration="1500ms"">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="text-center">Ingresar Datos</p>
                </div>
                <!-- Ingreso del titulo-->
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="titulo" class="col-md-2 control-label">Titulo:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="titulo" id="titulo"  required/>
                        </div>
                    </div>
                    <!-- Ingreso de la categoria (Tipo de caso) -->
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-2 control-label">Categoria:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="categoria">
                                    <?php
                                    include ("conexion.php");
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
                                       value="<?php if (isset($_SESSION['nombre'])) {echo $_SESSION['nombre'];}?>"/>
                            </div>
                        </div>
                        <!-- Ingreso de la observacion-->
                        <div class="form-group row">
                            <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                            <div class="col-md-12" >
                                <textarea id="textarea" name="observacion" style="resize:none"  rows="10" aria-required="true"></textarea>
                                <script>tinyMCE.init({selector: "textarea",branding: false,plugins: "image,paste",paste_data_images: true,language : "es"});</script>
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

<?php else: echo'Debe iniciar sesión para ingresar a esta página.';?>
    <br><button class="btn btn-info btn-sm navbar-btn col-md-offset-1" onclick = "location='Index.php'">Iniciar Sesión</button>
<?php endif; ?>
</html>

