-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2017 a las 22:55:39
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
(2, 0, 'cdksuministros.com.ve'),
(3, 0, 'mantelliniyasociados.com'),
(4, 0, 'amazinggeneralcontractor.com'),
(5, 0, 'loblan.com.ve'),
(6, 0, ''),
(7, 0, 'mariasantisima.edu.ve'),
(8, 0, 'careneroyachtclub.org.ve'),
(9, 0, 'Lista'),
(10, 0, 'colegioarandu.edu.ve '),
(11, 0, 'bitcoinswallet.biz 	'),
(12, 3798, 'www.prueba.com'),
(13, 3798, 'www.gonzalez2.com');

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
(1, 1, 0, 3, 2, 1, NULL, 804, 'a', 'asas', 'Ronny Gonzalez', '', '2017-08-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidores`
--

CREATE TABLE `servidores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` bigint(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dominios`
--
ALTER TABLE `dominios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servidores`
--
ALTER TABLE `servidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tiposdeusuarios`
--
ALTER TABLE `tiposdeusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
