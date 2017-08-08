<?php
//FUNCIÓN PARA LIMPIAR LOS COMENTARIOS DE INYECCIÓN SQL
$valorC = $_POST['comentario'];
$valorC = array();
foreach ($_POST as $keyComentario => $valorC)
{
    $_POST[$keyComentario] = addslashes(limpiarComentario($valorC));
}
function limpiarComentario($valorC)
{
    $valorC = str_ireplace("SELECT", "", $valorC);
    $valorC = str_ireplace("COPY", "", $valorC);
    $valorC = str_ireplace("DELETE", "", $valorC);
    $valorC = str_ireplace("DROP", "", $valorC);
    $valorC = str_ireplace("DUMP", "", $valorC);
    $valorC = str_ireplace(" OR ", "", $valorC);
    $valorC = str_ireplace("%", "", $valorC);
    $valorC = str_ireplace("LIKE", "", $valorC);
    $valorC = str_ireplace("--", "", $valorC);
    $valorC = str_ireplace("^", "", $valorC);
    $valorC = str_ireplace("[", "", $valorC);
    $valorC = str_ireplace("!","",$valorC);
    $valorC = str_ireplace("¡","",$valorC);
    $valorC = str_ireplace("=","",$valorC);
    $valorC = str_ireplace("&","",$valorC);
    return $valorC;
}
ob_start();
echo $_POST[$keyComentario];
$comentario = ob_get_contents();
ob_end_clean();

//FUNCIÓN PARA LIMPIAR EL CAMPO "AUTOR" DE INYECCIÓN SQL
$valor = $_POST['nick'];
$nicklimpio = addslashes($valor);
//INSERCIÓN DE DATOS
$idreporte = $_POST['idreporte'];
$correo = $_POST['correo'];
$link = $_POST['link'];

if(!empty($_POST['idreporte'])):  // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $insert_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,correo,comentario,fecha) 
    SELECT NULL, '$idreporte', '$nicklimpio', '$correo', '$comentario', now()
    FROM reporte where idreporte = $idreporte LIMIT 1")
    or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
endif;

$correoautor = $_POST['correoautor'];
include ("../conexion.php");
$select_comentarios = mysqli_query($conexion,"Select correo from comentarios where idreporte = $idreporte and correo <> '$correoautor' ORDER by id DESC limit 1")
or die("Problemas en el select del comentario" . mysqli_error($conexion));
mysqli_close($conexion);
while($columna = mysqli_fetch_array($select_comentarios)):
    $correocliente =  $columna['correo'];
//para el envío en formato HTML 
$cabeceras = '<br>From: '.$correoautor . "\r\n" .
    'Reply-To: no-responder@servitepuy.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


session_start();
    if (isset($_SESSION['nombre'])) {
        echo $correocliente;
        mail("$correocliente","ServiciosHosting.com: Incidencias.","Tiene un nuevo comentario en: $link");
    }else{
        echo $correoautor;
        mail("$correoautor","ServiciosHosting.com: Incidencias.","Tiene un nuevo comentario en: $link");
    }
    //mail("$correocliente","SH Incidencias","Tiene un nuevo comentario en: $link")
    //}else {
    //mail("$correoautor","SH Incidencias","Tiene un nuevo comentario en: $link")
    //}

endwhile;
$idprotegido = $_POST['idprotegido'];
?><script>location.href='../reportes.php?reporte=<?php echo $idprotegido;?>'</script><?php
//header("Location:../reportes.php?reporte=" . $idprotegido);

