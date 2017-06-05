<!DOCTYPE html>
<html>
<?php
include("../head.php");
$usuario = $_POST['nombre'];
$pass = $_POST['clave'];
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
        header("Location:../sistema.php");
        else:
        header("Location: ../index.php");
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

