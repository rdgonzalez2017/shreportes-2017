<?php
if(!empty($_REQUEST['nombre'])){ // Comprobamos que los valores recibidos no son NULL
        include ("../conexion.php");
        $query_reportes = mysqli_query($conexion, "insert into categorias(nombre) VALUES 
                     ('$_REQUEST[nombre]') ")
        or die("Problemas en el insert principal" . mysqli_error($conexion));
        mysqli_close($conexion);
    //header("Location:../agregarcategoria.php");
    echo "<script>location.href='../agregarcategoria.php';</script>";
}
?>