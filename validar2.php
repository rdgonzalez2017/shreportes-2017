<?php
$usuario = $_POST['nombre'];
$pass = $_POST['clave'];

if(empty($usuario) || empty($pass)){
header("Location: index.php");
exit();
}
mysql_connect('localhost','root','') or die("Error al conectar " . mysql_error());
mysql_select_db('shreportes') or die ("Error al seleccionar la Base de datos: " . mysql_error());

$result = mysql_query("SELECT * from usuarios where nombre='" . $usuario . "'");

if($row = mysql_fetch_array($result)){
    if($row['clave'] == $pass){
        session_start();
        $_SESSION['tipo'] = $row['idtipodeusuario'];
        $_SESSION['nombre'] = $usuario;
        header("Location: sistema.php");
        }else{
        header("Location: index.php");
        echo 'Usuario Incorrecto';
    exit();
    }
}else{
    header("Location: index.php");
    echo 'Usuario Incorrecto';
    exit();
}
?>