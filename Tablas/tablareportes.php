<div class="text-center">
    <?php
    //Contador de Incidencias
    include "config/conexion.php";
    $contador = mysqli_query($conexion, "SELECT COUNT(*) as contador from reportes");
    while ($columna = mysqli_fetch_array($contador)):
        $cantidadincidencias = $columna['contador'];
        ?>
        <div class="row">
            <div class="col-md-3"><?php
                if (isset($_SESSION['nombre'])) {
                    echo "Bienvenido: " . $_SESSION['nombrecompleto'];
                }
                ?>       </div>
            <div class="col-md-3 col-md-offset-2">Cantidad de Incidencias reportadas: <?php echo $cantidadincidencias; ?></div>
        </div>
    <?php endwhile; ?>

</div><br>
<?php
require("config/conexion.php");
require("config/conexion2.php");

//Filtro General:
if (isset($_POST['general'])) {
    switch ($_POST['general']) {
        case "todos":
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
ORDER BY A.id asc ;";
            break;
        case "recientes":
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where A.idestatus <> 1 and A.idestatus <> 5 ORDER BY A.fecha DESC;";
            break;
        case "antiguos":
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where A.idestatus <> 1 and A.idestatus <> 5 ORDER BY A.fecha ASC;";
            break;
    }
} else {
    $sql = "SELECT *,A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where A.idestatus <> 1 and A.idestatus <> 5 ORDER BY A.id asc  ;";
}
//Filtro por ID:
if (isset($_POST['id'])) {
    $caso = $_REQUEST['id'];
    switch ($_POST['id']) {
        case $caso:
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where A.id = $caso";
            break;
    }
}
//Filtro por categorias:
if (isset($_POST['filtroCategoria'])) {
    $caso = $_REQUEST['filtroCategoria'];
    switch ($_POST['filtroCategoria']) {
        case $caso:
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where B.id = $caso and A.idestatus <> 1 and A.idestatus <> 5";
            break;
    }
}
//Filtro por servidores:
if (isset($_POST['filtroServidores'])) {
    $casoServ = $_REQUEST['filtroServidores'];
    switch ($_POST['filtroServidores']) {
        case $casoServ:
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where D.id = $casoServ and A.idestatus <> 1 and A.idestatus <> 5;";
            break;
    }
}
//Filtro por dominios:
if (isset($_POST['filtroDominios'])) {
    $casoDom = $_REQUEST['filtroDominios'];
    switch ($_POST['filtroDominios']) {
        case $casoDom:
            $sql = "SELECT A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where G.iddominio = $casoDom or E.id = $casoDom and A.idestatus <> 1";
            break;
    }
}
//Filtro por estados:
if (isset($_POST['filtroEstados'])) {
    $casoEstatus = $_REQUEST['filtroEstados'];
    switch ($_POST['filtroEstados']) {
        case $casoEstatus:
            $sql = "SELECT *, A.id as id_reporte, G.nombre as nombre_nuevo_dominio, E.domain as nombredominio, D.nombre as nombreservidor, B.nombre as nombrecategoria, C.nombre as nombrestatus FROM $DB.categorias as B RIGHT JOIN $DB.reportes as A on B.id = A.idcategoria LEFT JOIN $DB.estatus as C ON A.idestatus = C.id LEFT JOIN $DB.servidores as D on A.idservidor = D.id LEFT JOIN $DB_2.tbldomains as E on A.id_dominio_registrado = E.id LEFT JOIN $DB.usuarios as F ON A.idusuario = F.id LEFT JOIN $DB.dominios as G ON A.iddominio = G.id
where C.id= $casoEstatus";
            break;
    }
}
?>
<!--Filto General:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="general">Filtro General:</label>
    <select class="form-control" name="general" id="general" required="required">
        <option></option>
        <option value="todos">Todos</option>
        <option value="recientes">Más recientes</option>
        <option value="antiguos">Más antiguos</option>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por ID:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="id">Filtro por ID:</label>
    <input class="form-control" name="id" id="id" placeholder="Ingrese ID" required="required"/>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>

