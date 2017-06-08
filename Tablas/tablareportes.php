



<div class="row">
    <div class="col-md-12 table-responsive flipInX animated animated" data-wow-duration="500ms"">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Modificación de Incidencias</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Titulo</h4></td>
                <td><h4>Autor</h4></td>
                <td><h4>Categoria</h4></td>
                <td><h4>Estado</h4></td>
                <td><h4>Fecha</h4></td>
                <td><h4>Modificar</h4></td>
                <!--<td><h4>Eliminar</h4></td>-->
            </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");
            $query_reportes = mysqli_query($conexion, "SELECT *, estatus.nombre as nombrestatus, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus  ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
            mysqli_close($conexion);
            while($columna = mysqli_fetch_assoc($query_reportes)):?>
                <?php $idprotegido=md5($clave.$columna['idreporte']);?>
                <tr class="text-center">
                    <td><h4><?php echo $columna['idreporte']?></h4></td>
                    <td><h4><?php echo $columna['titulo'] ?></h4></td>
                    <td><h4><?php echo $columna['autor'] ?></h4></td>
                    <td><h4><?php echo $columna['nombrecategoria'] ?></h4></td>
                    <td><h4><?php echo $columna['nombrestatus'] ?></h4></td>
                    <td><h4><?php echo $columna['fecha'] ?></h4></td>
                    <td><a class="btn btn-warning alert-warning" href="?reporte=<?php echo $columna['idreporte']?>">Modificar</a></td>

                    <!--<td class="text-center">
                        <div class="btn-group">
                            <!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <!--<ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>
                                <form action="controles/eliminareporte.php" method="post">
                                    <input class="hidden" name="idreporte" value="<?php// echo $columna['idreporte']?>">
                                    <input onclick="return confirm('Estás seguro que deseas eliminar el registro?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                </form>
                            <!--</ul>
                        </div>
                    </td>-->
                </tr>
            <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>