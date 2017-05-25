-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2017 a las 18:42:33
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shreportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre`) VALUES
(2, 'Servidor'),
(3, 'Hosting'),
(5, 'Direcciones IP'),
(6, 'VPS'),
(7, 'Cloud Linux');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` bigint(7) NOT NULL,
  `idreporte` bigint(7) DEFAULT NULL,
  `nick` char(20) DEFAULT NULL,
  `comentario` longtext,
  `fecha` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `idreporte`, `nick`, `comentario`, `fecha`) VALUES
(1, 1, 'Ronny', 'Probando', '2017-05-22 10:31:11'),
(2, 6, 'Ronny', 'f', '2017-05-22 11:01:37'),
(3, 10, 'Ronny', 'Probando Estatus', '2017-05-22 14:35:22'),
(4, 42, 'Ronny', 'Probando', '2017-05-23 09:16:10'),
(5, 43, 'Ronny', 'Probando', '2017-05-23 09:16:54'),
(6, 79, 'Ronny', 'Probando', '2017-05-23 11:47:00'),
(7, 79, 'Ronny 3', 'aas', '2017-05-23 11:48:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `idestatus` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`idestatus`, `nombre`) VALUES
(1, 'Resuelto'),
(2, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `replicacion`
--

CREATE TABLE `replicacion` (
  `idreplicacion` int(11) NOT NULL,
  `idreporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `replicacion`
--

INSERT INTO `replicacion` (`idreplicacion`, `idreporte`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idreporte` int(11) NOT NULL,
  `idestatus` int(11) DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `idreplicacion` int(11) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `observacion` longtext NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idreporte`, `idestatus`, `idcategoria`, `idreplicacion`, `titulo`, `autor`, `observacion`, `fecha`) VALUES
(1, 1, 1, 1, 'Prueba de hoy', 'Ronny', 'Probando hoy', '2017-05-22'),
(2, 1, 1, 2, 'Probando Modificar', 'Ronny', '', '2017-05-22'),
(3, 1, 1, 3, 'xd', 'Ronny', '', '2017-05-22'),
(4, 2, 1, 4, 's', 'Ronny', '', '2017-05-22'),
(5, NULL, 1, 5, 'Probando 2', 'Ronny', 'Probando 2', '2017-05-22'),
(6, NULL, 1, 6, 'xd', 'Ronny', 'xd', '2017-05-22'),
(7, 2, 1, 7, 'Prueba Modificar 2', 'Ronny', 'Probando', '2017-05-22'),
(8, 1, 1, 8, 'x', 'Ronny', 'x', '2017-05-22'),
(9, 1, 1, 9, 'Prueba', 'Ronny', 'Probando modificar', '2017-05-22'),
(10, 1, 1, 10, 'Probando enlace 9', 'Ronny', 'Probando enlace 10', '2017-05-22'),
(11, NULL, 1, 11, 'Probando Modificacion', 'Ronny', 'Probando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando ModificacionProbando Modificacion', '2017-05-22'),
(12, 3, 1, 12, 'Reporte Lunes 2', 'Ronny', 'Probando 2', '2017-05-22'),
(13, 2, 5, 13, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(14, 2, 7, 14, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(15, 2, 7, 15, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(16, 2, 7, 16, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(17, 2, 7, 17, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(18, 2, 7, 18, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(19, 2, 7, 19, 'Reporte Lunes', '', 'Probando', '2017-05-22'),
(20, 2, 4, 20, 'Reporte Lunes 2', '', 'Probando autor', '2017-05-22'),
(21, 2, 7, 21, 'Reporte Lunes 2', '', 'Probando autor', '2017-05-22'),
(22, 2, 7, 22, 'Reporte Lunes 2', '', 'Probando autor', '2017-05-22'),
(23, 2, 1, 23, 'as', 'Ronny', 'asa', '2017-05-22'),
(24, 2, 7, 24, 'as', '', 'asa', '2017-05-22'),
(25, 2, 1, 25, 'sas', 'Ronny', 'ass', '2017-05-22'),
(26, 2, 7, 26, 'sas', '', 'ass', '2017-05-22'),
(27, 2, 7, 27, 'sas', '', 'ass', '2017-05-22'),
(28, 2, 1, 28, 'Prueba', 'Ronny', 'Probando', '2017-05-22'),
(29, 2, 7, 29, 'Prueba', 'Ronny', 'Probando', '2017-05-22'),
(30, 2, 7, 30, 'Prueba', 'Ronny', 'Probando', '2017-05-22'),
(31, 2, 7, 31, 'Prueba', 'Ronny', 'Probando', '2017-05-22'),
(32, 2, 7, 32, 'Prueba', 'Ronny', 'Probando', '2017-05-22'),
(33, 2, 7, 33, 'Prueba de hoy', 'Ronny', 'Probando hoy', '2017-05-22'),
(34, 2, 5, 34, 'Prueba de hoy', 'Ronny', 'Probando hoy', '2017-05-22'),
(35, 2, 1, 35, 'dsd', 'Ronny', 'sds', '2017-05-22'),
(36, 2, 7, 36, 'dsd', 'Ronny', 'sds', '2017-05-22'),
(37, 2, 7, 37, 'dsd', 'Ronny', 'sds', '2017-05-22'),
(38, 2, 1, 38, 'Probando', 'Ronny', 'Probando', '2017-05-23'),
(39, 2, 7, 39, 'Probando', 'Ronny', 'Probando', '2017-05-23'),
(40, 2, 7, 40, 'Probando', 'Ronny', 'Probando', '2017-05-23'),
(41, 2, 6, 41, 'Probando', 'Ronny', 'Probando', '2017-05-23'),
(42, 2, 7, 42, 'Probando', 'Ronny', 'Probando', '2017-05-23'),
(43, 2, 1, 43, 'Prueba Ramon', 'Ronny', 'Probando', '2017-05-23'),
(44, 2, 1, 44, 'dsd', 'Ronny', 'sd', '2017-05-23'),
(45, 2, 2, 45, 'asa', 'Ronny', 'sas', '2017-05-23'),
(46, 2, 7, 46, 'asa', 'Ronny', 'sas', '2017-05-23'),
(47, 2, 7, 47, 'asa', 'Ronny', 'sas', '2017-05-23'),
(48, 2, 7, 48, 'asa', 'Ronny', 'sas', '2017-05-23'),
(49, 2, 6, 49, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(50, NULL, 7, 50, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(51, NULL, 7, 51, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(52, NULL, 7, 52, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(53, NULL, 3, 53, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(54, NULL, 7, 54, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(55, NULL, 7, 55, 'Prueba', 'Ronny', 'Probando', '2017-05-23'),
(56, NULL, 7, 56, 'Prueba', 'Ronny', '', '2017-05-23'),
(57, 2, 7, 57, 'Prueba', '0', '', '2017-05-23'),
(58, NULL, 7, 58, 'Prueba', '0', '', '2017-05-23'),
(59, NULL, 7, 59, 'Prueba', '0', '', '2017-05-23'),
(60, NULL, 2, 60, 'Prueba ', 'Ronny', 'Prueba Estado', '2017-05-23'),
(61, 1, 7, 61, 'Prueba ', 'Ronny', 'Prueba Estado', '2017-05-23'),
(62, 1, 3, 62, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(63, 1, 7, 63, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(64, 1, 7, 64, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(65, 1, 7, 65, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(66, 1, 7, 66, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(67, 2, 7, 67, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(68, 1, 7, 68, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(69, NULL, 7, 69, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(70, NULL, 7, 70, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(71, NULL, 7, 71, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(72, 1, 7, 72, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(73, 1, 7, 73, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(74, 2, 7, 74, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(75, 2, 7, 75, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(76, 2, 7, 76, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(77, 1, 7, 77, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(78, 2, 7, 78, 'Prueba 2', 'Ronny', 'Prueba Estad', '2017-05-23'),
(79, 2, 7, 79, 'Prueba', 'Ronny', 'Prueba Estado 2', '2017-05-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `clave`, `correo`) VALUES
(1, 'Ronny', '1234', 'rdgonzalez.2015@gmail.com'),
(2, 'Andres', '1234', 'andres.g@servitepuy.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idreporte` (`idreporte`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idestatus`);

--
-- Indices de la tabla `replicacion`
--
ALTER TABLE `replicacion`
  ADD PRIMARY KEY (`idreplicacion`),
  ADD KEY `idreporte` (`idreporte`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`idreporte`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idestatus` (`idestatus`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` bigint(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `replicacion`
--
ALTER TABLE `replicacion`
  MODIFY `idreplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idreporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