<!--Form por Servidores:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroServidores">Filtro por servidores:</label>
    <select class="form-control" name="filtroServidores" id="filtroServidores" required="required">
        <option></option>
        <?php
        include ("config/conexion.php");
        $registros = mysqli_query($conexion, "select * from servidores") or
                die("Problemas en el select:" . mysqli_error($conexion));
        while ($reg = mysqli_fetch_array($registros)):
            ?>
            <option value="<?php echo $reg['id'] ?>"><?php echo $reg['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Dominios:-->
<!--form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroDominios">Filtro por dominios:</label>
    <select class="form-control" name="filtroDominios" id="filtroDominios">
<?php
//include ("conexion.php");
//$registros=mysqli_query($conexion,"select * from dominio") or
//die("Problemas en el select:".mysqli_error($conexion));
//while ($reg=mysqli_fetch_array($registros)):
?>
            <option value="<?php //echo $reg['iddominio']    ?>"><?php //echo $reg['nombre']    ?></option>
<?php //endwhile; ?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>-->
<!--Form por Estatus:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroEstados">Filtro por estados:</label>
    <select class="form-control" name="filtroEstados" id="filtroEstados" required="required">
        <option></option>
        <?php
        include ("config/conexion.php");
        $registros = mysqli_query($conexion, "select * from estatus") or
                die("Problemas en el select:" . mysqli_error($conexion));
        while ($reg = mysqli_fetch_array($registros)):
            ?>
            <option value="<?php echo $reg['id'] ?>"><?php echo $reg['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--<div class="row">
    <form method="Post" action="controles/recordatorio_seleccionado.php">                         
        <button  type="submit" class="btn btn-warning col-md-2"><b>Enviar recordatorio</b></button>
    </form>                            
</div>-->

    <form action="controles/recordatorio_seleccionado.php" method="post">
        <input  class="btn btn-warning col-md-2 col-md-offset-1" type="submit" name="enviar" value="Enviar Recordatorio" />

<!-- Comienzo de la Tabla:-->
<div class="">
    <div class="col-md-12 ">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Listado de Incidencias</h3></caption>
            <thead>
                <tr class="bg-primary text-center">
                    <td><h4><span class="glyphicon glyphicon-check"></span></h4></td>
                    <td><h4>ID</h5></h4></td>
                    <td><h4>Titulo</h4></td>
                    <td><h4>Autor</h4></td>
                    <td><h4>Categoria</h4></td>
                    <td><h4>Servidor</h4></td>
                    <td><h4>Dominio</h4></td>
                    <td><h4>Ticket</h4></td>
                    <td><h4>Estado</h4></td>
                    <td><h4>Fecha</h4></td>
                    <td><h4>Inactividad</h4></td>
                    <td><h4><span class="	glyphicon glyphicon-th-list"></span></h4></td>

 <!--<td><h4>Eliminar</h4></td>-->
                </tr>
            </thead>
            <tbody>
                <?php
                include("config/conexion.php");
                $result = mysqli_query($conexion, $sql) or die("Problemas con la conexion " . mysqli_error($conexion));
                $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                while ($columna = mysqli_fetch_array($result)):
                    $idprotegido = md5($clave . $columna['id_reporte']);
                    $id_reporte = $columna['id_reporte'];
                    $titulo = $columna['titulo'];
                    $autor = $columna['autor'];
                    $nombre_categoria = $columna['nombrecategoria'];
                    $nombre_servidor = $columna['nombreservidor'];
                    $fecha_creacion = $columna['fecha'];
                    $ticket = $columna['ticket'];
                    $nombre_estatus = $columna['nombrestatus'];
                    if (!empty($columna['nombredominio'])) {
                        $nombre_dominio = $columna['nombredominio'];
                    } else {
                        $nombre_dominio = $columna['nombre_nuevo_dominio'];
                    }
                    if (!empty($columna['fecha_modificacion'])) {
                        $fecha_accion = $columna['fecha_modificacion'];
                    } else {
                        $fecha_accion = $fecha_creacion;
                    }
                    $hoy = date('Y-m-d');
                    $fecha_actividad = $datetime1 = date_create($fecha_accion);
                    $datetime2 = date_create($hoy);
                    $inactividad = date_diff($datetime1, $datetime2);
                    ?>

                    <tr class="text-center">
                        <td><input class="form-control" type="checkbox" value="<?php echo $id_reporte; ?>" name="reportes_seleccionados[]" /></td>     
                        </form>
                        <td><h4><?php echo $id_reporte; ?></h4></td>
                        <td><h4><?php echo $titulo; ?></h4></td>
                        <td><h4><?php echo $autor; ?></h4></td>
                        <td><h4><?php echo $nombre_categoria; ?></h4></td>
                        <td><h4><?php echo $nombre_servidor; ?></h4></td>
                        <td><h4><?php echo $nombre_dominio; ?></h4></td>
                        <td><h4><?php echo $ticket; ?></h4></td>
                        <td><h4><?php echo $nombre_estatus; ?></h4></td>
                        <td><h4><?php echo $fecha_creacion; ?></h4></td>
                        <td><h4><?php echo $inactividad->format('%a') . " Días"; ?></h4></td>
                        <!--<td><a class="btn btn-warning alert-warning" href="?reporte=<?php //echo $idprotegido;    ?>">Mostrar</a>-->
                        <td class="text-center">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " style="text-align: center;">
                                    <a class="btn btn-warning alert-warning" href="?reporte=<?php echo $idprotegido; ?>">Mostrar</a>
                                    <li role="separator" class="divider"></li>
                                    <form action="modificarincidencia.php" method="post">
                                        <input class="hidden" name="idreporte" value="<?php echo $id_reporte; ?>">
                                        <input class="btn btn-info alert-info" type="submit" name="modificar" value="Modificar" />
                                    </form>
                                    <li role="separator" class="divider"></li>
                                    <form action="controles/eliminareporte.php" method="post">
                                        <input class="hidden" name="idreporte" value="<?php echo $id_reporte; ?>">
                                        <input onclick="return confirm('Estás seguro que deseas eliminar el registro?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
   