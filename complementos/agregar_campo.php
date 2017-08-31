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
            <div class="row">

                <!-- Formulario para envío de datos del sistema-->
                <form class="form bounceInDown animated" method = "post" action="../controles/insertar_campo.php">
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
                                    <label for="tipo" class="col-md-3 control-label text-right">Tipo de campo:</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tipo" id="tipo">
                                            <?php
                                            require ("../config/conexion.php");
                                            $registros = mysqli_query($conexion, "SELECT * FROM tipo_campos") or
                                                    die("Problemas en el select:" . mysqli_error($conexion));
                                            while ($reg = mysqli_fetch_array($registros)) {
                                                echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Ingreso de descripción-->                            
                                <div class="form-group row" >
                                    <label for="descripcion" type="text" class="col-md-3 control-label text-right">Descripción:</label>
                                    <div class="col-md-7">   
                                        <input class="form-control" type="text" name="descripcion" placeholder="Ingrese descripción">
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
                                    <label for="opciones_desplegables" class="col-md-3 control-label text-right">Opciones del desplegable:</label>
                                    <div class="col-md-7">   
                                        <input class="form-control" name="opciones_desplegables" placeholder="Sólo para desplegables">
                                    </div>
                                </div>
                                <!-- Vicualización del campo:-->
                                <div class="form-group row" >
                                    <label for="visualizacion" class="col-md-3 control-label text-right">Visualización:</label>
                                    <div class="col-md-8">   
                                        <div class="col-md-5">
                                            <label class="radio-inline" ><input type="radio" name="visualizacion" id="visualizacion"  value="0" checked/>Solo administradores</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-inline"><input type="radio" name="visualizacion" id="visualizacion"  value="1"/>Administradores y clientes</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Verficación campo obligatorio:-->
                                <div class="form-group row" >
                                    <div class="col-md-4 col-md-offset-5">
                                        <label class="checkbox-inline" ><input type="checkbox" name="campo_obligatorio" id="campo_obligatorio"  value="1" checked/>Campo obligatorio</label>
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
            </div>            
            <div class="col-md-12 animated fadeIn">
                <table id="example"  class="table table-bordered table-hover table-striped">
                    <caption class="text-center"><h3>Listado de campos personalizables</h3></caption>
                    <thead>
                        <tr class="bg-primary text-center">
                            <td><h4>Id</h4></td>
                            <td><h4>Nombre</h4></td>
                            <td><h4>Tipo</h4></td>
                            <td><h4>Descripción</h4></td>                                    
                            <td><h4>Validación</h4></td>
                            <td><h4>Campos del desplegable</h4></td>
                            <td><h4>Visualización</h4></td>
                            <td><h4>Obligatorio</h4></td>
                            <td><h4>Acción</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../config/conexion.php");
                        $query_reportes = mysqli_query($conexion, "select * from campos_personalizables")
                                or die("Problemas en el insert principal" . mysqli_error($conexion));
                        mysqli_close($conexion);
                        while ($columna = mysqli_fetch_assoc($query_reportes)):
                            $id = $columna['id'];
                            $id_tipo = $columna['id_tipo'];
                            $nombre = $columna['nombre'];
                            $descripcion = $columna['descripcion'];
                            $validacion = $columna['validacion'];
                            $opciones_desplegable = $columna['opciones_desplegable'];
                            $visualizacion = $columna['visualizacion'];
                            $campo_obligatorio = $columna['campo_obligatorio'];
                            ?>
                            <tr class="text-center">
                        <form action="../controles/actualizar_campo.php" method="Post">
                            <input  name="id_campo" type="hidden" value="<?php echo $id; ?>"/>
                            <td class="col-md-1"><?php echo $id; ?></td>
                            <td class="col-md-2" ><input  name="nombre" class="form-control text-center" value="<?php echo $nombre; ?>"/></td>
                                    <td class="col-md-2" >
                                <?php 
                                //Selecciona el valor que ya está seleccionado
                                include  '../config/conexion.php';
                                $tipo_previo=mysqli_query($conexion,"select B.nombre from campos_personalizables as A LEFT JOIN tipo_campos as B on A.id_tipo = B.id where A.id = '".$id."'")
                                or die("Problemas en el select:".mysqli_error($conexion));
                                while ($fila=mysqli_fetch_array($tipo_previo)) :
                                    $tipo_definido = $fila['nombre'];

                                    //Selecciona todos los valores de la base de datos
                                    $registros=mysqli_query($conexion,"select * from tipo_campos")
                                    or die("Problemas en el select:".mysqli_error($conexion));
                                    $combo = '<select class="form-control" name="id_tipo" >\n';
                                    //Función para que aparezca predeterminado el valor que ya está seleccionado previamente.
                                    while ($reg=mysqli_fetch_array($registros)) {
                                        $selected = '';
                                        if ($tipo_definido == $reg['nombre']){
                                            $selected = 'selected';
                                        }
                                        $combo .= '<option value="'.$reg['id'].'"" '.$selected.'>'.$reg['nombre'].'</option>\n';
                                    }
                                    $combo .= "</select>";
                                    echo $combo;
                                endwhile;
                                ?>
                            </td>
                            <td class="col-md-2"><input  name="descripcion" class="form-control text-center" value="<?php echo $descripcion; ?>"/></td>
                            <td class="col-md-1"><input  name="validacion" class="form-control text-center" value="<?php echo $validacion; ?>"/></td>
                            
                            <td class="col-md-2">
                                <?php if ($id_tipo==5):?>
                                <select readonly="readonly" class="form-control text-center">
                                        <?php
                                         include  '../config/conexion.php';
                                        $select_opciones=mysqli_query($conexion,"select * from opciones_desplegables where id_campo_personalizable = '$id'")
                                        or die("Problemas en el select:".mysqli_error($conexion));
                                while ($fila = mysqli_fetch_array($select_opciones)):?>
                                    <option><?php echo $opcion=$fila['nombre']; ?></option>
                                <?php endwhile;?>                                   
                                </select>
                                <?php endif;?>
                            </td>
                            <td class="col-md-2">
                                <select class="form-control text-center" name="visualizacion">
                                    <option value="0"<?php
                                    if ($visualizacion == 0) {
                                        echo " selected";
                                    }
                                    ?>>Sólo administradores</option>
                                    <option value="1"<?php
                                    if ($visualizacion == 1) {
                                        echo " selected";
                                    }
                                    ?>>Administradores y clientes</option>
                                </select>
                            </td>
                            <td class="col-md-1"><select class="form-control text-center" name="campo_obligatorio">
                                    <option value="0"<?php
                                    if ($campo_obligatorio == 0) {
                                        echo " selected";
                                    }
                                    ?>>No</option>
                                    <option value="1"<?php
                                    if ($campo_obligatorio == 1) {
                                        echo " selected";
                                    }
                                    ?>>Si</option>
                                </select>
                            </td>
                            <td class="col-md-1 text-center" >
                                <div class="btn-group dropdown" > 
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " style="text-align: center;">   
                                        <input class="hidden" name="id_estatus" value="<?php echo $id; ?>">
                                        <input class="btn btn-info alert-info" type="submit" name="grabar" value="Grabar" />
                                        </form>
                                        <li role="separator" class="divider"></li>
                                        <form action="../controles/eliminar_campo.php" method="post">
                                            <input class="hidden" name="id_campo" value="<?php echo $id; ?>">
                                            <input onclick="return confirm('Estás seguro que deseas eliminar este campo?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
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