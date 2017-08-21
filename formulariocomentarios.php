<?php
//Se realiza un select para obtener los datos del cliente:
require ('config/conexion2.php');
$select_cliente = mysqli_query($conexion, "select * from tblclients where id = '$id_cliente' ")
        or die("Problemas en el select" . mysqli_error("$conexion"));
$fila = mysqli_fetch_array($select_cliente);
$correo_cliente = $fila['email'];
$nombre_cliente = $fila['firstname'];
$apellido_cliente = $fila['lastname'];
$nombre_cliente_completo = $nombre_cliente . " " . $apellido_cliente;
?>

<div class="row">
    <form class="form fadeInRightBig animated" name="miFormu" method="post" action="controles/cargarcomentario.php">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center"><u>Formulario de Comentarios</u></h4>                
                </div>
                <div class="panel-body">
                    <!-- Autor del comentario-->
                    <div class="form-group row">
                        <label for="autor_comentario" class="col-md-2 control-label">Autor:</label>
                        <div class="col-md-8 col-lg-pull-1">
                            <input class="form-control" <?php
                            if (isset($_SESSION['nombre'])) {
                                echo "readonly='readonly'";
                            }
                            ?> type="text" name="autor_comentario"  value="<?php
                                   if (isset($_SESSION['nombre'])) {
                                       echo $_SESSION['nombrecompleto'];
                                   } else {
                                       echo $nombre_cliente_completo;
                                   }
                                   ?>"/>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['nombre'])): ?>
                        <!-- Para quien va dirigido el comentario-->
                        <div class="form-group row">
                            <label for="para" class="col-md-2 control-label">Para:</label>
                            <div class="col-md-8 col-lg-pull-1">
                                <input class="form-control" readonly="readonly" type="text" name="para"  value="<?php
                                if (isset($_SESSION['nombre'])) {
                                    echo $nombre_cliente_completo . " (" . $correo_cliente . ")";
                                } else {
                                    echo $autor . " (" . $correo_autor . ")";
                                }
                                ?>"/>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Ingreso del comentario-->
                    <div class="form-group row">
                        <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                        <div class="col-md-12">
                            <textarea name="comentario" placeholder="Ingrese comentario" type="text" required class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['nombre'])): ?>
                        <!-- Selección del estado-->
                        <div class="form-group row">
                            <label style="text-align:right;" for="id_estatus" class="col-md-3 control-label">Estado:</label>
                            <div class="col-md-6">
                                <?php
                                include("config/conexion.php");
                                //Selecciona el valor que ya está seleccionado
                                $valor_previo = mysqli_query($conexion, "select * from estatus as B RIGHT JOIN reportes as A on A.idestatus = B.id where A.id = '" . $id_reporte . "'")
                                        or die("Problemas en el select:" . mysqli_error($conexion));
                                while ($columna_estatus = mysqli_fetch_array($valor_previo)) :
                                    $valorDefinido = $columna_estatus['nombre'];

                                    //Selecciona todos los valores de la base de datos
                                    $registros = mysqli_query($conexion, "select * from estatus")
                                            or die("Problemas en el select:" . mysqli_error($conexion));
                                    $combo = '<select class="form-control" name="id_estatus" >\n';
                                    //Función para que aparezca predeterminado el valor que ya está seleccionado previamente.
                                    while ($reg = mysqli_fetch_array($registros)) {
                                        $selected = '';
                                        if ($valorDefinido == $reg['nombre']) {
                                            $selected = 'selected';
                                        }
                                        $combo .= '<option value="' . $reg['id'] . '"" ' . $selected . '>' . $reg['nombre'] . '</option>\n';
                                    }
                                    $combo .= "</select>";
                                    echo $combo;
                                endwhile;
                                ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- Boton para enviar datos-->
                <div class="panel-footer text-center">
                    <input type="submit" class="btn btn-info" value="Enviar comentario">
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['nombre'])) {
            $correo_destino = $correo_cliente;
        } else {
            $correo_destino = $correo_autor;
        }
        if (isset($_SESSION['nombre'])) {
            $autor_destino = $nombre_cliente_completo;
        } else {
            $autor_destino = $autor;
        }
        ?>
        <input TYPE="hidden" NAME="link" VALUE="<?php echo $Link; ?>">
        <input TYPE="hidden" NAME="id_reporte" VALUE="<?php echo $id_reporte; ?>">
        <input TYPE="hidden" NAME="id_protegido" VALUE="<?php echo $id_protegido; ?>">
        <input TYPE="hidden" NAME="correo_destino" VALUE="<?php echo $correo_destino; ?>">
        <input TYPE="hidden" NAME="correo_autor" VALUE="<?php echo $correo_autor; ?>">
        <input TYPE="hidden" NAME="nombre_dominio" VALUE="<?php echo $nombre_dominio; ?>">
        <input TYPE="hidden" NAME="autor_destino" VALUE="<?php echo $autor_destino; ?>">

    </form>
</div>

