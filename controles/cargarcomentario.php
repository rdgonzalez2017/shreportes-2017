<?php
function cleanInput($input) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
        '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
    );
    $output = preg_replace($search, '', $input);
    return $output;
}
function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
?>


<?php
$reporte = $_REQUEST['id'];
$idprotegido = $_REQUEST['idprotegido'];
echo $reporte;
if(!empty($_REQUEST['id'])) { // Comprobamos que los valores recibidos no son NULL
    $conexion = mysqli_connect("localhost", "root", "", "shreportes") or
    die("Problemas con la conexión");
    $query_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,comentario,fecha) 
    SELECT NULL, '$_REQUEST[id]', '$_REQUEST[nick]', '$_REQUEST[comentario]', now()
    FROM reporte where idreporte = $reporte LIMIT 1")
    or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
    mysqli_close($conexion);

    header("Location:../reportes.php?reporte=" . $idprotegido);
}
?>


