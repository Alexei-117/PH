-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2016 a las 18:13:59
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `IdAlbum` int(11) NOT NULL,
  `Titulo` text CHARACTER SET latin1 NOT NULL,
  `Descripcion` text CHARACTER SET latin1 NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Usuario`) VALUES
(1, 'Album 1', 'Album de ejemplo 1', '2016-11-01', 1, 1),
(2, 'Album 2', 'Album de ejemplo 2', '2016-11-02', 2, 2),
(3, 'Album 3', 'Album de ejemplo 3', '2016-11-03', 3, 3),
(4, 'Album 4', 'Album de ejemplo 4', '2016-11-04', 4, 1),
(5, 'Album 5', 'Album de ejemplo  5', '2016-11-05', 1, 1),
(63, 'Asdasd', '', '2016-12-08', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `titulo` text CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `fecha` date DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `album` int(11) DEFAULT NULL,
  `fichero` text CHARACTER SET latin1 NOT NULL,
  `fRegistro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`idFoto`, `titulo`, `descripcion`, `fecha`, `pais`, `album`, `fichero`, `fRegistro`) VALUES
(1, 'selfie', 'Una foto que me saqué en la boda de mi hermana', '2015-03-14', 1, 2, 'img/te_fo.jpg', '2016-11-23 00:00:00'),
(3, 'party with my work mates!', 'A picture with my friends at the party of our aunt Mary Sunshine :D', '2015-02-15', 3, 3, 'img/si_o_que.jpg', '0000-00-00 00:00:00'),
(5, 'yo guapo', 'Miradme', '2015-04-03', 1, 0, 'img/tio_maquina.jpg', '2016-11-24 00:00:00'),
(6, 'my son''s first draw', 'Very porud of him! :)D', '2014-02-14', 2, 4, 'img/lacara.png', '2016-11-09 00:00:00'),
(7, 'fgh', 'La buena foto', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(8, 'fgh', 'La buena foto', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(9, 'fgh', 'Sin descripciÃ³n', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(10, 'fgh', 'Sin descripciÃ³n', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(11, 'fgh', 'Sin descripciÃ³n', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(12, 'fgh', 'Sin descripciÃ³n', '2016-12-13', 1, 4, 'ghj', '2016-12-01 00:00:00'),
(13, 'asdasd', 'Sin descripción', '2016-12-01', 1, 1, 'img/soy_guapa.jpg', '2016-12-01 00:00:00'),
(14, 'asdasd', 'Sin descripción', '2016-12-01', 1, 1, 'img/soy_guapa.jpeg', '2016-12-01 00:00:00'),
(15, 'asdasd', 'Sin descripción', '2016-12-02', 1, 1, 'img/soy_guapa.jpeg', '2016-12-01 00:00:00'),
(16, 'asdasd', 'Sin descripción', '2016-12-02', 1, 1, 'img/soy_guapa.jpeg', '2016-12-01 00:00:00'),
(17, 'asdasd', 'Sin descripción', '2016-12-16', 3, 4, 'img/lacara.png', '2016-12-01 00:00:00'),
(18, 'asdasd', 'Sin descripción', '2016-12-16', 3, 4, 'img/lacara.png', '2016-12-01 00:00:00'),
(19, 'asdad', 'Sin descripción', '2016-12-16', 1, 1, 'img/lacara.png', '2016-12-01 00:00:00'),
(20, 'hola', '', '2016-12-08', 1, 63, 'img/soy_guapa.jpg', '2016-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Argentina'),
(3, 'Francia'),
(4, 'Alemania');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Nombre` text CHARACTER SET latin1 NOT NULL,
  `Titulo` text CHARACTER SET latin1 NOT NULL,
  `Descripcion` text CHARACTER SET latin1 NOT NULL,
  `Email` text CHARACTER SET latin1 NOT NULL,
  `Direccion` text CHARACTER SET latin1 NOT NULL,
  `Color` text CHARACTER SET latin1 NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` datetime NOT NULL,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`IdSolicitud`, `Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) VALUES
(1, 1, 'asdasd', 'asdasd', 'asdasdasdasd', 'asdasd@asdasd.com', 'asdasd', '#ff8040', 3, 150, '0000-00-00', 0, '0000-00-00 00:00:00', 2.048),
(2, 1, 'asdasd', 'asdasd', 'asdasdasdasd', 'asdasd@asdasd.com', 'asdasd', '#ff8040', 3, 150, '0000-00-00', 0, '0000-00-00 00:00:00', 2.048),
(3, 1, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdf@sdf.com', 'df', '#000000', 1, 150, '0000-00-00', 1, '0000-00-00 00:00:00', 2.016),
(4, 1, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdf@sdf.com', 'df', '#000000', 1, 150, '0000-00-00', 1, '0000-00-00 00:00:00', 2.016),
(5, 1, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdf@sdf.com', 'df', '#000000', 1, 150, '0000-00-00', 1, '0000-00-00 00:00:00', 2.016),
(6, 1, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdf@sdf.com', 'df', '#000000', 1, 150, '0000-00-00', 1, '0000-00-00 00:00:00', 2.016);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` text CHARACTER SET latin1 NOT NULL,
  `Clave` text CHARACTER SET latin1 NOT NULL,
  `Email` text CHARACTER SET latin1 NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` text CHARACTER SET latin1,
  `Pais` int(11) NOT NULL,
  `Foto` text CHARACTER SET latin1 NOT NULL,
  `FRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`) VALUES
(1, 'Julian', 'murray50', 'julio@gmail.com', 1, '2015-09-15', 'Alicante', 1, '/img/photo1.png', '2016-11-15 00:00:00'),
(2, 'Alexis', 'alexeis12', 'alexiselmejor@gmail.com', 2, '2015-10-12', 'Priscilla city', 2, '/img/lavida.png', '2016-11-01 00:00:00'),
(3, 'Julieta', 'julia123', 'julio@gmail.com', 1, '2015-09-15', 'Samba land', 1, '/img/photo1.png', '2016-11-15 00:00:00'),
(27, 'Asd', 'Asdasd123', 'asdasd@gmail.com', 0, '2016-12-08', 'hola', 1, 'img/lacara.png', '2016-12-04 00:00:00'),
(29, 'Asd2', 'Asdasd123', 'asdasd@gmail.com', 0, '2016-12-08', 'hola', 1, 'img/lacara.png', '2016-12-04 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsu` (`NomUsuario`(15));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
