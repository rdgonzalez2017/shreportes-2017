<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include("head.php") ?>
    <?php
    if (isset($_SESSION['nombre'])):
        include ("navbar/navbarsistema.php");
    else:
        include ("navbar/navbarindex.php");
    endif;
    ?>
    <?php
    if (!empty($_POST['correo'])):
        $correo = $_POST['correo'];
        require ('config/conexion2.php');
        $select_clientes = mysqli_query($conexion, "select * from tblclients where email = '$correo'")
                or die("Problemas en el select" . mysqli_error("$conexion"));
        if (mysqli_num_rows($select_clientes) == 0):
            ?>
            <div class="text-center">
                <h3>Cliente no registrado.<h3> 
                        <a class="btn btn-warning btn-lg" style="text-align: center" href="inicio.php">Regresar.</a>
                        </div>
                        <?php exit(); ?>
                        <?php
                    else:
                        while ($columna = mysqli_fetch_assoc($select_clientes)):
                            $id_cliente = $columna['id'];
                            $nombre = $columna['firstname'];
                            $email = $columna['email'];
                            $apellido = $columna['lastname'];
                            $empresa = $columna['companyname'];
                            $direccion = $columna['address1'];
                            $ciudad = $columna['city'];
                            $estado = $columna['state'];
                            $telefono = $columna['phonenumber'];
                        endwhile;
                    endif;
                endif;
                ?>

                <?php
//Contador de Incidencias
                include "config/conexion.php";
                $contador = mysqli_query($conexion, "SELECT COUNT(*) as contador from reportes");
                while ($columna = mysqli_fetch_array($contador)):
                    $cantidadincidencias = $columna['contador'];
                    ?>
                    <div class="row">
                        <div class="col-md-3"><?php
                            if (isset($_SESSION['nombre'])) {
                                echo "Sesión abierta: " . $_SESSION['nombrecompleto'];
                            }
                            ?>       </div>
                        <div class="col-md-3 col-md-offset-2">Cantidad de Incidencias reportadas: <?php echo $cantidadincidencias; ?></div>
                    </div>
