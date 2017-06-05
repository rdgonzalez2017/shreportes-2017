<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php");?>
<div class="container-fluid row">
    <?php
    if (isset($_SESSION['nombre'])):
        include ("navbar/navbarsistema.php");
    else:
        include ("navbar/navbarindex.php");
    endif;
    ?>
    <?php if (isset($_SESSION['nombre'])):?>
    <?php if (isset($_SESSION['nombre'])) {echo "Sesión Abierta: ".$_SESSION['nombre'];} ?>

</div>
<body>
<div class="container col-md-6 col-md-offset-3">
<?php
include("conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos
if(isset($_POST['modificar'])) // Si el boton de "modificar" fúe presionado ejecuta el resto del código
{

    $idusuario = ($_POST['idusuario']);
    $nombre = ($_POST['nombre']);
    $correo = ($_POST['correo']);
    $clave = ($_POST['clave']);
    $query_modificar = mysqli_query($conexion,"UPDATE usuarios SET nombre = '".$nombre."', correo = '".$correo."', clave = '".$clave."' WHERE idusuario = '".$idusuario."'"); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if($query_modificar)
    {
        echo 'El usuario se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje

    }
    else
    {
        echo 'El usuario no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
}

if(isset($_GET['usuario']))
{
    $idusuario = $_GET['usuario']; // Recibimos el id de la noticia por medio de GET
    $query_NoticiaCompleta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE idusuario = '".$idusuario."'"); // Ejecutamos la consulta
    $columna_MostrarNoticia = mysqli_fetch_assoc($query_NoticiaCompleta);
    echo ' 
    <form class="text-center" action="modificarusuario.php" method="post"> <!-- Creamos el formulario, utilizando la etiqueta form, cuyo atributo action="" indicará donde se procesará el formulario --> 
        ID: <input class="form-control text-center" readonly="readonly" name="idusuario" type="text" value="'.$columna_MostrarNoticia['idusuario'].'" /> <br/>
        Nombre: <input class="form-control text-center" name="nombre" type="text" value="'.$columna_MostrarNoticia['nombre'].'" /> <br/>
        Correo: <input class="form-control text-center" name="correo" type="email" value="'.$columna_MostrarNoticia['correo'].'" /> <br/>
        Clave: <input class="form-control text-center" name="clave" type="password" value="'.$columna_MostrarNoticia['clave'].'" /> <br/>
        <input class="btn btn-warning" type="submit" name="modificar" value="Modificar Usuario" />
        </div>
    </form> 
    <br>
    ';
}

if (isset($_SESSION['nombre']))
{$sessionusuario = $_SESSION['nombre'];}
$query_MostrarTitulos = mysqli_query($conexion,"SELECT * from usuarios WHERE nombre = '".$sessionusuario."'")
or die("Problemas en el select:".mysqli_error($conexion));
while($columna_MostrarTitulos = mysqli_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
{
    echo '<div class="row well text-center">';
    echo '<a href="?usuario='.$columna_MostrarTitulos['idusuario'].'">
    Modificar mi Usuario:</a> ';   // Mostramos un enlace para modificar cada noticia
    $nombreusuario = $columna_MostrarTitulos['nombre'];

    echo $nombreusuario;
    echo '</div>';
}
?>
</div>
</body>
<?php
else: echo 'Debe Iniciar Sesión para entrar a esta página';
endif;
?>
</html>
