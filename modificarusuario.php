<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php");?>
<div class="container-fluid row">
<?php include("navbar/navbarmodificar.php");?>
<?php if (isset($_SESSION['nombre'])) {echo "Sesión: ".$_SESSION['nombre'];} ?>
</div>
<body>
<div class="container col-md-6 col-md-offset-3">
<?php
include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos

if(isset($_POST['modificar'])) // Si el boton de "modificar" fúe presionado ejecuta el resto del código
{

    $idusuario = (int) mysql_real_escape_string($_POST['idusuario']);
    $nombre = mysql_real_escape_string($_POST['nombre']);
    $correo = mysql_real_escape_string($_POST['correo']);
    $clave = (int) mysql_real_escape_string($_POST['clave']);
    echo $idusuario;
    $query_modificar = mysql_query("UPDATE usuarios SET nombre = '".$nombre."', correo = '".$correo."', clave = '".$clave."' WHERE idusuario = '".$idusuario."'"); // Ejecutamos la consulta para actualizar el registro en la base de datos
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
    $idusuario = (int) mysql_real_escape_string($_GET['usuario']); // Recibimos el id de la noticia por medio de GET
    $query_NoticiaCompleta = mysql_query("SELECT * FROM usuarios WHERE idusuario = '".$idusuario."'"); // Ejecutamos la consulta
    $columna_MostrarNoticia = mysql_fetch_assoc($query_NoticiaCompleta);
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
$query_MostrarTitulos = mysql_query("SELECT * from usuarios WHERE nombre = '".$sessionusuario."'"); // Ejecutamos la consulta
while($columna_MostrarTitulos = mysql_fetch_assoc($query_MostrarTitulos)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
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
</html>
