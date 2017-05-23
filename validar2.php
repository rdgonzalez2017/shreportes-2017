<?php
session_start();
//echo $_POST['correo'];
if(!empty($_POST['correo']) and !empty($_POST['clave'])){
    //echo 'entro';
    include('conexi.php');
    $correo  = $_POST['correo'];
    $clave  = $_POST['clave'];
    $wsqli="select * from usuarios where correo = '$correo' and clave = '$clave'";
    //echo $wsqli;
    $result=$conexion->query($wsqli);
    if($conexion->errno) die($conexion->error);
    $row=$result->fetch_array();
    if($row==0){
        $_SESSION['bienvenido']="El usuario no esta registrado";
        unset($_SESSION['idu']);
        $url='location:index.php';
    }
    else{

        $_SESSION['bienvenido']=$row['nombre'];
        $_SESSION['idu']=$row['idusuario'];
        $url='location:sistema.php';
    }
}
header($url);
?>