<?php
$valor = $_REQUEST['comentario'];
$valor = array();
foreach ($_POST as $keyComentario => $valor)
{
    $_POST[$keyComentario] = addslashes(limpiarComentario($valor));
}
function limpiarComentario($valor)
{
    $valor = str_ireplace("SELECT", "", $valor);
    $valor = str_ireplace("COPY", "", $valor);
    $valor = str_ireplace("DELETE", "", $valor);
    $valor = str_ireplace("DROP", "", $valor);
    $valor = str_ireplace("DUMP", "", $valor);
    $valor = str_ireplace(" OR ", "", $valor);
    $valor = str_ireplace("%", "", $valor);
    $valor = str_ireplace("LIKE", "", $valor);
    $valor = str_ireplace("--", "", $valor);
    $valor = str_ireplace("^", "", $valor);
    $valor = str_ireplace("[", "", $valor);
    $valor = str_ireplace("!","",$valor);
    $valor = str_ireplace("¡","",$valor);
    $valor = str_ireplace("=","",$valor);
    $valor = str_ireplace("&","",$valor);
    return $valor;
}
ob_start();
echo $_POST[$keyComentario];
$comentario = ob_get_contents();
ob_end_clean();

$valor = $_REQUEST['nick'];
$valor = array();
foreach ($_POST as $keyNick => $valor)
{
    $_POST[$keyNick] = addslashes(limpiarNick($valor));
}
function limpiarNick($valor)
{
    $valor = str_ireplace("SELECT", "", $valor);
    $valor = str_ireplace("COPY", "", $valor);
    $valor = str_ireplace("DELETE", "", $valor);
    $valor = str_ireplace("DROP", "", $valor);
    $valor = str_ireplace("DUMP", "", $valor);
    $valor = str_ireplace(" OR ", "", $valor);
    $valor = str_ireplace("%", "", $valor);
    $valor = str_ireplace("LIKE", "", $valor);
    $valor = str_ireplace("--", "", $valor);
    $valor = str_ireplace("^", "", $valor);
    $valor = str_ireplace("[", "", $valor);
    $valor = str_ireplace("!","",$valor);
    $valor = str_ireplace("¡","",$valor);
    $valor = str_ireplace("?","",$valor);
    $valor = str_ireplace("=","",$valor);
    $valor = str_ireplace("&","",$valor);
    return $valor;
}
ob_start();
echo $_POST[$keyNick];
$nick = ob_get_contents();
ob_end_clean();

$reporte = $_REQUEST['id'];
$idprotegido = $_REQUEST['idprotegido'];
if(!empty($_REQUEST['id'])):  // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $query_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,comentario,fecha) 
    SELECT NULL, '$_REQUEST[id]', '$nick', '$comentario', now()
    FROM reporte where idreporte = $reporte LIMIT 1")
    or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
    mysqli_close($conexion);
    ?>
    <script>location.href='../reportes.php?reporte=<?php echo $idprotegido;?>'</script>
    <?php
    //header("Location:../reportes.php?reporte=" . $idprotegido);
endif;
?>

