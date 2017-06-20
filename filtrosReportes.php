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
?>
<!--Filto General:-->
<form class="form-group col-md-2" action="filtros.php" method="post">
    <label for="general">Filtro General:</label>
    <select class="form-control" name="general" id="general">
        <option value="todos">Todos</option>
        <option value="recientes">Más recientes</option>
        <option value="antiguos">Más antiguos</option>
    </select>
    <button class="btn btn-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Categorias:-->
<form class="form-group col-md-2" action="filtros.php" method="post">
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
    <button class="btn btn-info col-md-offset-3" type="submit">Filtrar</button>
</form>

<!--Form por Servidores:-->
<form class="form-group col-md-2" action="filtros.php" method="post">
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
    <button class="btn btn-info col-md-offset-3" type="submit">Filtrar</button>
</form>
<!--Form por Dominios:-->
<form class="form-group col-md-2" action="filtros.php" method="post">
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
    <button class="btn btn-info col-md-offset-3" type="submit">Filtrar</button>
</form>