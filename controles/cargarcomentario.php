
<?php
$reporte = $_REQUEST['id'];
$idprotegido = $_REQUEST['idprotegido'];
if(!empty($_REQUEST['id'])):  // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $query_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,comentario,fecha) 
    SELECT NULL, '$_REQUEST[id]', '$_REQUEST[nick]', '$_REQUEST[comentario]', now()
    FROM reporte where idreporte = $reporte LIMIT 1")
    or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
    mysqli_close($conexion);
    ?>
     <script>location.href='../reportes.php?reporte=<?php echo $idprotegido;?>'</script>
    <?php
    //header("Location:../reportes.php?reporte=" . $idprotegido);
endif;
?>


