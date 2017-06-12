<!-- Seccion de comentarios-->
<?php
if(!empty($idreporte)):
    $resultComen = mysqli_query($conexion,"SELECT *  FROM comentarios WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' ORDER BY id DESC")
    or die("Problemas en el select:".mysqli_error($conexion));
    while($rowComen = mysqli_fetch_assoc($resultComen))
    {
        ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <!-- Muestra Autor del comentario-->
                <div class="panel-heading text-center">
                    <div> Autor: <?php echo $rowComen["nick"]; ?> </div>
                </div>
                <div class="panel-body">
                    <!-- Muestra fecha del comentario-->
                    <div class="form-group row">
                        <label for="fecha" class="col-md-2 control-label">Fecha:</label>
                        <div class="col-md-8">
                            <div> <?php echo $rowComen["fecha"]; ?> </div>
                        </div>
                    </div>
                    <!-- Muestra correo del autor-->
                    <div class="form-group row">
                        <label for="fecha" class="col-md-2 control-label">Correo:</label>
                        <div class="col-md-8">
                            <div> <?php echo $rowComen["correo"]; ?> </div>
                        </div>
                    </div>
                    <!-- Muestra descripción del comentario-->
                    <div class="form-group row">
                        <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                        <div class="col-md-12">
                            <textarea class="form-control" style="resize: none" readonly="readonly" name="observacion" rows="5"> <?php echo $rowComen["comentario"]; ?>  </textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

endif;
?>