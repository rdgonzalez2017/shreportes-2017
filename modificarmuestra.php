<!DOCTYPE html>
<html>
<?php include ("head.php");?>
<?php
include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos

if(isset($_POST['modificar'])) // Si el boton de "modificar" fúe presionado ejecuta el resto del código
{

    $idreporte = ($_POST['idreporte']);
    $titulo = ($_POST['titulo']);
    $observacion = ($_POST['observacion']);
    $idestatus = ($_POST['estatus']);
    $idcategoria = ($_POST['categoria']);
    $autor = ($_POST['autor']);
    $query_modificar = mysqli_query($conexion,"UPDATE reporte SET titulo = '".$titulo."', observacion = '".$observacion."', idestatus = '".$idestatus."', idcategoria = '".$idcategoria."',  fecha = NOW() WHERE idreporte = '".$idreporte."'")
    or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if($query_modificar)
    {
        echo "<script>location.href='muestra.php';</script>";
        //header("Location:reportes.php");
    }
    else
    {
        echo 'La noticia no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}

if(isset($_GET['reporte'])):
    $idreporte = ($_GET['reporte']); // Recibimos el id de la noticia por medio de GET
    $query_NoticiaCompleta = mysqli_query($conexion,"SELECT * FROM reporte LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus WHERE idreporte = '".$idreporte."' LIMIT 1")
    or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta
    $columna_MostrarNoticia = mysqli_fetch_assoc($query_NoticiaCompleta);?>

    <!-- Formulario para envío de modificaciones al sistema-->
    <form class="form" method = "post" action="modificarmuestra.php">
        <input class="hidden" name="idreporte" id="idreporte" value="<?php echo $columna_MostrarNoticia['idreporte'];?>"/>
        <div class="col-md-12">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">Incidencia ID: <?php echo $columna_MostrarNoticia['idreporte'];?></h4>
                </div>
                <div class="panel-body">
                    <!-- Ingreso del titulo-->
                    <div class="form-group row">
                        <label for="titulo" class="col-md-2 col-md-offset-2 control-label">Titulo:</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo $columna_MostrarNoticia['titulo'];?>"/>
                        </div>
                    </div>
                    <!-- Ingreso del autor-->
                        <div class="form-group row">
                            <label for="autor" class="col-md-2 col-md-offset-2 control-label">Autor:</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="autor" id="autor" value="<?php echo $columna_MostrarNoticia['autor'];?>"/>
                            </div>
                        </div>
                            <!-- Ingreso de la categoría-->
                                <div class="form-group row">
                                    <label for="categoria" class="col-md-2 col-md-offset-2 control-label">Categoria:</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="categoria">
                                        <?php
                                        include("conexion.php");
                                        $registros=mysqli_query($conexion,"select idcategoria,nombre from categorias ORDER BY idcategoria DESC")
                                        or die("Problemas en el select:".mysqli_error($conexion));
                                        while ($reg=mysqli_fetch_array($registros)) :?>
                                         <option value="<?php echo $reg['idcategoria']?>"><?php echo $reg['nombre']?></option>
                                        <?php endwhile;?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Ingreso de la estado-->
                    <div class="form-group row">
                        <label for="estatus" class="col-md-2 col-md-offset-2 control-label">Estado:</label>
                        <div class="col-md-6">
                            <select class="form-control" name="estatus">
                                <?php
                                include("conexion.php");
                                $registros=mysqli_query($conexion,"select idestatus,nombre from estatus")
                                or die("Problemas en el select:".mysqli_error($conexion));
                                while ($reg=mysqli_fetch_array($registros)) :?>
                                    <option value="<?php echo $reg['idestatus']?>"><?php echo $reg['nombre']?></option>
                                <?php endwhile;?>
                            </select>
                        </div>
                    </div>
                    <!-- Observacion-->
                    <div class="form-group row">
                        <label for="observacion" class="col-md-2 control-label">Observacion:</label>
                        <div class="col-md-12">
                            <textarea name="observacion"  rows="10"><?php echo $columna_MostrarNoticia['observacion'];?></textarea>
                            <script>tinyMCE.init({selector: "textarea",branding: false,plugins: "image,paste",paste_data_images: true});</script>
                        </div>
                    </div>
                    <!-- Boton para enviar datos-->
                    <div class="panel-footer text-center">
                        <input class="btn btn-warning" type="submit" name="modificar" value="Modificar Incidencia" />
                    </div>
                </div>

            </div>

        </div>
    </form>

<?php endif;

$query_MostrarTitulos = mysqli_query($conexion,"SELECT idreporte, titulo, observacion, fecha FROM reporte ORDER by idreporte DESC limit 1")
or die("Problemas en el select:".mysqli_error($conexion)); // Ejecutamos la consulta
while($columna_MostrarTitulos = mysqli_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
{
    echo '<a href="?reporte='.$columna_MostrarTitulos['idreporte'].'">
    Modificar esta incidencia</a> ';   // Mostramos un enlace para modificar cada noticia
    //$idreporte = $columna_MostrarTitulos['idreporte'];
    //echo $idreporte;
}
?>
</html>
