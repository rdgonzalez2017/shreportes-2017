-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2017 a las 14:51:53
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servis8_shincidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(2, 'Spam'),
(3, 'Phishing'),
(4, 'ReputaciÃ³n'),
(5, 'Sobrecarga'),
(7, 'Recursos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` bigint(7) NOT NULL,
  `idreporte` bigint(7) DEFAULT NULL,
  `nick` varchar(50) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `comentario` longtext,
  `fecha` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `idreporte`, `nick`, `correo`, `comentario`, `fecha`) VALUES
(1, 7, 'Medardo Oliveros', 'medardo.a@clasesitdevenezuela.com', 'Buenas Tardes\r\n\r\nNo entiendo que significa esto pero asumirÃ© que la pÃ¡gina tiene mucha informaciÃ³n. Dicha pÃ¡gina estÃ¡ echa en wordpress y para limpiarla y eliminar imÃ¡genes y documentos necesito poder acceder pero la cuenta estÃ¡ suspendida. Â¿Como se soluciona esta situaciÃ³n?', '2017-07-14 12:59:21'),
(2, 7, 'Ramon Ernesto', 'ramon.n@servitepuy.com', 'Necesitamos su compromiso de revisar el cron del WP que estÃ¡ sobrecargando el servidor para poder activar su cuenta nuevamente', '2017-07-14 13:46:25'),
(3, 7, 'jose angel', 'jose.a@clasesitdevenezuela.com', 'ok esta bien le estaremos revisando esta pagina educativa y no ocupa espacio ', '2017-07-14 14:11:04'),
(4, 7, 'Ramon Ernesto', 'ramon.n@servitepuy.com', 'La cuenta fue activada. Estaremos esperando la revisiÃ³n.', '2017-07-14 14:14:48'),
(5, 8, 'Ramon Ernesto', 'ramon.n@servitepuy.com', 'Fueron eliminados los archivos encontrados comprometidos y la cuenta fue activa.', '2017-07-20 07:37:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominios`
--

CREATE TABLE `dominios` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `dominios`
--

INSERT INTO `dominios` (`id`, `id_cliente`, `nombre`) VALUES
(1, 0, 'estudiodigital.org.ve'),
(2, 6016, 'mantelliniyasociados.com'),
(3, 14, 'loblan.com.ve'),
(4, 0, 'mariasantisima.edu.ve'),
(5, 0, 'careneroyachtclub.org.ve'),
(6, 0, 'Lista'),
(7, 12395, 'colegioarandu.edu.ve '),
(8, 0, 'bitcoinswallet.biz 	');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `nombre`) VALUES
(1, 'Resuelto'),
(2, 'Pendiente'),
(3, 'En espera de comentarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `idestatus` int(11) DEFAULT '2',
  `idcategoria` int(11) DEFAULT NULL,
  `idservidor` int(11) DEFAULT NULL,
  `iddominio` int(11) DEFAULT NULL,
  `id_dominio_registrado` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `ticket` varchar(20) DEFAULT NULL,
  `autor` varchar(50) NOT NULL,
  `observacion` longtext,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `idusuario`, `id_cliente`, `idestatus`, `idcategoria`, `idservidor`, `iddominio`, `id_dominio_registrado`, `titulo`, `ticket`, `autor`, `observacion`, `fecha`) VALUES
