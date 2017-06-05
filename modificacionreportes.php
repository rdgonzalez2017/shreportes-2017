<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php");?>
<?php
if (isset($_SESSION['nombre'])):
    include ("navbar/navbarsistema.php");
else:
    include ("navbar/navbarindex.php");
endif;
?>
<?php if (isset($_SESSION['nombre'])):?>
<body>
<div class="col-md-8 col-md-offset-2">
<?php
include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos
if(isset($_POST['modificar'])) // Si el boton de "modificar" fúe presionado ejecuta el resto del código
{

    $idreporte = (int) mysql_real_escape_string($_POST['idreporte']);
    $titulo = mysql_real_escape_string($_POST['titulo']);
    $observacion = mysql_real_escape_string($_POST['observacion']);
    $idestatus = (int) mysql_real_escape_string($_POST['estatus']);
    $idcategoria = (int) mysql_real_escape_string($_POST['categoria']);
    $autor = mysql_real_escape_string($_POST['autor']);
    $query_modificar = mysql_query("UPDATE reporte SET titulo = '".$titulo."', observacion = '".$observacion."', idestatus = '".$idestatus."', idcategoria = '".$idcategoria."',  fecha = NOW() WHERE idreporte = '".$idreporte."'"); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if($query_modificar)
    {
        echo 'La noticia se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje
        header("Location:muestra.php");
    }
    else
    {
        echo 'La noticia no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}

if(isset($_GET['reporte']))
{
    $idreporte = (int) mysql_real_escape_string($_GET['reporte']); // Recibimos el id de la noticia por medio de GET
    $query_NoticiaCompleta = mysql_query("SELECT * FROM reporte LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus WHERE idreporte = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
    $columna_MostrarNoticia = mysql_fetch_assoc($query_NoticiaCompleta);
    echo ' 
    <form action="modificareporte.php" method="post"> <!-- Creamos el formulario, utilizando la etiqueta form, cuyo atributo action="" indicará donde se procesará el formulario --> 
        <div style="text-align: center">Id: '.$columna_MostrarNoticia['idreporte'].'</div>
        Título: <input class="form-control" name="titulo" type="text" value="'.$columna_MostrarNoticia['titulo'].'" /> <br/>
        Autor: <input class="form-control" readonly="readonly" name="autor" type="text" value="'.$columna_MostrarNoticia['autor'].'" /> <br/>
        
        Cambiar Estado a: <select class="form-control" name="estatus">
           ';
    include ("conexion.php");
    $registros=mysqli_query($conexion,"select idestatus,nombre from estatus ORDER BY idestatus DESC") or die("Problemas en el select:".mysqli_error($conexion));
    while ($reg=mysqli_fetch_array($registros)) {
        echo "<option value=\"$reg[idestatus]\">$reg[nombre]</option>";
    }
    echo '
            </select>
            Estado: '.$columna_MostrarNoticia['idestatus'].' <br/>
           Cambiar Categoria a: <select class="form-control" name="categoria">
           ';
    include("conexion.php");
    $registros=mysqli_query($conexion,"select idcategoria,nombre from categorias ORDER BY idcategoria DESC") or die("Problemas en el select:".mysqli_error($conexion));
    while ($reg=mysqli_fetch_array($registros)) {
        echo "<option value=\"$reg[idcategoria]\">$reg[nombre]</option>";
    }
    echo '
            </select>
        Observacion:  <textarea name="observacion">'.$columna_MostrarNoticia['observacion'].'</textarea>
        <script>tinyMCE.init({selector: "textarea",branding: false,plugins: "image,paste",paste_data_images: true});</script>
         <br/>    
        <input type="hidden" name="idreporte" value="'.$columna_MostrarNoticia['idreporte'].'" /> <!-- Creamos un campo de texto oculto para pasar el id de la noticia -->
        <br>
        <div class="row text-center">
        <input class="btn btn-warning" type="submit" name="modificar" value="Modificar Reporte" />
        </div>
    </form> 
    <br>
    ';
}

$query_MostrarTitulos = mysql_query("SELECT idreporte, titulo, observacion, fecha FROM reporte ORDER by idreporte DESC"); // Ejecutamos la consulta
while($columna_MostrarTitulos = mysql_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
{
    echo '<div class="row well text-center">';
    echo '<a href="?reporte='.$columna_MostrarTitulos['idreporte'].'">
    Modificar este reporte:</a> ';   // Mostramos un enlace para modificar cada noticia
    $idreporte = $columna_MostrarTitulos['idreporte'];
    echo $idreporte;
    echo '</div>';
}
?>
</div>
</body>
<?php else: echo"Debe iniciar sesión para ingresar a esta página";
endif;?>
</html>
