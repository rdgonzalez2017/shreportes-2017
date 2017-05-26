<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/ckeditor/ckeditor.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>
    <script src="js/wow.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <title>	SH Reportes	</title>
</head>
<nav class="navbar navbar-inverse" style="background: darkblue;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="img-responsive wow flipInX animated animated" href="https://www.servicioshosting.com/sitio/"><img src="images/logo_desktop.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="3000ms" onclick = "location='https://www.servicioshosting.com/sitio/contactanos-2/'">Contactos</button>-</li>
                <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="3000ms"" onclick = "location='http://blog.servicioshosting.com/'">Blog ServiciosHosting</button></li>

            </ul>
        </div>
    </div>
</nav>
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
<div class="col-md-8 col-md-offset-2">
<?php
//Mostrar botón de modificar Reporte, al estar el el reporte de Muestra y esconder al estar en el reporte publicado.
$url= $_SERVER["REQUEST_URI"];
ob_start();
echo strlen($url);
$VariableURL = ob_get_contents();
ob_end_clean();
if($VariableURL<50){
    include ("modificareporte.php");
}
?>
</div>
<body">
 <div class="row col-md-12">
<!-- Muestra Previa del Reporte -->
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
                $select = "SELECT *, estatus.nombre as nombrestatus, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1";
                $query_reportes = mysql_query("$select"); // Ejecutamos la consulta
                //$query_reportes = mysql_query("SELECT * FROM reporte WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' LIMIT 1"); // Ejecutamos la consulta
                if(mysql_num_rows($query_reportes) > 0) // Si existe la noticia, la muestra
                {
                    while($columna = mysql_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
                    {
                        $categoria =  $columna['nombrecategoria'];
                        $autor =  $columna['autor'];
                        $fecha =  $columna['fecha'];
                        $observacion =  $columna['observacion'];
                        $idreplicacion =  $columna['idreplicacion'];
                        $idestatus =  $columna['idestatus'];
                        $estatus =  $columna['nombrestatus'];
                        //Panel que muestra el Reporte Final:
                        echo'
                        
                             <div class="panel panel-primary container col-md-6 col-md-offset-3 bounceInRight animated animated" data-wow-duration="3000ms"">
                                
                                    <div class="panel-heading row" style="background: orange">
                                        <p class="text-center">Reporte</p>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="titulo" class="col-md-3 col-md-offset-2 control-label">Titulo:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $titulo; echo' </div>            
                                        </div>
                                        <div class="row">
                                            <label for="categoria" class="col-md-3 col-md-offset-2 control-label">Categoría:</label>
                                               <div class="col-md-7 col-md-pull-1">'; echo  $categoria; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha" class="col-md-3 col-md-offset-2 control-label">Fecha:</label>
                                                <div class="col-md-7 col-md-pull-1">'; echo $fecha; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="autor" class="col-md-3 col-md-offset-2 control-label">Autor:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $autor; echo' </div>
                                        </div>
                                        <div class="row">
                                            <label for="estado" class="col-md-3 col-md-offset-2 control-label">Estado:</label>
                                                 <div class="col-md-7 col-md-pull-1">'; echo $estatus; echo' </div>
                                        </div>
                                    </div>
                           
                           </div>
                           
                                        <div class="row">
                                            <label for="observacion" class="col-md-10 col-md-offset-1 control-label">Observacion:</label><br>
                                                 <div class="col-md-10 col-md-offset-1 wow fadeInDownBig animated animated" data-wow-duration="5000ms" style="max-width:100%; overflow-y:auto;"  >'; echo $observacion; echo' </div>
                                        </div>
                       
                          
                                            ';
                        if ($idestatus <> 1) {
                            echo '
                            <BR> 
                            <!-- Formulario para envío de comentarios-->
                                <form class="form" name="miFormu" method="post" action="nuevocomentario.php">
                                    <INPUT TYPE="hidden" NAME="id" VALUE="' . $idreplicacion . '">
                                    <INPUT TYPE="hidden" NAME="idprotegido" VALUE="' . $idreporte . '">
                                    <div class="col-md-6 col-md-offset-3">
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
                                                        <textarea name="comentario" type="text" required class="form-control" rows="5"></textarea>
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
                    echo ''; // Si no, muestra un error
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

            $select = "SELECT *, categorias.nombre as nombrecategoria FROM categorias RIGHT JOIN reporte on categorias.idcategoria = reporte.idcategoria LEFT JOIN estatus ON reporte.idestatus = estatus.idestatus order by idreporte desc limit 1";
            $query_reportes = mysql_query("$select"); // Ejecutamos la consulta
            $limite = 100; // Número de carácteres a mostrar antes de el "Leer más"
            $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
            while($columna = mysql_fetch_assoc($query_reportes)) // Realizamos un bucle que muestre todas las noticias, utilizando while.
            {

                echo'<div class="row well col-md-10 col-md-offset-1">';
                $idprotegido=md5($clave.$columna['idreplicacion']);
                echo'<div style="text-align: center">';echo'Vista Previa del Reporte:';echo'</div>';
                echo 'Id de Reporte: '; echo $columna['idreporte']; echo'<br>';
                echo 'Estado: '; echo $columna['nombre'];echo'<br>';
                echo 'Titulo: '; echo $columna['titulo'];echo'<br>';
                echo 'Fecha: '; echo $columna['fecha'];echo'<br>';
                echo 'Autor: '; echo $columna['autor'];echo'<br>';
                echo 'Categoria: '; echo $columna['nombrecategoria'];echo'<br>';
                echo'Observacion:<textarea class="form-control" name="observacion" rows="5">'; echo $columna['observacion'];
                echo '</textarea><script>CKEDITOR.replace("observacion");</script> 
                </div>';
                echo'<div class="row  col-md-10 col-md-offset-1">';
               echo '
                <div class="row text-center">
                Si todo está bien, presione el botón:
                <br>
                <a class="btn btn-success" href="?reporte=' .$idprotegido.'">Publicar</a><br><br>
                 </div>
                 ';
                echo '<div class="row col-md-2">';
                include("botoninicio.php");
                 echo'</div>
                 ';
                echo ' 
         ';
                //echo 'Titulo del reporte: ';
                // echo $columna['titulo'];
            }
        }
        ?>

    </section>
 </div>
</body>
<footer>
    <br><br>
    <!-- Seccion de comentarios-->
    <?php
    $resultComen = mysql_query("SELECT *  FROM comentarios WHERE MD5(concat('".$clave."',idreporte)) = '".$idreporte."' ORDER BY id DESC");
    while($rowComen = mysql_fetch_assoc($resultComen))
    {
        ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <!-- Muestra Autor del comentario-->
                <div class="panel-heading text-center">
                    <div> Autor: <?php echo $rowComen["nick"]; ?> </div>
                </div>
                <div class="panel-body">

                    <!-- Muestra fecha del comentario-->
                    <div class="form-group row">
                        <label for="fecha" class="col-md-2 control-label">Fecha:</label>
                        <div class="col-md-8">
                            <div> <?php echo $rowComen["fecha"]; ?> </div>
                        </div>
                    </div>
                    <!-- Muestra descripción del comentario-->
                    <div class="form-group row">
                        <label for="comentario" class="col-md-2 control-label">Comentario:</label>
                        <div class="col-md-12 row">
                            <textarea class="form-control" readonly="readonly" name="observacion" rows="5"> <?php echo $rowComen["comentario"]; ?>  </textarea>
                        </div>
                    </div>

               </textarea>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</footer>
</html>