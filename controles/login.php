<!DOCTYPE html>
<html>
<?php
//FUNCIÓN PARA LIMPIAR LOS COMENTARIOS DE INYECCIÓN SQL
$valorC = $_REQUEST['clave'];
$valorC = array();
foreach ($_POST as $keyClave => $valorC)
{
    $_POST[$keyClave] = addslashes(limpiarComentario($valorC));
}
function limpiarComentario($valorC)
{
    $valorC = str_ireplace("SELECT", "", $valorC);
    $valorC = str_ireplace("COPY", "", $valorC);
    $valorC = str_ireplace("DELETE", "", $valorC);
    $valorC = str_ireplace("DROP", "", $valorC);
    $valorC = str_ireplace("DUMP", "", $valorC);
    $valorC = str_ireplace(" OR ", "", $valorC);
    $valorC = str_ireplace("LIKE", "", $valorC);
    $valorC = str_ireplace("--", "", $valorC);
    $valorC = str_ireplace("^", "", $valorC);
    $valorC = str_ireplace("[", "", $valorC);
    $valorC = str_ireplace("!","",$valorC);
    $valorC = str_ireplace("¡","",$valorC);
    $valorC = str_ireplace("?","",$valorC);
    $valorC = str_ireplace("=","",$valorC);
    $valorC = str_ireplace("&","",$valorC);
    return $valorC;
}
ob_start();
echo $_POST[$keyClave];
$pass = ob_get_contents();
ob_end_clean();

$usuario = $_POST['nombre'];
if(empty($usuario) || empty($pass)){
header("Location: ../index.php");
exit();
}
include ("../conexion.php");
$result = mysqli_query($conexion,"SELECT * from usuarios where nombre='" . $usuario . "'");
if($row = mysqli_fetch_array($result)):
    if($row['clave'] == $pass):
        session_start();
        $_SESSION['tipo'] = $row['idtipodeusuario'];
        $_SESSION['nombre'] = $usuario;
        //header("Location:../sistema.php");
            echo "<script>location.href='../sistema.php';</script>";
        else:
        //header("Location: ../index.php");
            echo "<script>location.href='../index.php';</script>";
            echo '<div class="well" style="float: right">Clave Incorrecta</div><br>';
            ?>
            <a href='../index.php' style="float: right">Inicio de Sesión</a>
<?php
exit();
    endif;
else:
    //header("Location: index.php");
    echo 'Usuario Incorrecto';
    exit();
endif;
?>

