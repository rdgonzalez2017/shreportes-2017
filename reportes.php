<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include ("head.php");?>
<header>
    <?php
    if (isset($_SESSION['nombre'])):
        include ("navbar/navbarsistema.php");
    else:
        include ("navbar/navbarindex.php");
    endif;
    ?>
</header>
<body>
<div class="row col-md-12">

    <!-- Muestra Previa del Reporte -->
    <section>
        <!-- Seccion que muestra la publicacion final del reporte-->
        <?php
        include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
        if(isset($_GET['reporte']))
        {
        if(!empty($_GET['reporte'])) // Si el valor de "noticia" no es NULL, continua con el proceso
        {
        $idreporte = $_GET["reporte"];
        $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
        $select = "SELECT *, usuarios.correo as correoautor, dominio.nombre as nombredominio, estatus.nombre as nombrestatus, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus LEFT JOIN usuarios ON reporte.idusuario LEFT JOIN dominio ON reporte.iddominio = dominio.iddominio  = usuarios.idusuario WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1";
        $query_reportes = mysqli_query($conexion,"$select") // Ejecutamos la consulta
        or die("Problemas en el select:".mysqli_error($conexion));
        //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
        if(mysqli_num_rows($query_reportes) > 0) // Si existe la noticia, la muestra
        {
        while($columna = mysqli_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
        {
        $categoria =  $columna['nombrecategoria'];
        $dominio =  $columna['nombredominio'];
        $titulo =  $columna['titulo'];
        $autor =  $columna['autor'];
        $fecha =  $columna['fecha'];
        $observacion =  $columna['observacion'];
        $idreplicacion =  $columna['idreporte'];
        $correoautor =  $columna['correoautor'];
        $idestatus =  $columna['idestatus'];
        $estatus =  $columna['nombrestatus'];
        $ticket =  $columna['ticket'];
            //Con esto se obtiene el Link de la página:
        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        ob_start();
        echo $host,$url;
        $Link = ob_get_contents();
        ob_end_clean();
        //Panel que muestra el Reporte Final:
        echo'
                             <div class="panel panel-primary container col-md-6 col-md-offset-3 rollIn animated" data-wow-duration="3000ms"">
                                
                                    <div class="panel-heading row" style="background: orange">
                                        <h4 class="text-center">Incidencia</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="titulo" class="col-md-3 col-md-offset-2 control-label">Titulo:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $titulo; echo' </div>            
                                        </div>
                                        <div class="row">
                                            <label for="categoria" class="col-md-3 col-md-offset-2 control-label">Categoría:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $categoria; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="dominio" class="col-md-3 col-md-offset-2 control-label">Dominio:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $dominio; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="ticket" class="col-md-3 col-md-offset-2 control-label">Ticket:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $ticket; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha" class="col-md-3 col-md-offset-2 control-label">Fecha:</label>
                                                <div class="col-md-7 col-md-pull-1">'; echo $fecha; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="autor" class="col-md-3 col-md-offset-2 control-label">Autor:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $autor; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="estado" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $estatus; echo' </div>
                                        </div>
                                    </div>
                           </div>
                           
                                        <div class="row">
                                            <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                                        <div class="col-md-10 col-md-offset-1 well bounceIn animated animated" data-wow-duration="3000ms" " style="overflow-y: auto;">'; echo $observacion; echo' </div>

                                        </div>
                                            ';
        if ($idestatus <> 1):?>
        <BR>
        <!-- Formulario para envío de comentarios-->
        <?php include ("formulariocomentarios.php");?>
<?php endif;?>
<?php
}
}
else
{
    echo ''; // Si no, muestra un error
}
}
else
{
    echo 'Debes seleccionar una noticia.'; // Si GET no recibe ningún valor, muestra un error
}
//Comentarios:
}
else
{
        if (isset($_SESSION['nombre'])):

            include "tablas/tablareportes.php";
        ?>


        <?php
    else: echo"Debe iniciar sesión para ingresar a esta página";
    endif;

}
?>

</section>
</div>

<section>
    <br><br>
    <!-- Muestra los comentarios-->
    <?php include ("muestracomentario.php")?>
</section>
</body>
<?php include("footer.php");?>
</html>