<?php
if(!empty($_REQUEST['titulo'])){ // Comprobamos que los valores recibidos no son NULL
    include ("../conexion.php");
    $query_reportes = mysqli_query($conexion, "insert into reporte(idusuario,idcategoria,titulo,autor,observacion,fecha)
             values ('$_REQUEST[idusuario]','$_REQUEST[categoria]', '$_REQUEST[titulo]','$_REQUEST[autor]','$_REQUEST[observacion]', CURDATE())")
    or die("Problemas en el insert principal" . mysqli_error($conexion));
    mysqli_close($conexion);
    //header("Location:../muestra.php");
    echo "<script>location.href='../muestra.php';</script>";

}
?>

