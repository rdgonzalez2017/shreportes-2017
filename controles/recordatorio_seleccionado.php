<?php
session_start();
//Se realiza un select para obtener los datos de cada reporte:
    include ('../config/conexion2.php');
    include ('../config/conexion.php');
    require '../php_mailer/PHPMailerAutoload.php';
    
    $select = "SELECT A.id as id_reporte, A.autor, A.idestatus, A.fecha as fecha_reporte, curdate() as fecha_actual, B.nombre as dominio_externo, C.domain as dominio_interno, D.id as id_cliente, D.firstname as nombre_cliente, D.lastname as apellido_cliente, D.email as correo_cliente, E.correo as correo_autor FROM $DB.reportes as A LEFT JOIN $DB.dominios as B ON A.iddominio = B.id LEFT JOIN $DB_2.tbldomains as C ON A.id_dominio_registrado = C.id LEFT JOIN $DB_2.tblclients as D ON A.id_cliente = D.id LEFT JOIN $DB.usuarios as E ON A.idusuario = E.id where A.idestatus <> 1 ";
    $select_cliente = mysqli_query($conexion, $select)
            or die("Problemas en el select" . mysqli_error("$conexion"));
    while ($fila = mysqli_fetch_array($select_cliente)):
        $id_reporte = $fila['id_reporte'];
        $id_estatus = $fila['idestatus'];
        $nombre_autor = $fila['autor'];
        $fecha_reporte = $fila['fecha_reporte'];
        $fecha_actual = $fila['fecha_actual'];
        $nombre_cliente = $fila['nombre_cliente'];
        $apellido_cliente = $fila['apellido_cliente'];
        $nombre_cliente_completo = $nombre_cliente . " " . $apellido_cliente;
        $correo_cliente = $fila['correo_cliente'];
        $correo_autor = $fila['correo_autor'];
        $dominio_externo = $fila['dominio_externo'];
        $dominio_interno = $fila['dominio_interno'];
        if(!empty($dominio_externo)){
            $dominio = $dominio_externo;
        }else{
            $dominio = $dominio_interno;
        }       
       if ($id_estatus==2){
          $mensaje = "Invitamos a revisar los detalles, presionando aquí:";
       }
       if ($id_estatus==3){
          $mensaje = "Estamos en espera de sus comentarios:";
       }
     
//Para obtener el link:
        $host = $_SERVER["HTTP_HOST"];
        $clave = "c/+*u4/+*c0mpl3n70_m4s_/+*c0mpl3j0__/+*c0mpl3j0_m3j05";
        $idprotegido = md5($clave . $id_reporte);
        $url = "/shincidencias/reportes.php?reporte=$idprotegido";
        $link = "https://" . $host . $url;
       
   
//Función PHP Mailer:
    $objetoCorreo = new PHPMailer;
    $objetoCorreo->isSMTP();
    $objetoCorreo->Host = 'mail.servicioshosting.com'; // El proveedor nos proporciona este dato.
    $objetoCorreo->SMTPAuth = true; // El proveedor nos proporciona este dato.
    $objetoCorreo->SMTPSecure = 'ssl'; // Puede ser tls o ssl. El proveedor nos proporciona este dato.
    $objetoCorreo->Port = 465; // El proveedor nos proporciona este dato.
//$objetoCorreo->SMTPDebug = 3;
    $objetoCorreo->Username = 'cotizador@servicioshosting.com';
    $objetoCorreo->Password = 'Atumedida2017/';
    $objetoCorreo->setFrom('no-responder@servicioshosting.com', 'ServiciosHosting.com');
    $objetoCorreo->addAddress($correo_cliente, $nombre_cliente_completo);
    $objetoCorreo->AddBCC($correo_autor);//Destinatario copia oculta
    $objetoCorreo->addReplyTo('no-responder@servitepuy.com', 'Respuestas');
    $objetoCorreo->isHTML(true);
    $objetoCorreo->CharSet = 'UTF-8'; // El correo irá codificado en UTF-8, para evitar problemas con letras acentuadas y otros caracteres especiales.
    $objetoCorreo->Subject = 'ServiciosHosting.com: Incidencia.';
    $correo = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en' style='background:#f3f3f3!important'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>My Email Templates</title>
    <style>
        @media only screen {
            html {
                min-height: 100%;
                background: #f3f3f3
            }
        }
        @media only screen and (max-width:596px) {
            .small-float-center {
                margin: 0 auto!important;
                float: none!important;
                text-align: center!important
            }
        }
        @media only screen and (max-width:596px) {
            table.body img {
                width: auto;
                height: auto
            }
            table.body center {
                min-width: 0!important
            }
            table.body .container {
                width: 95%!important
            }
            table.body .columns {
                height: auto!important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 16px!important;
                padding-right: 16px!important
            }
            table.body .columns .columns {
                padding-left: 0!important;
                padding-right: 0!important
            }
            table.body .collapse .columns {
                padding-left: 0!important;
                padding-right: 0!important
            }
            th.small-6 {
                display: inline-block!important;
                width: 50%!important
            }
            th.small-12 {
                display: inline-block!important;
                width: 100%!important
            }
            .columns th.small-12 {
                display: block!important;
                width: 100%!important
            }
            table.menu {
                width: 100%!important
            }
            table.menu td,
            table.menu th {
                width: auto!important;
                display: inline-block!important
            }
            table.menu.vertical td,
            table.menu.vertical th {
                display: block!important
            }
            table.menu[align=center] {
                width: auto!important
            }
        }
    </style>
