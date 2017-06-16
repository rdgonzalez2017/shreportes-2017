-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2017 a las 15:54:07
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `multiser_shreportes`
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
  `nick` varchar(50) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `comentario` longtext,
  `fecha` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddominio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`iddominio`, `nombre`) VALUES
(12, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(13, 'www.nuevo.com'),
(3, 'www.sh.com');

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
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idreporte` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idestatus` int(11) DEFAULT '2',
  `idcategoria` int(11) DEFAULT NULL,
  `idservidor` int(11) DEFAULT NULL,
  `iddominio` int(11) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `observacion` longtext,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idreporte`, `idusuario`, `idestatus`, `idcategoria`, `idservidor`, `iddominio`, `titulo`, `autor`, `observacion`, `fecha`) VALUES
(20, 1, 2, 2, 1, 13, 'Probando', 'Ronny Gonzalez', '<p>Prueba</p>', '2017-06-14'),
(19, 1, 2, 2, 1, 13, 'Probando', 'Ronny Gonzalez', '<p>Prueba</p>', '2017-06-14'),
(17, 1, 2, 2, 1, 3, 'as', 'Ronny Gonzalez', '<p>a</p>', '2017-06-14'),
(18, 1, 2, 2, 1, 3, 'a', 'Ronny Gonzalez', '<p>a</p>', '2017-06-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidor`
--

CREATE TABLE `servidor` (
  `idservidor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servidor`
--

INSERT INTO `servidor` (`idservidor`, `nombre`) VALUES
(1, 'Orinoco'),
(2, 'Araure');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeusuario`
--

CREATE TABLE `tipodeusuario` (
  `idtipodeusuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipodeusuario`
--

INSERT INTO `tipodeusuario` (`idtipodeusuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Operador I'),
(3, 'Operador II');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idtipodeusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idtipodeusuario`, `nombre`, `clave`, `correo`) VALUES
(1, 1, 'Ronny Gonzalez', '1234', 'ronny.g@servitepuy.com'),
(3, 1, 'Ramon E. Navas', '1234', 'ramon.n@servitepuy.com '),
(4, 1, 'Ramon A. Navas', '1234', 'ramon.nt@servitepuy.com '),
(9, 2, 'Operador', '1', 'operador1@prueba.com');

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
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddominio`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idestatus`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`idreporte`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idestatus` (`idestatus`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idservidor` (`idservidor`),
  ADD KEY `iddominio` (`iddominio`);

--
-- Indices de la tabla `servidor`
--
ALTER TABLE `servidor`
  ADD PRIMARY KEY (`idservidor`);

--
-- Indices de la tabla `tipodeusuario`
--
ALTER TABLE `tipodeusuario`
  ADD PRIMARY KEY (`idtipodeusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idtipodeusuario` (`idtipodeusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` bigint(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idreporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `servidor`
--
ALTER TABLE `servidor`
  MODIFY `idservidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipodeusuario`
--
ALTER TABLE `tipodeusuario`
  MODIFY `idtipodeusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