(1, 1, 0, 1, 4, 1, 1, 0, 'Inconvenientes con la reputaciÃ³n de su sitio web', '', 'Ramon E. Navas', '<p>Saludos cordiales.-</p>\r\n<p>Le informamos que su sitio web se encuentra en la lista de dominios no seguros en&nbsp;<a href=\"https://www.safebrowsing.google.com/\">https://www.safebrowsing.google.com/</a> .</p>\r\n<p>Puede agregar su sitio en&nbsp;<a href=\"https://www.google.com/webmasters/#?modal_active=none\">https://www.google.com/webmasters/#?modal_active=none</a>&nbsp;para que posea una informaci&oacute;n m&aacute;s completa del inconveniente y as&iacute; pueda corregirlo.</p>\r\n<p>ServiciosHosting.com</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2017-06-15'),
(2, 1, 2363, 2, 4, 2, 0, 1865, 'Inconvenientes con la reputaciÃ³n de su sitio web', 'O232201', 'Ramon Ernesto', '<p style=\"text-align: left;\">Su sitio web cdksuministros.com.ve fue agregado a la lista de baja reputaci&oacute;n en internet ya que posee software malicioso.&nbsp;En estos casos todos los navegadores lo mantienen bloqueado.</p>\r\n<p style=\"text-align: left;\">Le recomendamos visitar el sitio <a href=\"https://safebrowsing.google.com/\">https://safebrowsing.google.com/</a>&nbsp;en la secci&oacute;n de webmaster donde recibir&aacute; ayuda para solucionar este inconveniente.</p>\r\n<p style=\"text-align: left;\">Saludos Cordiales.</p>', '2017-06-15'),
(3, 1, 6016, 1, 2, 3, 2, 0, 'EnvÃ­o de SPAM', 'J970004', 'Ramon Ernesto', '<p><code>1dNMZP-003Bjl-08-H</code></p>\r\n<p><code>mailnull 47 12</code></p>\r\n<p><code>&lt;pedrojmg@mantelliniyasociados.com&gt;</code></p>\r\n<p><code>1497978243 0</code></p>\r\n<p><code>-helo_name redsnow.com.au</code></p>\r\n<p><code>-host_address 182.50.130.67.53179</code></p>\r\n<p><code>-host_name sg2nw8shg145.shr.prod.sin2.secureserver.net</code></p>\r\n<p><code>-host_auth dovecot_login</code></p>\r\n<p><code>-interface_address 144.217.75.146.465</code></p>\r\n<p><code>-received_protocol esmtpsa</code></p>\r\n<p><code>-body_linecount 25</code></p>\r\n<p><code>-max_received_linelength 121</code></p>\r\n<p><code>-auth_id pedrojmg@mantelliniyasociados.com</code></p>\r\n<p><code>-tls_cipher TLSv1:DHE-RSA-AES256-SHA:256</code></p>\r\n<p><code>XX</code></p>\r\n<p><code>1</code></p>\r\n<p><code>jonduta@yahoo.com</code></p>\r\n<p><code>317P Received: from sg2nw8shg145.shr.prod.sin2.secureserver.net ([182.50.130.67]:53179 helo=redsnow.com.au)</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; by arauca.tepuyserver.net with esmtpsa (TLSv1:DHE-RSA-AES256-SHA:256)</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Exim 4.89)</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (envelope-from &lt;pedrojmg@mantelliniyasociados.com&gt;)</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; id 1dNMZP-003Bjl-08</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; for jonduta@yahoo.com; Tue, 20 Jun 2017 13:04:03 -0400</code></p>\r\n<p><code>038&nbsp; Date: Tue, 20 Jun 2017 10:04:00 -0700</code></p>\r\n<p><code>022T To: jonduta@yahoo.com</code></p>\r\n<p><code>049F From: Doreen &lt;pedrojmg@mantelliniyasociados.com&gt;</code></p>\r\n<p><code>053R Reply-To: Doreen &lt;pedrojmg@mantelliniyasociados.com&gt;</code></p>\r\n<p><code>065&nbsp; Subject: Pretty girl friends looking for a boyfriend to have sex</code></p>\r\n<p><code>062I Message-ID: &lt;4c50ab88479b6052996ff0aec0e3bb7c@redsnow.com.au&gt;</code></p>\r\n<p><code>068&nbsp; X-Mailer: PHPMailer 5.2.14 (https://github.com/PHPMailer/PHPMailer)</code></p>\r\n<p><code>018&nbsp; MIME-Version: 1.0</code></p>\r\n<p><code>085&nbsp; Content-Type: multipart/alternative;</code></p>\r\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; boundary=\"b1_4c50ab88479b6052996ff0aec0e3bb7c\"</code></p>\r\n<p><code>032&nbsp; Content-Transfer-Encoding: 8bit</code></p>\r\n<p><code>Data spool file</code></p>\r\n<p><code>1dNMZP-003Bjl-08-D</code></p>\r\n<p><code>This is a multi-part message in MIME format.</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code>--b1_4c50ab88479b6052996ff0aec0e3bb7c</code></p>\r\n<p><code>Content-Type: text/plain; charset=us-ascii</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code>Tired to masturbate all evenings through. Looking for a man for real relationship and wild sex. Ready to be mistress.</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code>My profile with photos here.</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code>--b1_4c50ab88479b6052996ff0aec0e3bb7c</code></p>\r\n<p><code>Content-Type: text/html; charset=us-ascii</code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code></code></p>\r\n<p><code></code></p>\r\n<p><code>Tired to masturbate all evenings through. Looking for a man for real relationship and wild sex. Ready to be mistress.<br /></code></p>\r\n<p><code>&nbsp;</code></p>\r\n<p><code><a href=\"http://zeiderfamily.com/error.php?o=61&amp;Cfd7mSR=UZiYk6Vwzm7&amp;Dtf=LTK&amp;6zvA=qW\">My profile with photos here.</a><br /></code></p>\r\n<p><code></code></p>\r\n<p><code></code></p>\r\n<p>&nbsp;</p>', '2017-06-20'),
(4, 1, 11618, 2, 5, 4, 0, 23389, 'Uso excesivo de recursos', 'A224806', 'Ramon Ernesto', '<p>Saludos Cordiales.-</p>\r\n<p>Se han observado procesos que est&aacute;n sobrecargando el CPU del servidor donde se encuentra su cuenta&nbsp;amazinggeneralcontractor.com :</p>\r\n<p><code>amazinggeneralcontractor.com 142 % CPU lsphp:/amazingg/public_html/wp-admin/admin-ajax.php</code></p>\r\n<p><code>amazinggeneralcontractor.com</code><code>&nbsp;99.6 % CPU lsphp:/home/amazingg/public_html/index.php</code></p>\r\n<p>Le recomendamos visitar este sitio donde se planea una posible soluci&oacute;n a este inconveniente:&nbsp;<a href=\"http://www.markomedia.com.au/admin-ajax-php-high-cpu-problem-solved/\">http://www.markomedia.com.au/admin-ajax-php-high-cpu-problem-solved/</a>&nbsp;</p>\r\n<p>ServiciosHosting.com<br />Monitoreo/Abuso</p>\r\n<p>&nbsp;</p>', '2017-06-27'),
(5, 2, 14, 2, 2, 5, 3, 0, 'SPAM: loblan.com.ve', '', 'Ramon A. Navas', '<p>/var/spool/exim/input/A/1dUuRA-0002Gs-KV-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/A/1dUuUA-0003G2-VG-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/A/1dUqHA-0000Lz-Vy-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/A/1dUsCA-0002IG-Dy-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUthG-0006aG-CG-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUteG-0005vz-76-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUsiG-0000k2-Nr-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUsFG-0002ka-TH-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUrUG-0001Xx-SD-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/G/1dUuUG-0003IK-Ol-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/q/1dUu9q-0005EP-1r-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/q/1dUufq-0005yK-5b-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/q/1dUsQq-0005L7-OY-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/q/1dUsWq-0006jP-Il-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/q/1dUpCq-00047D-50-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/7/1dUqQ7-00024v-5v-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/7/1dUr77-0001hR-9C-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/7/1dUtH7-00009t-Fw-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/7/1dUsF7-0002j9-MH-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/E/1dUqkE-0005od-Jn-H:-auth_id boots@loblan.com.ve<br />/var/spool/exim/input/E/1dUs0E-0008DO-EE-H:-auth_id boots@loblan.com.ve</p>\r\n<p>1dUuRA-0002Gs-KV-H<br />mailnull 47 12<br />&lt;boots@loblan.com.ve&gt;<br />1499776724 0<br />-helo_name northeastchem.com<br />-host_address 47.19.75.132.35401<br />-host_auth dovecot_login<br />-interface_address 144.217.67.238.587<br />-received_protocol esmtpsa<br />-body_linecount 29<br />-max_received_linelength 196<br />-auth_id boots@loblan.com.ve<br />-host_lookup_failed<br />-tls_cipher TLSv1:ECDHE-RSA-AES256-SHA:256<br />-tls_sni mail.loblan.com.ve<br />-tls_ourcert -----BEGIN CERTIFICATE-----\nMIIFIDCCBAigAwIBAgIQSnwMjUW+7kU+vX40MfovPzANBgkqhkiG9w0BAQsFADBy\nMQswCQYDVQQGEwJVUzELMAkGA1UECBMCVFgxEDAOBgNVBAcTB0hvdXN0b24xFTAT\nBgNVBAoTDGNQYW5lbCwgSW5jLjEtMCsGA1UEAxMkY1BhbmVsLCBJbmMuIENlcnRp\nZmljYXRpb24gQXV0aG9yaXR5MB4XDTE3MDcwMjAwMDAwMFoXDTE3MDkzMDIzNTk1\nOVowFTETMBEGA1UEAxMKbG9ibGFuLm5ldDCCASIwDQYJKoZIhvcNAQEBBQADggEP\nADCCAQoCggEBAKbeivhI1ESUaorlrmFeEhTjtyYenwBAqZjW7M9082cQaWMjQsIV\nD0h/P6YKp8cI0uJ5D3L+8/dc3jA2tQG4y3TcuZ3/rmaagQ6b0u0nSGz2iCu/0Wpk\nNKIzvHYHS7iLsxlQORynBLWkHI5MagQfR2NohMJvZYdgkR2CruTYku+RsEA+SG1w\nLBmdV63CvnAj9oY+YZSjErMbtH7J/eZsOjm84oqCefTW0afSbxIxvIkexgYBxNAI\nB93XdrphLD+nvnptJSeahFmmJdraEUPphBx9eSS+uAnH3YsZVE1gSmdX8AiniToh\nuslv2CjjjxVwqT6TzoPRK3aPjQdNGZCg38UCAwEAAaOCAg0wggIJMB8GA1UdIwQY\nMBaAFH4DWmVBa6d+CuG4nQjqHY4dasdlMB0GA1UdDgQWBBTw7mTI54uepzXJ0XH+\n9WByWrs2+TAOBgNVHQ8BAf8EBAMCBaAwDAYDVR0TAQH/BAIwADAdBgNVHSUEFjAU\nBggrBgEFBQcDAQYIKwYBBQUHAwIwTwYDVR0gBEgwRjA6BgsrBgEEAbIxAQICNDAr\nMCkGCCsGAQUFBwIBFh1odHRwczovL3NlY3VyZS5jb21vZG8uY29tL0NQUzAIBgZn\ngQwBAgEwTAYDVR0fBEUwQzBBoD+gPYY7aHR0cDovL2NybC5jb21vZG9jYS5jb20v\nY1BhbmVsSW5jQ2VydGlmaWNhdGlvbkF1dGhvcml0eS5jcmwwfQYIKwYBBQUHAQEE\ncTBvMEcGCCsGAQUFBzAChjtodHRwOi8vY3J0LmNvbW9kb2NhLmNvbS9jUGFuZWxJ\nbmNDZXJ0aWZpY2F0aW9uQXV0aG9yaXR5LmNydDAkBggrBgEFBQcwAYYYaHR0cDov\nL29jc3AuY29tb2RvY2EuY29tMGwGA1UdEQRlMGOCCmxvYmxhbi5uZXSCDWxvYmxh\nbi5jb20udmWCEm1haWwubG9ibGFuLmNvbS52ZYIPbWFpbC5sb2JsYW4ubmV0ghF3\nd3cubG9ibGFuLmNvbS52ZYIOd3d3LmxvYmxhbi5uZXQwDQYJKoZIhvcNAQELBQAD\nggEBAEcSvvVZVsG9o7yNdyxgXtlu7CB8CxAXQUZQy+vWoFNOmGnXIX5wKCDd5WMu\ni08Cc9b2v8i8H5awI+GVtYReVn2ULRVEM4g1iYmZz8EOUu+kgwkXc3jEOEgxck9o\nMFreywvefsFU89fTej2leURXhdlnjZmaRBvohZSfOa8YaQv1uOKiQfUGA3+dNH7C\nRmSKd2W0zgqmoVyICKdoM2RlXKdcMESDMhGlzAGiqVklmmY2EibRZs1KRiQwJTDz\naoxfzQtjp2LZn8uZq+qSXpdUY1Zlg5JY1zoKEyNlRVbn4vvkJCA78yr9aecT9TP9\nUzHm5DCAlsQ9y43l97qhn1RRKSo=\n-----END CERTIFICATE-----\n<br />XX<br />1<br />owenongeri@yahoo.com</p>\r\n<p>270P Received: from [47.19.75.132] (port=35401 helo=northeastchem.com)<br /> by apure.tepuyserver.net with esmtpsa (TLSv1:ECDHE-RSA-AES256-SHA:256)<br /> (Exim 4.89)<br /> (envelope-from &lt;boots@loblan.com.ve&gt;)<br /> (Exim 4.89)<br /> (envelope-from &lt;boots@loblan.com.ve&gt;)<br /> id 1dUuRA-0002Gs-KV<br /> for owenongeri@yahoo.com; Tue, 11 Jul 2017 08:38:44 -0400<br />038 Date: Tue, 11 Jul 2017 08:38:43 -0400<br />025T To: owenongeri@yahoo.com<br />040F From: \"Brandy U.\" &lt;boots@loblan.com.ve&gt;<br />044R Reply-To: \"Brandy U.\" &lt;boots@loblan.com.ve&gt;<br />029 Subject: Dating for anal sex<br />065I Message-ID: &lt;fc961d2fc3cadee65da348a0811f7a29@northeastchem.com&gt;<br />068 X-Mailer: PHPMailer 5.2.23 (https://github.com/PHPMailer/PHPMailer)<br />018 MIME-Version: 1.0<br />085 Content-Type: multipart/alternative;<br /> boundary=\"b1_fc961d2fc3cadee65da348a0811f7a29\"<br />032 Content-Transfer-Encoding: 8bit</p>', '2017-07-11'),
(6, 1, 0, 2, 2, 1, 0, 0, 'EnvÃ­o de SPAM', '', 'Ramon Ernesto', '<p>A continuaci&oacute;n se le anexa detalles del SPAM:</p>\r\n<p>2017-07-12 05:45:17 cwd=/var/spool/exim 3 args: /usr/sbin/exim -Mc 1dVECr-0006BG-Kq2017-07-12 05:45:17 cwd=/var/spool/exim 3 args: /usr/sbin/exim -Mc 1dVECr-0006BG-Kq<br />2017-07-12 05:46:25 cwd=/usr/local/cpanel/whostmgr/docroot 3 args: exim -Mvh 1dVECr-0006BG-Kq<br />2017-07-12 05:46:25 cwd=/usr/local/cpanel/whostmgr/docroot 3 args: exim -Mvb 1dVECr-0006BG-Kq<br />+++ 1dVECr-0006BG-Kq has not completed +++2017-07-12 05:45:17 1dVECr-0006BG-Kq &lt;= angelpaz@ventuari.tepuyserver.net U=angelpaz P=local S=1718 id=12736db32794314233b2e2429cbe1c17@angelpaz.com.ve T=\"[301ngel Paz] Comentario: \"12711066_991888104179968_836292770027113385_o\"\" for enposdemultitudes@gmail.com2017-07-12 05:45:17 1dVECr-0006BG-Kq SMTP connection outbound 1499852717 1dVECr-0006BG-Kq angelpaz.com.ve enposdemultitudes@gmail.com2017-07-12 05:46:49 1dVECr-0006BG-Kq Spool file is locked (another process is handling this message)2017-07-12 05:47:25 1dVECr-0006BG-Kq H=gmail-smtp-in.l.google.com [74.125.29.27] Connection timed out2017-07-12 05:49:32 1dVECr-0006BG-Kq H=alt3.gmail-smtp-in.l.google.com [173.194.76.27] Connection timed out<br />cmq: v2.07&copy;2006-2017, ConfigServer Services (Way to the Web Limited)</p>\r\n<p>angelpaz 1108 993&lt;angelpaz@ventuari.tepuyserver.net&gt;1499852717 0-ident angelpaz-received_protocol local-body_linecount 20-max_received_linelength 117-auth_id angelpaz-auth_sender angelpaz@ventuari.tepuyserver.net-allow_unqualified_recipient-allow_unqualified_sender-deliver_firsttime-localXX1enposdemultitudes@gmail.com<br />215P Received: from angelpaz by ventuari.tepuyserver.net with local (Exim 4.89) (envelope-from &lt;angelpaz@ventuari.tepuyserver.net&gt;) id 1dVECr-0006BG-Kq for enposdemultitudes@gmail.com; Wed, 12 Jul 2017 05:45:17 -0400032T To: enposdemultitudes@gmail.com118 &nbsp;Subject: =?UTF-8?Q?[=C3=81ngel_Paz]_Comentario:_\"12711066=5F991888104179968=5F8362?= &nbsp;=?UTF-8?Q?92770027113385=5Fo\"?=068 &nbsp;X-PHP-Script: angelpaz.com.ve/wp-comments-post.php for 144.76.242.4051 &nbsp;X-PHP-Originating-Script: 1108:class-phpmailer.php038 &nbsp;Date: Wed, 12 Jul 2017 09:45:17 +0000042F From: VianBog &lt;wordpress@angelpaz.com.ve&gt;064R Reply-To: \"\"loi.der2018@yandex.com\"\" &lt;loi.der2018@yandex.com&gt;063I Message-ID: &lt;12736db32794314233b2e2429cbe1c17@angelpaz.com.ve&gt;068 &nbsp;X-Mailer: PHPMailer 5.2.22 (https://github.com/PHPMailer/PHPMailer)018 &nbsp;MIME-Version: 1.0040 &nbsp;Content-Type: text/plain; charset=UTF-8032 &nbsp;Content-Transfer-Encoding: 8bitData spool file1dVECr-0006BG-Kq-DNuevo comentario en tu entrada \"12711066_991888104179968_836292770027113385_o\"Autor: VianBog (IP: 144.76.242.4, static.4.242.76.144.clients.your-server.de)Correo electr&oacute;nico: loi.der2018@yandex.comURL: http://cheapuviagra.com/Comentario:&nbsp;viagra price in dubai&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; [url=http://cheapuviagra.com/]viagra online[/url]&nbsp;&nbsp;&nbsp; &nbsp; &lt;a href=\"http://cheapuviagra.com/\" rel=\"nofollow\"&gt;online viagra&lt;/a&gt;&nbsp;&nbsp;&nbsp; &nbsp; viagra on sale uk.<br />Puedes ver todos los comentarios de esta entrada aqu&iacute;:http://angelpaz.com.ve/12711066_991888104179968_836292770027113385_o/#comments</p>\r\n<p>Enlace permanente: http://angelpaz.com.ve/12711066_991888104179968_836292770027113385_o/#comment-14220Enviar a la papelera: http://angelpaz.com.ve/wp-admin/comment.php?action=trash&amp;c=14220#wpbody-contentMarcarlo como spam: http://angelpaz.com.ve/wp-admin/comment.php?action=spam&amp;c=14220#wpbody-content</p>', '2017-07-12'),
(7, 1, 0, 1, 5, 6, 4, 0, 'Exceso de uso del CPU', '', 'Ramon Ernesto', '<p>Servicio supendido por exceso de uso del CPU:</p>\r\n<p>mariasantisima <strong>140% CPU</strong> lsphp:iasantisima/public_html/wordpress/wp-cron.php<br />mariasantisima <strong>107% CPU</strong> lsphp:iasantisima/public_html/wordpress/wp-cron.php</p>\r\n<p>Monitoreo y Abuso<br />ServiciosHosting.com</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2017-07-13'),
(8, 1, 0, 2, 2, 2, 5, 0, 'EnvÃ­o de SPAM', '', 'Ramon Ernesto', '<p>Se ha procedido a la suspensi&oacute;n de la cuenta&nbsp;<strong>careneroyachtclub.org.ve&nbsp;</strong>por env&iacute;o de SPAM:</p>\r\n<p>&nbsp;</p>\r\n<p>21026 cwd=/home/careneroyachtclu/public_html</p>\r\n<p><br />1dXCG6-001Cs0-CB-Hmailnull 47 12&lt;&gt;1500321886 0-ident mailnull-received_protocol local-body_linecount 56-max_received_linelength 141-allow_unqualified_recipient-allow_unqualified_sender-frozen 1500321914-localerrorXX1atencionalsocio@<br />177P Received: from mailnull by capanaparo.tepuyserver.net with local (Exim 4.89) id 1dXCG6-001Cs0-CB for atencionalsocio@careneroyachtclub.org.ve; Mon, 17 Jul 2017 16:04:46 -0400038 &nbsp;X-Failed-Recipients: 101403031@qq.com029 &nbsp;Auto-Submitted: auto-replied070F From: Mail Delivery System &lt;Mailer-Daemon@capanaparo.tepuyserver.net&gt;045T To: atencionalsocio@careneroyachtclub.org.ve100 &nbsp;Content-Type: multipart/report; report-type=delivery-status; boundary=1500321886-eximdsn-1198011316018 &nbsp;MIME-Version: 1.0059 &nbsp;Subject: Mail delivery failed: returning message to sender059I Message-Id: &lt;E1dXCG6-001Cs0-CB@capanaparo.tepuyserver.net&gt;038 &nbsp;Date: Mon, 17 Jul 2017 16:04:46 -0400Data spool file1dXCG6-001Cs0-CB-D--1500321886-eximdsn-1198011316Content-type: text/plain; charset=us-ascii<br />This message was created automatically by mail delivery software.<br />A message that you sent could not be delivered to one or more of itsrecipients. This is a permanent error. The following address(es) failed:<br />&nbsp; 101403031@qq.com&nbsp; &nbsp; host mx3.qq.com [203.205.160.43]&nbsp; &nbsp; SMTP error from remote mail server after RCPT TO:&lt;101403031@qq.com&gt;:&nbsp; &nbsp; 550 Connection frequency limited. http://service.mail.qq.com/cgi-bin/help?subtype=1&amp;&amp;id=20022&amp;&amp;no=1000722<br />--1500321886-eximdsn-1198011316Content-type: message/delivery-status<br />Reporting-MTA: dns; capanaparo.tepuyserver.net<br />Action: failedFinal-Recipient: rfc822;101403031@qq.comStatus: 5.0.0Remote-MTA: dns; mx3.qq.comDiagnostic-Code: smtp; 550 Connection frequency limited. http://service.mail.qq.com/cgi-bin/help?subtype=1&amp;&amp;id=20022&amp;&amp;no=1000722<br />--1500321886-eximdsn-1198011316Content-type: message/rfc822<br />Return-path: &lt;atencionalsocio@careneroyachtclub.org.ve&gt;Received: from careneroyachtclu by capanaparo.tepuyserver.net with local (Exim 4.89) (envelope-from &lt;atencionalsocio@careneroyachtclub.org.ve&gt;) id 1dXCFu-001Cez-0j for 101403031@qq.com; Mon, 17 Jul 2017 16:04:34 -0400To: 101403031@qq.comSubject: =?utf-8?B?Q29waWEgZGU6IOaXoOmcgOWHuuWbve+8jOWcqOWutuWwseWPr+eOr+eQgw==?= &nbsp;=?utf-8?B?5Lu75oCn5Zeo5ZOm?=X-PHP-Script: careneroyachtclub.org.ve/index.php for 180.104.253.185X-PHP-Filename: /home/careneroyachtclu/public_html/index.php REMOTE_ADDR: 180.104.253.185Date: Mon, 17 Jul 2017 15:34:32 -0430From: Carenero Yacht Club &lt;atencionalsocio@careneroyachtclub.org.ve&gt;Reply-To: =?utf-8?B?6Z+25pid5oCA?= &lt;101403031@qq.com&gt;Message-ID: &lt;13bf91cb41ccc1e72fe997c2bc7d9568@careneroyachtclub.org.ve&gt;X-Priority: 3X-Mailer: PHPMailer 5.2.1 (http://code.google.com/a/apache-extras.org/p/phpmailer/)MIME-Version: 1.0Content-Transfer-Encoding: 8bitContent-Type: text/plain; charset=\"utf-8\"<br />Esto es una copia del mensaje que envi&oacute; a &nbsp;v&iacute;a Carenero</p>', '2017-07-17'),
(10, 1, 12395, 1, 7, 2, 7, 0, 'Uso excesivo de espacio en disco', '', 'Ramon Ernesto', '<p>La cuenta colegioarandu.edu.ve esta produciendo el siguiente archivo:</p>\r\n<p><code>/home/colegioa/public_html/error_log</code></p>\r\n<p>de gran tama&ntilde;o y est&aacute; consumiendo espacio en disco de manera excesiva. Se program&oacute; provisionalmente un cron que lo borra cada hora.</p>\r\n<p>Le invitamos a revisar lo antes posible los procesos que est&aacute;n originando esa cantidad inusual de registro de errores.&nbsp;</p>\r\n<p>&nbsp;</p>', '2017-07-20'),
(11, 1, 0, 1, 2, 5, 8, 0, 'EnvÃ­o de SPAM', '', 'Ramon Ernesto', '<p>Cuenta suspendida por env&iacute;o de SPAM:</p>\r\n<p>1ddI7T-0004Q9-Kr-H<br />bitcoinswallet 1311 993<br />&lt;bitcoinswallet@apure.tepuyserver.net&gt;<br />1501774383 0<br />-ident bitcoinswallet<br />-received_protocol local<br />-body_linecount 8<br />-max_received_linelength 160<br />-auth_id bitcoinswallet<br />-auth_sender bitcoinswallet@apure.tepuyserver.net<br />-allow_unqualified_recipient<br />-allow_unqualified_sender<br />-local<br />-sender_set_untrusted<br />XX<br />1<br />16525165@bitcoinwalletscript.tk</p>\r\n<p>225P Received: from bitcoinswallet by apure.tepuyserver.net with local (Exim 4.89)<br /> (envelope-from &lt;bitcoinswallet@apure.tepuyserver.net&gt;)<br /> id 1ddI7T-0004Q9-Kr<br /> for 16525165@bitcoinwalletscript.tk; Thu, 03 Aug 2017 11:33:03 -0400<br />039* From: \"(Cron Daemon)\" <br />061F From: \"(Cron Daemon)\" &lt;bitcoinswallet@apure.tepuyserver.net&gt;<br />036T To: 16525165@bitcoinwalletscript.tk<br />095 Subject: Cron &lt;bitcoinswallet@apure&gt; /usr/bin/php -q /home/bitcoinswallet/public_html/cron.php<br />040 Content-Type: text/plain; charset=UTF-8<br />031 Auto-Submitted: auto-generated<br />017 Precedence: bulk<br />036 X-Cron-Env: &lt;XDG_SESSION_ID=153346&gt;<br />045 X-Cron-Env: &lt;XDG_RUNTIME_DIR=/run/user/1311&gt;<br />031 X-Cron-Env: &lt;LANG=en_US.UTF-8&gt;<br />053 X-Cron-Env: &lt;MAILTO=16525165@bitcoinwalletscript.tk&gt;<br />052 X-Cron-Env: &lt;SHELL=/usr/local/cpanel/bin/jailshell&gt;<br />053 X-Cron-Env: &lt;MAILTO=16525165@bitcoinwalletscript.tk&gt;<br />052 X-Cron-Env: &lt;SHELL=/usr/local/cpanel/bin/jailshell&gt;<br />040 X-Cron-Env: &lt;HOME=/home/bitcoinswallet&gt;<br />033 X-Cron-Env: &lt;PATH=/usr/bin:/bin&gt;<br />037 X-Cron-Env: &lt;LOGNAME=bitcoinswallet&gt;<br />034 X-Cron-Env: &lt;USER=bitcoinswallet&gt;<br />054I Message-Id: &lt;E1ddI7T-0004Q9-Kr@apure.tepuyserver.net&gt;<br />038 Date: Thu, 03 Aug 2017 11:33:03 -0400</p>', '2017-08-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidores`
--

CREATE TABLE `servidores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `servidores`
--

INSERT INTO `servidores` (`id`, `nombre`) VALUES
(1, 'Cunaviche'),
(2, 'Capanaparo'),
(3, 'Arauca'),
(4, 'Caura'),
(5, 'Apure'),
(6, 'Ventuari'),
(7, 'NIC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdeusuarios`
--

CREATE TABLE `tiposdeusuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tiposdeusuarios`
--

INSERT INTO `tiposdeusuarios` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Operador I'),
(3, 'Operador II');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `idtipodeusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombrecompleto` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `idtipodeusuario`, `nombre`, `nombrecompleto`, `clave`, `correo`) VALUES
(1, 1, 'ramon.n', 'Ramon Ernesto', '6f38fa76a6967ce0aa39d4bd2d1b741a', 'ramon.n@servitepuy.com'),
(2, 1, 'ramon.nt', 'Ramon A. Navas', '817544909e8a6f60ee0ebe0968a50747', 'ramon.nt@servitepuy.com'),
(3, 1, 'karina.n', 'Karina Navas', '59e0a02924d90ea0f0952f19cfd09705', 'karina.n@servitepuy.com'),
(4, 1, 'miguel.n', 'Miguel Navas', '950f1dae2c97ef133af4b3eb53b62d3d', 'miguel.n@servitepuy.com'),
(5, 1, 'desarrollador', 'Ronny Gonzalez', '81dc9bdb52d04dc20036dbd8313ed055', 'ronny.g@servitepuy.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idreporte` (`idreporte`);

--
-- Indices de la tabla `dominios`
--
ALTER TABLE `dominios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idestatus` (`idestatus`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idservidor` (`idservidor`),
  ADD KEY `iddominio` (`iddominio`),
  ADD KEY `id_dominio_registrado` (`id_dominio_registrado`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `servidores`
--
ALTER TABLE `servidores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiposdeusuarios`
--
ALTER TABLE `tiposdeusuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtipodeusuario` (`idtipodeusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` bigint(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `dominios`
--
ALTER TABLE `dominios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `servidores`
--
ALTER TABLE `servidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tiposdeusuarios`
--
ALTER TABLE `tiposdeusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
