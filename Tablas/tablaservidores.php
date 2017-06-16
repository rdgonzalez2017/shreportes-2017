<div class="row">
    <div class="col-md-6 col-md-offset-3 table-responsive rotateIn animated" data-wow-duration="500ms"">
    <table id="example"  class="table table-bordered table-hover table-striped">
        <caption class="text-center"><h3>Listado de Servidores</h3></caption>
        <thead>
        <tr class="bg-primary text-center">
            <td><h4>ID</h4></td>
            <td><h4>Nombre</h4></td>
            <td><h4>Acción</h4></td>
        </tr>
        </thead>
        <tbody>
        <?php
        include("conexion.php");
        $query = mysqli_query($conexion, "select * from servidor ORDER BY idservidor ASC ")
        or die("Problemas en el insert principal" . mysqli_error($conexion));
        mysqli_close($conexion);
        while($columna = mysqli_fetch_assoc($query)):?>
            <tr class="text-center">
                <td><h5><?php echo $columna['idservidor']?></h5></td>
                <td><h4><?php echo $columna['nombre'] ?></h4></td>

                <td class="text-center">
                    <div class="btn-group">
                        <!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="sistema.php?pag=marcas&idc=<?php// echo base64_encode($columna['idcategoria'])?>">Modificar</a></li>
                                <li role="separator" class="divider"></li>-->
                        <form action="controles/eliminaservidor.php" method="post">
                            <input class="hidden" name="idservidor" value="<?php echo $columna['idservidor']?>">
                            <input onclick="return confirm('Estás seguro que deseas eliminar este Servidor?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
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