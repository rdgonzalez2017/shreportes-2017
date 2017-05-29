<?php
include("conexi.php");
$consulta = mysql_query("SELECT idreporte FROM reporte ORDER BY idreporte DESC LIMIT 1") or die("error mysql");
while($resultados = mysql_fetch_array($consulta)) {
    $idreporte = $resultados['idreporte'];
}
ob_start();
echo $idreporte+1;
$myStr = ob_get_contents();
ob_end_clean();
echo $myStr;
?>