<?php
include("conexion.php");
//Filtro General:
if(isset($_POST['general'])){
switch($_POST['general']){
case "todos":
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio;";
break;
case "recientes":
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
ORDER BY fecha DESC;";
break;
case "antiguos":
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
ORDER BY fecha ASC;";
break;
}
}else {
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio;";
}

//Filtro por categorias:
if(isset($_POST['filtroCategoria'])){
$caso = $_REQUEST['filtroCategoria'];
switch($_POST['filtroCategoria']){
case $caso:
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
where categorias.idcategoria = $caso";
break;
}
}

//Filtro por servidores:
if(isset($_POST['filtroServidores'])){
$casoServ = $_REQUEST['filtroServidores'];
switch($_POST['filtroServidores']){
case $casoServ:
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
where servidor.idservidor = $casoServ;";
break;
}
}
//Filtro por dominios:
if(isset($_POST['filtroDominios'])){
$casoDom = $_REQUEST['filtroDominios'];
switch($_POST['filtroDominios']){
case $casoDom:
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
where dominio.iddominio = $casoDom";
break;
}
}
//Filtro por estados:
if(isset($_POST['filtroEstados'])){
$casoEstatus = $_REQUEST['filtroEstados'];
switch($_POST['filtroEstados']){
case $casoEstatus:
$sql = "SELECT *, dominio.nombre as nombredominio, servidor.nombre as nombreservidor, categorias.nombre as nombrecategoria, estatus.nombre as nombrestatus FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN servidor on reporte.idservidor = servidor.idservidor LEFT JOIN dominio on reporte.iddominio = dominio.iddominio
where estatus.idestatus = $casoEstatus";
break;
}
}
?>
<!--Filto General:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="general">Filtro General:</label>
    <select class="form-control" name="general" id="general">
        <option value="todos">Todos</option>
        <option value="recientes">Más recientes</option>
        <option value="antiguos">Más antiguos</option>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Categorias:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroCategoria">Filtro por categorias:</label>
    <select class="form-control" name="filtroCategoria" id="filtroCategoria">
        <?php
        include ("conexion.php");
        $registros=mysqli_query($conexion,"select * from categorias") or
        die("Problemas en el select:".mysqli_error($conexion));
        while ($reg=mysqli_fetch_array($registros)):?>
            <option value="<?php echo $reg['idcategoria']?>"><?php echo $reg['nombre']?></option>
        <?php endwhile;?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>

<!--Form por Servidores:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroServidores">Filtro por servidores:</label>
    <select class="form-control" name="filtroServidores" id="filtroServidores">
        <?php
        include ("conexion.php");
        $registros=mysqli_query($conexion,"select * from servidor") or
        die("Problemas en el select:".mysqli_error($conexion));
        while ($reg=mysqli_fetch_array($registros)):?>
            <option value="<?php echo $reg['idservidor']?>"><?php echo $reg['nombre']?></option>
        <?php endwhile;?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Dominios:-->
<form class="form-group col-md-2" action="reportes.php" method="post">
    <label for="filtroDominios">Filtro por dominios:</label>
    <select class="form-control" name="filtroDominios" id="filtroDominios">
        <?php
        include ("conexion.php");
        $registros=mysqli_query($conexion,"select * from dominio") or
        die("Problemas en el select:".mysqli_error($conexion));
        while ($reg=mysqli_fetch_array($registros)):?>
            <option value="<?php echo $reg['iddominio']?>"><?php echo $reg['nombre']?></option>
        <?php endwhile;?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Estatus:-->
<form class="form-group col-md-3" action="reportes.php" method="post">
    <label for="filtroEstados">Filtro por estados:</label>
    <select class="form-control" name="filtroEstados" id="filtroEstados">
        <?php
        include ("conexion.php");
        $registros=mysqli_query($conexion,"select * from estatus") or
        die("Problemas en el select:".mysqli_error($conexion));
        while ($reg=mysqli_fetch_array($registros)):?>
            <option value="<?php echo $reg['idestatus']?>"><?php echo $reg['nombre']?></option>
        <?php endwhile;?>
    </select>
    <button class="btn btn-info alert-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!-- Comienzo de la Tabla:-->
<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="example"  class="table table-bordered table-hover table-striped">
            <caption class="text-center"><h3>Reporte de Incidencias</h3></caption>
            <thead>
            <tr class="bg-primary text-center">
                <td><h4>ID</h4></td>
                <td><h4>Titulo</h4></td>
                <td><h4>Autor</h4></td>
                <td><h4>Categoria</h4></td>
                <td><h4>Servidor</h4></td>
                <td><h4>Dominio</h4></td>
                <td><h4>Ticket</h4></td>
                <td><h4>Estado</h4></td>
                <td><h4>Fecha</h4></td>
                <td><h4>Acciones</h4></td>
                <!--<td><h4>Eliminar</h4></td>-->
            </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");
            $result = mysqli_query($conexion,$sql);
            $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
            while($columna = mysqli_fetch_array($result)):?>

                <!--while($columna = mysqli_fetch_assoc($result)):?>-->
                <?php $idprotegido=md5($clave.$columna['idreporte']);?>
                <tr class="text-center">
                    <td><h4><?php echo $columna['idreporte']?></h4></td>
                    <td><h4><?php echo $columna['titulo'] ?></h4></td>
                    <td><h4><?php echo $columna['autor'] ?></h4></td>
                    <td><h4><?php echo $columna['nombrecategoria'] ?></h4></td>
                    <td><h4><?php echo $columna['nombreservidor'] ?></h4></td>
                    <td><h4><?php echo $columna['nombredominio'] ?></h4></td>
                    <td><h4><?php echo $columna['ticket'] ?></h4></td>
                    <td><h4><?php echo $columna['nombrestatus'] ?></h4></td>
                    <td><h4><?php echo $columna['fecha'] ?></h4></td>
                    <!--<td><a class="btn btn-warning alert-warning" href="?reporte=<?php //echo $idprotegido;?>">Mostrar</a>-->
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info alert-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="text-align: center">
                                <a class="btn btn-warning alert-warning" href="?reporte=<?php echo $idprotegido;?>">Mostrar</a>
                                <li role="separator" class="divider"></li>
                                <form action="modificarincidencia.php" method="post">
                                    <input class="hidden" name="idreporte" value="<?php echo $columna['idreporte']?>">
                                    <input class="btn btn-info alert-info" type="submit" name="modificar" value="Modificar" />
                                </form>
                                <li role="separator" class="divider"></li>
                                <form action="controles/eliminareporte.php" method="post">
                                    <input class="hidden" name="idreporte" value="<?php echo $columna['idreporte']?>">
                                    <input onclick="return confirm('Estás seguro que deseas eliminar el registro?');" class="btn btn-danger alert-danger" type="submit" name="eliminar" value="Eliminar" />
                                </form>

                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>