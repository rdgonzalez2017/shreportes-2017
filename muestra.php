<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>	SH Reportes	</title>
</head>
<body>
<?php include('validarmuestra.php'); ?>
<?php
include('conexi.php');
//Mostrar Datos Guardados
$select = "SELECT * FROM reporte inner join categorias on reporte.idcategoria = categorias.idcategoria 
where idreporte = (SELECT idreporte FROM reporte ORDER BY 1 desc LIMIT 1 )";//Campos de la tabla
$consulta = mysql_query("$select") or die("Error en el select en Muestra previa del reporte");
while($resultados = mysql_fetch_array($consulta)) {
    $idreporte = $resultados['idreporte'];
    $categoria = $resultados['nombre'];
    $titulo = $resultados['titulo'];
    $autor = $resultados['autor'];
    $observacion = $resultados['observacion'];
    $fecha = $resultados['fecha'];
}
?>
<!-- Muestra Previa del Reporte -->
<div class="col-md-8 col-md-offset-2">
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading" style="background: orange">
            <p class="text-center">Reporte</p>
        </div>
        <div class="panel-body">
            <div class="form-group row">
                <label for="titulo" class="col-md-2 col-md-offset-2 control-label">Titulo:</label>
                <div class="col-md-8">
                    <div> <?php echo $titulo;?> </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="titulo" class="col-md-2 col-md-offset-2 control-label">Categoria:</label>
                <div class="col-md-8">
                    <div> <?php echo $categoria;?> </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fecha" class="col-md-2 col-md-offset-2 control-label">Fecha:</label>
                <div class="col-md-8" >
                    <div>  <?php echo $fecha;?> </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="autor" class="col-md-2 col-md-offset-2 control-label">Autor:</label>
                <div class="col-md-8">
                    <div> <?php echo $autor;?> </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="observacion" class="col-md-2 col-md-offset-2 control-label">Observacion:</label>
                <div class="col-md-8" >
                    <div> <?php echo $observacion;?> </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <!-- Seccion que muestra la publicacion final del reporte-->
        <?php
        include("conexi.php"); // Incluimos nuestro archivo de conexión con la base de datos
        if(isset($_GET['reporte']))
        {
            if(!empty($_GET['reporte'])) // Si el valor de "noticia" no es NULL, continua con el proceso
            {
                $idreporte = $_GET["reporte"];
                $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
                $query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
                if(mysql_num_rows($query_reportes) > 0) // Si existe la noticia, la muestra
                {
                    while($columna = mysql_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
                    {
                        $idreplicacion =  $columna['idreplicacion'];
                        $idestatus =  $columna['idestatus'];
                        if ($idestatus <> 1) {
                            echo '
                            <BR> 
                            <!-- Formulario para envío de comentarios-->
                                <form class="form" name="miFormu" method="post" action="nuevocomentario.php">
                                    <INPUT TYPE="hidden" NAME="id" VALUE="' . $idreplicacion . '">
                                    <INPUT TYPE="hidden" NAME="idprotegido" VALUE="' . $idreporte . '">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <p class="text-center">Formulario de Comentarios</p>
                                            </div>
                                            <!-- Ingreso del titulo-->
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <label for="nick" class="col-md-2 control-label">Autor:</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="nick" id="nick"  required/>
                                                    </div>
                                                </div>
                                                <!-- Ingreso del Autor-->
                                              <!-- Ingreso del comentario-->
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <label for="comentario" class="col-md-3 control-label">Comentario:</label>
                                                    <div class="col-md-10">
                                                        <textarea name="comentario" type="text" required class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Boton para enviar datos-->
                                            <div class="panel-footer text-center">
                                                <input type="submit" class="btn btn-info btn-sm" value="Enviar comentario">                      
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                        ';
                        }else echo 'Este caso está resuelto';
                    }
                }
                else
                {
                    echo 'La noticia que solicitas, no existe.'; // Si no, muestra un error
                }
            }
            else
            {
                echo 'Debes seleccionar una noticia.'; // Si GET no recibe ningún valor, muestra un error
            }
//Comentarios:
        }
        else
        {
            $select = "SELECT * FROM reporte LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus order by idreporte desc limit 1";
            $query_reportes = mysql_query("$select"); // Ejecutamos la consulta
            $limite = 100; // Número de carácteres a mostrar antes de el "Leer más"
            $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
            while($columna = mysql_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
            {
                $idprotegido=md5($clave.$columna['idreplicacion']);
                echo 'Id de Reporte: '; echo $columna['idreporte']; echo'<br>';
                echo 'Estado: '; echo $columna['nombre'];echo'<br><br>';
                echo ' 
             <br> <br>
            Si todo está bien, presione el botón "Publicar":
           <br>
                <div class="row text-center">
                <a class="btn btn-success" href="?reporte=' .$idprotegido.'">Publicar</a><br><br>
                 </div>
                 <!-- Incluimos un enlace para leer la noticia entera --> 
            <!-- Botòn que lleva a la tabla de reportes-->
            <div style="float: right">
                <input type="submit" class="btn btn-primary btn-sm" value="Regresar al Inicio" onclick = "location=\'sistema.php\'"/>
         <br> <br>
         <div style="float: right">
         <br><br>
         ';
                //echo 'Titulo del reporte: ';
                // echo $columna['titulo'];
            }

        }
        ?>
    </section>
</body>
<footer>
    <br><br>
    <!-- Seccion de comentarios-->
    <?php
    $resultComen = mysql_query("SELECT *  FROM comentarios WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' ORDER BY id DESC");
    while($rowComen = mysql_fetch_assoc($resultComen))
    {
        ?>
        <div class="col-md-12">
            <div class="panel panel-danger">
                <!-- Muestra Autor del comentario-->
                <div class="panel-heading text-center">
                    <div> Autor: <?php echo $rowComen["nick"]; ?> </div>
                </div>
                <div class="panel-body">
                    <!-- Muestra descripción del comentario-->
                    <div class="form-group row">
                        <label for="comentario" class="col-md-2 col-md-offset-2 control-label">Comentario:</label>
                        <div class="col-md-8">
                            <div> <?php echo $rowComen["comentario"]; ?> </div>
                        </div>
                    </div>
                    <!-- Muestra fecha del comentario-->
                    <div class="form-group row">
                        <label for="fecha" class="col-md-2 col-md-offset-2 control-label">Fecha:</label>
                        <div class="col-md-8">
                            <div> <?php echo $rowComen["fecha"]; ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <?php




    //echo "$url  ";'<br>';
    //echo "http://" . $host . $url;

    $url= $_SERVER["REQUEST_URI"];
    ob_start();
    echo strlen($url);
    $VariableURL = ob_get_contents();
    ob_end_clean();
    
    if($VariableURL<50){

        include ("modificareporte.php");
    }

    ?>
</footer>

</html>