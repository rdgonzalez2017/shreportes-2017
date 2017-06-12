<!-- Tabla de Reportes -->
<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Vista Previa:</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Titulo</h4></td>
                <td><h4>Autor</h4></td>
                <td><h4>Categoria</h4></td>
                <td><h4>Estado</h4></td>
                <td><h4>Fecha</h4></td>
                <td><h4>Acción</h4></td>
                <!--<td><h4>Aciones</h4></td>-->
            </tr>
            </thead>
            <tbody>
            <?php
            $select = "SELECT *, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus order by idreporte desc limit 1";
            $query_reportes = mysqli_query($conexion,"$select")
            or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta
            $limite = 100; // Número de carácteres a mostrar antes de el "Leer más"
            $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
            while($columna = mysqli_fetch_assoc($query_reportes)):?>
            <?php $idprotegido=md5($clave.$columna['idreporte']);?>
            <tr class="text-center">
                <td><h4><?php echo $columna['idreporte']?></h4></td>
                <td><h4><?php echo $columna['titulo'] ?></h4></td>
                <td><h4><?php echo $columna['autor'] ?></h4></td>
                <td><h4><?php echo $columna['nombrecategoria'] ?></h4></td>
                <td><h4><?php echo $columna['nombrestatus'] ?></h4></td>
                <td><h4><?php echo $columna['fecha'] ?></h4></td>
                <td><a class="btn btn-warning" href="?reporte=<?php echo $idprotegido;?>">Mostrar Incidencia</a><br><br></td>

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
            </tbody>


        </table>
    </div>
</div>
<?php endwhile;?>