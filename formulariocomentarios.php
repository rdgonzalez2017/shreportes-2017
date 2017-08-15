<form class="form fadeInRightBig animated" name="miFormu" method="post" action="controles/cargarcomentario.php">
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
                        <input class="form-control" <?php if (isset($_SESSION['nombre'])) {
        echo "readonly='readonly'";
    } ?> type="text" name="autor_comentario"  value="<?php
                        if (isset($_SESSION['nombre'])) {
                            echo $_SESSION['nombrecompleto'];
                        } else {
                            echo $nombre_cliente_completo;
                        }
                        ?>"/>
                    </div>
                </div>   
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
                <!-- Ingreso del comentario-->
                <div class="form-group row">
                    <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                    <div class="col-md-12">
                        <textarea name="comentario" type="text" required class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <!-- Boton para enviar datos-->
            <div class="panel-footer text-center">
                <input type="submit" class="btn btn-info" value="Enviar comentario">
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['correo'])) {
    $correo_destino = $correo_autor;
} else {
    $correo_destino = $correo_cliente;
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
<input TYPE="hidden" NAME="nombre_dominio" VALUE="<?php echo $nombre_dominio; ?>">
<input TYPE="hidden" NAME="autor_destino" VALUE="<?php echo $autor_destino; ?>">

</form>