-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2017 a las 04:08:46
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `fecha` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(50) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `id_local` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `id_usuario`, `fecha`, `precio`, `cantidad`, `id_local`) VALUES
(9, 18, '0001-11-11 11:11', 90, 1, 1),
(10, 18, '0011-11-11 11:11', 20, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE IF NOT EXISTS `locales` (
  `id` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `foto1` varchar(50) NOT NULL DEFAULT 'sinfoto.jpg',
  `foto2` varchar(50) NOT NULL DEFAULT 'sinfoto.jpg',
  `foto3` varchar(50) NOT NULL DEFAULT 'sinfoto.jpg'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`id`, `direccion`, `cp`, `foto1`, `foto2`, `foto3`) VALUES
(1, 'Av. Centenario 512', 'San Isidro', 'local1f1.jpg', 'local1f2.jpg', 'local1f3.jpg'),
(2, 'Alvear 2894', 'San Martin', 'local2f1.jpg', 'local2f2.jpg', 'local2f3.jpg'),
(3, ' Av. Rivadavia 11704', 'CABA', 'local3f1.jpg', 'local3f2.jpg', 'local3f3.jpg'),
(4, 'Av. Galicia 597', 'Avellaneda', 'local4f1.jpg', 'local4f2.jpg', 'local4f3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_local` int(11) NOT NULL,
  `precio` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `id_local`, `precio`, `cantidad`, `estado`, `descripcion`) VALUES
(35, 23, 2, '22', 22, 'Pedido', 'Pizza Muzzarella'),
(37, 4, 1, '90', 3, 'Pedido', 'Pizza napolitana'),
(39, 4, 1, '80', 1, 'Pedido', 'Pizza muzzarella'),
(40, 4, 1, '80', 2, 'Pedido', 'Pizza muzzarella'),
(41, 18, 3, '90', 1, 'Pedido', 'Pizza napolitana'),
(42, 18, 4, '90', 1, 'Pedido', 'Pizza napolitana'),
(43, 18, 1, '90', 1, 'Pedido', 'Pizza napolitana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `precio` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `categoria`, `precio`) VALUES
(1, 'Pizza muzzarella', 'Comida', 80),
(2, 'Agua mineral', 'Bebida', 20),
(3, 'Pizza napolitana', 'Comida', 90),
(4, 'Faina', 'Comida', 10),
(5, 'Empanada carne', 'Comida', 15),
(6, 'Helado', 'Postre', 11),
(7, 'Porción de fugazzeta rellena', 'Comida', 30),
(8, 'Gaseosa cola', 'Bebida', 20),
(9, 'Empanada de Pollo', 'Comida', 8),
(10, 'Empanada de Limon', 'Comida', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `local` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(100) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_usuario`, `local`, `fecha`, `cantidad`) VALUES
(10, 16, '3', '0022-02-22 14:22', 2),
(11, 16, '1', '0022-02-22 14:22', 2),
(12, 18, '1', '0002-02-22 14:22', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) unsigned NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `perfil` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `sexo`, `perfil`, `password`) VALUES
(1, 'Administrador', 'Administrador', 'admin@admin.com', 'M', 'Administrador', '1234'),
(2, 'Cristian', 'Varela', 'encargado@encargado.com', 'M', 'Encargado', '1234'),
(3, 'Eric', 'Lamela', 'elamela@gmail.com', 'M', 'Empleado', '1234'),
(4, 'Octavio', 'Villegas', 'octaviovillegas@gmail.com', 'M', 'Empleado', '1234'),
(5, 'Juliet', 'Diaz', 'julietadiaz@hotmail.com', 'F', 'Empleado', '1234'),
(18, 'row', 'wil', 'rwilliam@yahoo.com.ar', 'M', 'Cliente', '1234'),
(24, 'Cristian', 'Varelita', 'cvarelagarcia@gmail.com', 'M', 'Cliente', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
