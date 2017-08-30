<?php
if (!empty($id_reporte)):
    $select_comentario = mysqli_query($conexion, "SELECT *  FROM $DB.comentarios as A WHERE A.idreporte = '$id_reporte' ORDER BY A.id ASC")
            or die("Problemas en el select:" . mysqli_error($conexion));
    while ($fila = mysqli_fetch_assoc($select_comentario)):
        $autor_comentario = $fila["autor"];
    $select_usuario = mysqli_query($conexion, "SELECT *  FROM $DB.usuarios")
            or die("Problemas en el select:" . mysqli_error($conexion));
        while ($fila_usuario = mysqli_fetch_assoc($select_usuario)):
                    $usuario = $fila_usuario['nombrecompleto'];
        

                    if($usuario==$autor_comentario){
                        $autor_usuario = $usuario ;
                    } 
                   
    endwhile;
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?php
                    //Cambio de color según quien escriba el comentario:
                    if ($autor_usuario == $autor_comentario) {
                        echo 'info';
                    } else {
                             echo 'warning';
                         }
                    ?>
                         panel panel-<?php
                         if  ($autor_usuario == $autor_comentario) {
                             echo 'info';
                         } else {
                             echo 'warning';
                         }
                         ?>
                         ">
                        <!-- Muestra Autor del comentario-->
                        <div class="panel-heading text-center">
                            <div>  <b>Autor: <?php echo $autor_comentario; ?></b></div>
                        </div>
                        <div class="panel-body">
                            <!-- Muestra fecha del comentario-->
                            <div class="form-group">
                                <div class="row">
                                    <label style="text-align:right;" for="fecha" class="col-md-1 control-label">Fecha:</label>                                
                                    <div class="col-md-3"><b> <?php echo $fila["fecha"]; ?> </b></div>
                                </div>
                            </div>                    
                            <!-- Muestra descripción del comentario-->
                            <div class="form-group row">
                                <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" style="resize: none" readonly="readonly" name="observacion" rows="7"> <?php echo $fila["comentario"]; ?>  </textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endwhile;
 endif;