<div class="row">
    <div class="col-md-6 col-md-offset-3 table-responsive">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Listado de Estados</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Nombre</h4></td>
                <!--<td><h4>Aciones</h4></td>-->
            </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");
            $query_reportes = mysqli_query($conexion, "select * from estatus ORDER BY idestatus DESC ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
            mysqli_close($conexion);
            while($columna = mysqli_fetch_assoc($query_reportes)):?>
                <tr class="text-center">
                    <td><h5><?php echo $columna['idestatus']?></h5></td>
                    <td><h4><?php echo $columna['nombre'] ?></h4></td>
                    <!--
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="sistema.php?pag=marcas">Eliminar</a></li>
                            </ul>
                        </div>
                    </td>-->
                </tr>
            <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>