<?php endwhile; ?>
<?php if (isset($_SESSION['nombre'])): ?>
                    <!-- Conexión con base de datos-->
                    <body>
                        <!-- Formulario para envío de datos del sistema-->
                        <form class="form" method = "post" action="controles/cargar_reporte.php">
                            <!-- Envío de id de usuario (Oculto) -->
                            <input type="hidden" name="idusuario" value="<?php
                                if (isset($_SESSION['idusuario'])) {
                                    echo $_SESSION['idusuario'];
                                }
                                ?>"/>         
                            <!-- Envío de id de cliente (Oculto) -->
                            <input type="hidden" name="id_cliente" value="<?php
                               if (!empty($id_cliente)) {
                                   echo $id_cliente;
                               }
                               ?>"/>
                            <!-- Panel de Ingreso de datos -->
                            <div class="container bounceInRight animated" data-wow-duration="500ms">
                                <div class="col-md-10 col-md-offset-1">
                                    <br>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="text-center">Ingresar Datos</h4>
    <?php if (!empty($nombre)): ?>
                                                <h5 class="text-center">Cliente: <?php echo $nombre . " " . $apellido; ?>
        <?php echo "<br> Correo: " . $correo; ?>
                                                </h5>
    <?php endif; ?>
                                        </div>
                                        <div class="panel-body">
                                            <!-- Ingreso del titulo-->
                                            <div class="form-group row">
                                                <label for="titulo" class="col-md-2 col-md-offset-1 control-label">Titulo:</label>
                                                <div class="col-md-8 col-md-pull-1">
                                                    <input class="form-control" type="text" name="titulo" id="titulo"  required/>
                                                </div>
                                            </div>
                                            <?php if (!empty($id_cliente)): ?>
                                            <!-- Selección de dominios registrados (en BD WHMCS)-->
                                            <div class="form-group row">
                                                <label for="id_dominio_registrado" class="col-md-3 col-md-offset-1 control-label">Dominios internos:</label>
                                                <div class="col-md-6 col-md-pull-1">
                                                    <select class="form-control" name="id_dominio_registrado" id="id_dominio_registrado">
                                                        <option></option>
                                                        <?php
                                                        require ("config/conexion2.php");
                                                        $registros = mysqli_query($conexion, "SELECT * FROM `tblclients` as A INNER JOIN tbldomains as B on A.id = B.userid where A.email = '$correo'") or
                                                                die("Problemas en el select:" . mysqli_error($conexion));
                                                        while ($reg = mysqli_fetch_array($registros)) {
                                                            echo "<option value=\"$reg[id]\">$reg[domain]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Selección de dominios No registrados-->
                                            <div class="form-group row">
                                                <label for="id_dominio_noregistrado" class="col-md-3 col-md-offset-1 control-label">Dominios externos:</label>
                                                <div class="col-md-6 col-md-pull-1">
                                                    <select class="form-control" name="id_dominio_noregistrado" id="id_dominio_noregistrado">
                                                        <option></option>
                                                        <?php
                                                        require ("config/conexion.php");
                                                        $registros = mysqli_query($conexion, "SELECT * FROM dominios where id_cliente = '$id_cliente'") or
                                                                die("Problemas en el select:" . mysqli_error($conexion));
                                                        while ($reg = mysqli_fetch_array($registros)) {
                                                            echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <!--Ingresar nuevo dominio-->
                                            <div class="form-group row">
                                                <label for="nuevo_dominio" class="col-md-3 col-md-offset-1 control-label">Dominio nuevo:</label>
                                                <div class="col-md-6 col-md-pull-1">
                                                    <input class="form-control" type="text" name="nuevo_dominio" id="nuevo_dominio"/>
                                                </div>
                                            </div>
                                            <!-- Ingreso de la categoria (Tipo de caso) -->
                                            <div class="form-group row">
                                                <label for="categoria" class="col-md-2 col-md-offset-1 control-label">Categoria:</label>
                                                <div class="col-md-8 col-md-pull-1">
                                                    <select class="form-control" name="categoria" id="categoria">
                                                        <?php
                                                        include ("config/conexion.php");
                                                        $registros = mysqli_query($conexion, "select id,nombre from categorias") or
                                                                die("Problemas en el select:" . mysqli_error($conexion));
                                                        while ($reg = mysqli_fetch_array($registros)) {
                                                            echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Ingreso del estado -->
                                            <div class="form-group row">
                                                <label for="estado" class="col-md-2 col-md-offset-1 control-label">Estado:</label>
                                                <div class="col-md-8 col-md-pull-1">
                                                    <select class="form-control" name="estado" id="estado">
                                                        <?php
                                                        include ("config/conexion.php");
                                                        $registros = mysqli_query($conexion, "select id,nombre from estatus order by nombre") or
                                                                die("Problemas en el select:" . mysqli_error($conexion));
                                                        while ($reg = mysqli_fetch_array($registros)) {
                                                            echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
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
                                                        include ("config/conexion.php");
                                                        $registros = mysqli_query($conexion, "select id,nombre from servidores") or
                                                                die("Problemas en el select:" . mysqli_error($conexion));
                                                        while ($reg = mysqli_fetch_array($registros)) {
                                                            echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
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
                                                           value="<?php
                                                        if (isset($_SESSION['nombrecompleto'])) {
                                                            echo $_SESSION['nombrecompleto'];
                                                        }
                                                        ?>"/>
                                                </div>
                                            </div>
                                            	<script src="js/ckeditor/ckeditor.js">
                                                
                                                
                                                    config.extraPlugins = 'autolink';</script>
                                            <!-- Ingreso de la observacion-->
                                            <div class="form-group row">
                                                <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                                                <div class="col-md-12" >
                                                    <textarea id="mitxt" name="observacion" style="resize:none"  rows="10" aria-required="true"></textarea>
                                                    <script  >CKEDITOR.replace('observacion');</script>
                                                    <!--<script type="text/javascript">
                                                //<![CDATA[
                                                CKEDITOR.replace( 'mitxt',
                                                {
                                                         //es la ruta desde public_html hasta el index del plugin
                                                         filebrowserBrowseUrl : '/ckeditor/filemanager/index.php'

                                                });
                                                //]]>
                                                </script>-->
                                                    <!--<script>tinyMCE.init({selector: "textarea", branding: false, plugins: "image,paste,autolink", paste_data_images: true, language: "es"});</script>-->
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

<?php else: echo'Debe iniciar sesión para ingresar a esta página.'; ?>
<?php endif; ?>
                </html>

