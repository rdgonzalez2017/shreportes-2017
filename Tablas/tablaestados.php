<div class="row">
    <div class="col-md-6 col-md-offset-3 table-responsive rotateIn animated" data-wow-duration="500ms">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Listado de Estados</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Nombre</h4></td>
                <td><h4>Acción</h4></td>
            </tr>
            </thead>
            <tbody>
            <?php
            include("config/conexion.php");
            $query_reportes = mysqli_query($conexion, "select * from estatus ORDER BY id DESC ")
            or die("Problemas en el insert principal" . mysqli_error($conexion));
            mysqli_close($conexion);
            while($columna = mysqli_fetch_assoc($query_reportes)):?>
                <tr class="text-center">
                    <td><h5><?php echo $columna['id']?></h5></td>
                    <td><h4><?php echo $columna['nombre'] ?></h4></td>

                    <td class="text-center">
                        <div class="btn-group">
                            <!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>-->
                    <form action="controles/eliminaestatus.php" method="post">
                        <input class="hidden" name="idestatus" value="<?php echo $columna['id']?>">
                        <input onclick="return confirm('Estás seguro que deseas eliminar este Estatus?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                    </form>
                    <!--</ul>-->
                        </div>
                        </td>
                </tr>
            <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>