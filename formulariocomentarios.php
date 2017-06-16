<form class="form fadeInRightBig animated" name="miFormu" method="post" action="controles/cargarcomentario.php">
    <INPUT TYPE="hidden" NAME="link" VALUE="<?php echo $Link;?>">
    <INPUT TYPE="hidden" NAME="idreporte" VALUE="<?php echo $idreplicacion?>">
    <INPUT TYPE="hidden" NAME="idprotegido" VALUE="<?php echo $idreporte?>">
    <INPUT TYPE="hidden" NAME="correoautor" VALUE="<?php echo $correoautor?>">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <p class="text-center">Formulario de Comentarios</p>
            </div>
            <div class="panel-body">
                <!-- Ingreso del Autor-->
                <div class="form-group row">
                    <label for="nick" class="col-md-2 control-label">Autor:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="nick" id="nick"  value="<?php if (isset($_SESSION['nombrecompleto'])) {echo $_SESSION['nombrecompleto'];}?>" required/>
                    </div>
                </div>
                <!-- Ingreso del Correo del usuario-->
                <div class="form-group row">
                    <label for="correo" class="col-md-2 control-label">Correo:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="email" name="correo" id="correo" value="<?php if (isset($_SESSION['correo'])) {echo $_SESSION['correo'];}?>" required/>
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
                <input type="submit" class="btn btn-info btn-sm" value="Enviar comentario">
            </div>
        </div>
    </div>
    </div>
</form>