</head>
<body style='-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;background:#f3f3f3!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important'><span class='preheader' style='color:#f3f3f3;display:none!important;font-size:1px;line-height:1px;max-height:0;max-width:0;mso-hide:all!important;opacity:0;overflow:hidden;visibility:hidden'></span>
    <table
        class='body' style='Margin:0;background:#f3f3f3!important;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;width:100%'>
        <tr style='padding:0;text-align:left;vertical-align:top'>
            <td class='center' align='center' valign='top' style='-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word'>
                <center data-parsed='' style='min-width:580px;width:100%'>
                    <table align='center' class='container float-center' style='Margin:0 auto;background:#fefefe;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px'>
                        <tbody>
                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                <td style='-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word'>
                                    <table class='row collapse' style='border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%'>
                                        <tbody>
                                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                                <th class='logo-container small-12 large-12 columns first last' style='Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:10px;padding-left:0;padding-right:0;padding-top:5px;text-align:left;width:588px'>
                                                    <table style='border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%'>
                                                        <tr style='padding:0;text-align:left;vertical-align:top'>
                                                            <th style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left'>
                                                                <center data-parsed='' style='min-width:532px;width:100%'><img class='logo float-center' src='https://www.servicioshosting.com/sitio/wp-content/uploads/2017/04/logo-min.png'
                                                                        alt='' align='center' style='-ms-interpolation-mode:bicubic;Margin:0 auto;clear:both;display:block;float:none;height:auto;margin:0 auto;max-width:100%;outline:0;text-align:center;text-decoration:none;width:420px'></center>
                                                            </th>
                                                            <th class='expander' style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0'></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class='row collapse' style='border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%'>
                                        <tbody>
                                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                                <th class='navbar small-12 large-12 columns first last' style='Margin:0 auto;background:#1B61AC;border-bottom:5px solid #F07D06;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:10px;padding-left:0;padding-right:0;padding-top:10px;text-align:left;width:588px'>
                                                    <table style='border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%'>
                                                        <tr style='padding:0;text-align:left;vertical-align:top'>
                                                            <th style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left'>
                                                                <center data-parsed='' style='min-width:532px;width:100%'><a class='nav-link float-center' href='https://www.servicioshosting.com/sitio/'
                                                                        align='center' style='Margin:0;color:#fff;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;margin-left:10px;margin-right:10px;padding:0;text-align:left;text-decoration:none;text-transform:uppercase'>Web</a>                                                                    <a class='nav-link float-center' href='http://blog.servicioshosting.com/'
                                                                        align='center' style='Margin:0;color:#fff;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;margin-left:10px;margin-right:10px;padding:0;text-align:left;text-decoration:none;text-transform:uppercase'>Blog</a>                                                                    <a class='nav-link float-center' href='https://www.servicioshosting.com/sitio/contactanos-2/'
                                                                        align='center' style='Margin:0;color:#fff;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;margin-left:10px;margin-right:10px;padding:0;text-align:left;text-decoration:none;text-transform:uppercase'>Contáctanos</a></center>
                                                            </th>
                                                            <th class='expander' style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0'></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align='center' class='container float-center' style='Margin:0 auto;background:#fefefe;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px'>
                        <tbody>
                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                <td style='-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word'>
                                    <table class='row' style='border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%'>
                                        <tbody>
                                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                                <th class='small-12 large-12 columns first last' style='Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:10px;padding-left:16px;padding-right:16px;text-align:left;width:564px'>
                                                    <table style='border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%'>
                                                        <tr style='padding:0;text-align:left;vertical-align:top'>
                                                            <th style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left'>

