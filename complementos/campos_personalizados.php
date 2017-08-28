<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
    <?php
    if (isset($_SESSION['nombre'])):
        include ("navbar/navbarsistema.php");
    else:
        include ("navbar/navbarindex.php");
    endif;
    ?>
    <?php if (isset($_SESSION['nombre'])): ?>
        <?php
        if (isset($_SESSION['nombre'])) {
            echo "Bienvenido: " . $_SESSION['nombre'];
        }
        ?>
        <body>
            <!-- Formulario para envío de datos del sistema-->
            <form class="form bounceInDown animated" method = "post" action="../controles/cargarestado.php">
                <div class="col-md-8 col-md-offset-2" style="font-size:16px;">
                    <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="text-center">Nuevo campo personalizable</h4>
                        </div>
                        <div class="panel-body">
                            <!-- Ingreso del nombre del campo:-->
                            <div class="form-group row">
                                <label for="nombre" class="col-md-3 col-md-offset-1 control-label text-center">Nombre:</label>
                                <div class="col-md-7 col-md-pull-1">
                                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del campo" required/>
                                </div>
                            </div>
                            <!-- Tipo de campo-->                            
                            <div class="form-group row">
                                <label for="tipo" class="col-md-3 col-md-offset-1 control-label">Tipo de campo:</label>
                                <div class="col-md-3 col-md-pull-1">
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="1">Area de texto</option>
                                        <option value="1">Campo de texto</option>
                                        <option value="1">Link/URL</option>
                                        <option value="2">Desplegable</option>
                                        <option value="1">Casilla de verificación</option>
                                        <option value="3">Contraseña</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Ingreso de descripción-->                            
                            <div class="form-group row" >
                                <label for="descripcion" class="col-md-3 control-label text-right">Descripción:</label>
                                <div class="col-md-7">   
                                    <input class="form-control" name="descripcion" placeholder="Ingrese descripción">
                                </div>
                            </div>
                             <!-- Ingreso de validación-->                            
                            <div class="form-group row" >
                                <label for="validacion" class="col-md-3 control-label text-right">Validación:</label>
                                <div class="col-md-7">   
                                    <input class="form-control" name="validacion" placeholder="Expresiones regulares">
                                </div>
                            </div>
                             <!-- Opciones del desplegable-->                            
                            <div class="form-group row" >
                                <label for="opciones_desplegable" class="col-md-3 control-label text-right">Opciones del desplegable:</label>
                                <div class="col-md-7">   
                                    <input class="form-control" name="opciones_desplegable" placeholder="Sólo para desplegables">
                                </div>
                            </div>
                             <!-- Vicualización del campo:-->
                             <div class="form-group row" >
                            <label for="visualizacion" class="col-md-3 control-label text-right">Visualización:</label>
                                <div class="col-md-8">   
                                    <div class="col-md-5">
                                        <label class="radio-inline" ><input type="radio" name="visualizacion" id="visualizacion"  value="1" checked/>Solo administradores</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="radio-inline"><input type="radio" name="visualizacion" id="visualizacion"  value="0"/>Administradores y clientes</label>
                                    </div>
                                </div>
                             </div>
                             <!-- Verficación campo obligatorio:-->
                             <div class="form-group row" >                            
                                  
                                    <div class="col-md-4 col-md-offset-5">
                                        <label class="checkbox-inline" ><input type="checkbox" name="visualizacion" id="visualizacion"  value="1" checked/>Campo obligatorio</label>
                                    </div>
                                    
                            
                             </div>
                        </div>
                        <!-- Boton para enviar datos-->
                        <div class="panel-footer text-center">
                            <input type="submit" class="btn btn-warning" value="Agregar"></input>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 rotateIn animated" data-wow-duration="500ms" >
                    <table id="example"  class="table table-bordered table-hover table-striped">
                        <caption class="text-center"><h3>Listado de Estados</h3></caption>
                        <thead>
                            <tr class="bg-primary text-center">
                                <td><h4>ID</h4></td>
                                <td><h4>Nombre</h4></td>
                                <td><h4>Vencimiento</h4></td>
                                <td><h4>Comentarios</h4></td>
                                <td><h4>Acción</h4></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../config/conexion.php");
                            $query_reportes = mysqli_query($conexion, "select * from estatus ORDER BY id ASC ")
                                    or die("Problemas en el insert principal" . mysqli_error($conexion));
                            mysqli_close($conexion);
                            while ($columna = mysqli_fetch_assoc($query_reportes)):
                                $id_estatus = $columna['id'];
                                $nombre_estatus = $columna['nombre'];
                                $vencimiento = $columna['vencimiento'];
                                $permitir_comentarios = $columna['permitir_comentarios'];
                                ?>
                                <tr class="text-center" style="font-size:18px;">
                            <form action="../controles/actualizar_estado.php" method="Post">
                                <td class="col-md-1"><h4><?php echo $id_estatus; ?></h4></td>
                                <td class="col-md-3" ><input style="font-size:18px;"  name="nombre_estatus" class="form-control text-center" value="<?php echo $nombre_estatus; ?>"/></td>
                                <td class="col-md-1"><input style="font-size:18px;" name="vencimiento" class="form-control text-center" value="<?php echo $vencimiento; ?>"/>Días</td>
                                <td class="col-md-1"><select style="font-size:18px;" class="form-control text-center" name="permitir_comentarios">
                                        <option value="0"<?php
                                        if ($permitir_comentarios == 0) {
                                            echo " selected";
                                        }
                                        ?>>No</option>
                                        <option value="1"<?php
                                        if ($permitir_comentarios == 1) {
                                            echo " selected";
                                        }
                                        ?>>Si</option>
                                    </select>
                                </td>

                                <td class="col-md-1 text-center" >
                                    <div class="btn-group dropdown" > 
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu " style="text-align: center;">   
                                            <input class="hidden" name="id_estatus" value="<?php echo $id_estatus; ?>">
                                            <input class="btn btn-warning alert-warning" type="submit" name="modificar" value="Modificar" />
                                            </form>
                                            <li role="separator" class="divider"></li>
                                            <form action="../controles/eliminaestatus.php" method="post">
                                                <input class="hidden" name="idestatus" value="<?php echo $id_estatus; ?>">
                                                <input onclick="return confirm('Estás seguro que deseas eliminar este Estatus?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                            </form>
                                        </ul>                                       
                                    </div>                                        
                                </td>
                                </tr>

    <?php endwhile; ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </body>
<?php else: echo'Debe iniciar sesión para ingresar a esta página.'; ?>
<?php endif; ?>
</html>