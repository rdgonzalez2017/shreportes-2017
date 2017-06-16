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
<p class="bounceInRight">
<?php if (isset($_SESSION['nombre'])) {echo "Bienvenido: ".$_SESSION['nombrecompleto'];} ?>
</p>
<!-- Conexión con base de datos-->
<body>
<!-- Formulario para envío de datos del sistema-->
<form class="form" method = "post" action="controles/validarmuestra.php">
    <input type="hidden" name="idusuario" value="<?php if (isset($_SESSION['idusuario'])) {echo $_SESSION['idusuario'];}?>"/>
    <div class="container flipInY animated animated" data-wow-duration="1500ms"">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">Ingresar Datos</h4>
                </div>
                    <div class="panel-body">
                        <!-- Ingreso del titulo-->
                        <div class="form-group row">
                            <label for="titulo" class="col-md-2 col-md-offset-1 control-label">Titulo:</label>
                            <div class="col-md-8 col-md-pull-1">
                                <input class="form-control" type="text" name="titulo" id="titulo"  required/>
                            </div>
                        </div>
                        <!-- Ingreso del dominio-->
                            <div class="form-group row">
                                <label for="dominio" class="col-md-2 col-md-offset-1 control-label">Dominio:</label>
                                <div class="col-md-8 col-md-pull-1">
                                    <input class="form-control" type="text" name="dominio" id="dominio"/>
                                </div>
                            </div>
                    <!-- Ingreso de la categoria (Tipo de caso) -->
                        <div class="form-group row">
                            <label for="categoria" class="col-md-2 col-md-offset-1 control-label">Categoria:</label>
                            <div class="col-md-8 col-md-pull-1">
                                <select class="form-control" name="categoria" id="categoria">
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
                        <!-- Ingreso del Servidor-->
                            <div class="form-group row">
                                <label for="servidor" class="col-md-2 col-md-offset-1 control-label">Servidor:</label>
                                <div class="col-md-8 col-md-pull-1">
                                    <select class="form-control" name="servidor">
                                        <?php
                                        include ("conexion.php");
                                        $registros=mysqli_query($conexion,"select idservidor,nombre from servidor") or
                                        die("Problemas en el select:".mysqli_error($conexion));
                                        while ($reg=mysqli_fetch_array($registros))
                                        {
                                            echo "<option value=\"$reg[idservidor]\">$reg[nombre]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <!-- Numeto de ticket-->
                        <div class="form-group row">
                            <label for="ticket" class="col-md-2 col-md-offset-1 control-label">Ticket:</label>
                            <div class="col-md-4 col-md-pull-1">
                                <input class="form-control" type="text" name="ticket" id="ticket">

                            </div>
                        </div>
                        <!-- Ingreso del Autor-->
                        <div class="form-group row">
                            <label for="autor" class="col-md-2 col-md-offset-1 control-label">Autor:</label>
                            <div class="col-md-4 col-md-pull-1">
                                <input class="form-control" readonly="readonly" type="text" name="autor" id="autor"
                                       value="<?php if (isset($_SESSION['nombrecompleto'])) {echo $_SESSION['nombrecompleto'];}?>"/>
                            </div>
                        </div>
                        <!-- Ingreso de la observacion-->
                        <div class="form-group row">
                            <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                            <div class="col-md-12" >
                                <textarea id="textarea" name="observacion" style="resize:none"  rows="10" aria-required="true"></textarea>
                                <script>tinyMCE.init({selector: "textarea",branding: false,plugins: "image,paste,autolink",paste_data_images: true,language : "es"});</script>
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
<?php endif; ?>
</html>

