<?php
session_start();
if (isset($_SESSION['nombre'])):
     require ("../config/conexion.php");
    $comentario=mysqli_real_escape_string($conexion,(strip_tags($_POST['comentario'], ENT_QUOTES)));
    $nick=mysqli_real_escape_string($conexion,(strip_tags($_POST['nick'], ENT_QUOTES)));

    $idreporte = $_POST['idreporte'];
    $correo = $_POST['correo'];
    $id_cliente = $_POST['idcliente'];
    $link = $_POST['link'];

    if (!empty($_POST['idreporte'])):  // Comprobamos que los valores recibidos no son NULL
        require ("../config/conexion.php");
        $insert_comentarios = mysqli_query($conexion, "insert into comentarios(id,idreporte,nick,correo,comentario,fecha) 
    SELECT NULL, '$idreporte', '$nick', '$correo', '$comentario', now()
    FROM reportes where id = $idreporte LIMIT 1")
                or die("Problemas al insertar los datos del comentario" . mysqli_error($conexion));
    endif;

    $correoautor = $_POST['correoautor'];
    require ("../config/conexion.php");
    $select_comentarios = mysqli_query($conexion, "Select correo from comentarios where idreporte = '$idreporte' and correo <> '$correoautor' ORDER by id DESC limit 1")
            or die("Problemas en el select del comentario" . mysqli_error($conexion));
    mysqli_close($conexion);
    while ($columna = mysqli_fetch_array($select_comentarios)):
        $correocliente = $columna['correo'];
//para el envío en formato HTML 
        $cabeceras = '<br>From: ' . $correoautor . "\r\n" .
                'Reply-To: no-responder@servitepuy.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

/*
        session_start();
        if (isset($_SESSION['nombre'])) {
            echo $correocliente;
            mail("$correocliente", "ServiciosHosting.com: Incidencias.", "Tiene un nuevo comentario en: $link");
        } else {
            echo $correoautor;
            mail("$correoautor", "ServiciosHosting.com: Incidencias.", "Tiene un nuevo comentario en: $link");
        }
 
 */
    //mail("$correocliente","SH Incidencias","Tiene un nuevo comentario en: $link")
    //}else {
    //mail("$correoautor","SH Incidencias","Tiene un nuevo comentario en: $link")
    //}

    endwhile;
    $idprotegido = $_POST['idprotegido'];
    echo $idprotegido;
    
    ?>

    <script>location.href = '../reportes.php?reporte=<?php echo $idprotegido;?>'</script>
    <?php


//header("Location:../reportes.php?reporte=" . $idprotegido);

endif;