<p><i>Este es un correo generado automáticamente. Por favor no lo responda.</i></p>
<p>Hola $nombre_cliente_completo. </p>
<p>Se le recuerda que existe una incidencia para la cuenta <b>$dominio.</b></p> 
<p>$mensaje
<a href='$link'>Ver incidencia.</a></p>
<p>Monitoreo y Abuso ServiciosHosting.com</p>
</th>
                                                            <th class='expander' style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0'></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align='center' class='container footer float-center' style='Margin:0 auto;background:#1B61AC;border-collapse:collapse;border-spacing:0;border-top:5px solid #F07D06;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px'>
                        <tbody>
                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                <td style='-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word'>
                                    <table class='row' style='border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%'>
                                        <tbody>
                                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                                <th class='logo-container small-12 large-12 columns first last' style='Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:10px;padding-left:16px;padding-right:16px;padding-top:5px;text-align:left;width:564px'>
                                                    <table style='border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%'>
                                                        <tr style='padding:0;text-align:left;vertical-align:top'>
                                                            <th style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left'>
                                                                <center data-parsed='' style='min-width:532px;width:100%'>
                                                                    <a class='social-icon float-center' href='https://twitter.com/servitepuy?lang=es'
                                                                        align='center' style='Margin:0;color:#fff;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:22px;font-weight:400;line-height:1.3;margin:15px 7px 0;margin-bottom:10px;padding:0;text-align:center;text-decoration:none'><img width='45px' height='45px' src='https://www.servicioshosting.com/sitio/wp-content/uploads/2017/04/twitter-min.png'
                                                                            alt='' style='-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:45px;max-width:100%;outline:0;text-decoration:none;width:45px'></a>
                                                                    <a
                                                                        class='social-icon float-center' href='https://www.facebook.com/servicioshosting/?fref=ts'
                                                                        align='center' style='Margin:0;color:#fff;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:22px;font-weight:400;line-height:1.3;margin:15px 7px 0;margin-bottom:10px;padding:0;text-align:center;text-decoration:none'><img width='45px' height='45px' src='https://www.servicioshosting.com/sitio/wp-content/uploads/2017/04/facebook-min.png'
                                                                            alt='' style='-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:45px;max-width:100%;outline:0;text-decoration:none;width:45px'></a>
                                                                        <a
                                                                            class='social-icon float-center' href='https://www.instagram.com/servicioshosting/?hl=es'
                                                                            align='center' style='Margin:0;color:#fff;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:22px;font-weight:400;line-height:1.3;margin:15px 7px 0;margin-bottom:10px;padding:0;text-align:center;text-decoration:none'><img width='45px' height='45px' src='https://www.servicioshosting.com/sitio/wp-content/uploads/2017/04/instagram-min.png'
                                                                                alt='' style='-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:45px;max-width:100%;outline:0;text-decoration:none;width:45px'></a>
                                                                            <a
                                                                                class='social-icon float-center' href='https://t.me/servicioshostingvzla'
                                                                                align='center' style='Margin:0;color:#fff;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:22px;font-weight:400;line-height:1.3;margin:15px 7px 0;margin-bottom:10px;padding:0;text-align:center;text-decoration:none'><img width='45px' height='45px' src='https://www.servicioshosting.com/sitio/wp-content/uploads/2017/04/telegram-min.png'
                                                                                    alt='' style='-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:45px;max-width:100%;outline:0;text-decoration:none;width:45px'></a>
                                                                </center>
                                                            </th>
                                                            <th class='expander' style='Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0'></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class='row' style='border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%'>
                                        <tbody>
                                            <tr style='padding:0;text-align:left;vertical-align:top'>
                                                <center data-parsed='' style='min-width:580px;width:100%'><a href='' align='center' class='float-center' style='Margin:0;color:#fff;display:block;font-family:Helvetica,Arial,sans-serif;font-size:22px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center;text-decoration:none'>www.servicioshosting.com</a>
                                                    <p
                                                        class='text-center float-center' align='center' style='Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0 25px;text-align:center'>C.C. Mediterranean Plaza, Piso 3, Oficina No. P5-L01-OF08. Urb. Sabana
                                                        Larga, Valencia, Edo. Carabobo, Venezuela</p><span class='text-center float-center'
                                                            align='center' style='color:#fff;display:block;text-align:center;width:100%'>+58 241 825.32.66 / 241 824.64.37</span></center>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </td>
        </tr>
        </table>
        <!-- prevent Gmail on iOS font size manipulation -->
        <div style='display:none;white-space:nowrap;font:15px courier;line-height:0'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>
</html>                ";
    $objetoCorreo->Body = $correo;
    $objetoCorreo->AltBody = "Se ha reportado una nueva incidencia para su cuenta $dominio. Para ver, haga click en el siguiente link: $link";
    $objetoCorreo->send();
 endwhile;?>
 <script>location.href = '../reportes.php'</script>
