<?php
$id_reporte = $_POST['id_reporte'];
$id_protegido = $_POST['id_protegido'];
$correo_autor = $_POST['correo_autor'];
$id_cliente = $_POST['id_cliente'];
$link = $_POST['link'];
echo $link."<br>";
echo $id_protegido."<br>";
echo $id_reporte."<br>";
echo $correo_autor."<br>";

require ('../config/conexion2.php');
$select_cliente = mysqli_query($conexion, "select * from tblclients where id = '$id_cliente' ")
        or die("Problemas en el select" . mysqli_error("$conexion"));
$fila = mysqli_fetch_array($select_cliente);
$correo_cliente = $fila['email'];
echo $correo_cliente;
//Función PHP Mailer:
require '../php_mailer/PHPMailerAutoload.php';
$objetoCorreo = new PHPMailer;

$objetoCorreo->isSMTP();
$objetoCorreo->Host = 'mail.servicioshosting.com'; // El proveedor nos proporciona este dato.
$objetoCorreo->SMTPAuth = true; // El proveedor nos proporciona este dato.
$objetoCorreo->SMTPSecure = 'ssl'; // Puede ser tls o ssl. El proveedor nos proporciona este dato.
$objetoCorreo->Port = 465; // El proveedor nos proporciona este dato.
//$objetoCorreo->SMTPDebug = 3;

$objetoCorreo->Username = 'cotizador@servicioshosting.com';
$objetoCorreo->Password = 'Atumedida2017/';

$objetoCorreo->setFrom('no-responder@servitepuy.com', 'ServiciosHosting.com');

$objetoCorreo->addAddress($correo_cliente, 'Destinatario');

$objetoCorreo->addReplyTo('no-responder@servitepuy.com', 'Respuestas');

$objetoCorreo->isHTML(true);

$objetoCorreo->CharSet = 'UTF-8'; // El correo irá codificado en UTF-8, para evitar problemas con letras acentuadas y otros caracteres especiales.

$objetoCorreo->Subject = 'Incidencia.';

$objetoCorreo->AddEmbeddedImage('../../img/logo_mini.jpg', 'logo_mini', 'logo_mini', 'base64', 'image/png');

$correo = "<p><i>Este es un correo generado automáticamentte. Por favor no lo responda.</i></p><h4>Se ha reportado una incidencia. Para ver, haga click aquí: <a target='_blank' href='$link'>Ver incidencia</a></h4> <p>Saludos Cordiales.</p> ";

$correo .= "<img src='cid:logo_mini'  />"; // OJO con la imagen. Hablaremos de esto en el próximo apartado.
//$objetoCorreo->Body = "Usted tiene una nueva cotizacion. Para ver, haga click en el siguiente link: $link";
$objetoCorreo->Body = $correo;

$objetoCorreo->AltBody = "Usted tiene una nueva cotizacion. Para ver, haga click en el siguiente link: $link";

$objetoCorreo->send();
?>
<script>location.href = '../reportes.php?reporte=<?php echo $id_protegido;?>'</script>
