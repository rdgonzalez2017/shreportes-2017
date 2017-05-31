<?php include("head.php");?>
<?php include("../navbar/navbarreportes.php");?>
<?php
$usuario = $_POST['nombre'];
$pass = $_POST['clave'];

if(empty($usuario) || empty($pass)){
header("Location: ../index.php");
exit();
}
$conexion = mysqli_connect("localhost", "root", "", "shreportes") or
die("Problemas con la conexión");

$result = mysqli_query($conexion,"SELECT * from usuarios where nombre='" . $usuario . "'");

if($row = mysqli_fetch_array($result)){
    if($row['clave'] == $pass){
        session_start();
        $_SESSION['tipo'] = $row['idtipodeusuario'];
        $_SESSION['nombre'] = $usuario;
        header("Location: ../sistema.php");
        }else{
        //header("Location: index.php");
        echo 'Clave Incorrecta';
        exit();
    }
}else{
    //header("Location: index.php");
    echo 'Usuario Incorrecto';
    exit();
}
?>