-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2016 a las 21:33:26
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

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
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Usuario`) VALUES
(1, 'Album 1', 'Album de ejemplo 1', '2016-11-01', 1, 1),
(2, 'Album 2', 'Album de ejemplo 2', '2016-11-02', 2, 2),
(3, 'Album 3', 'Album de ejemplo 3', '2016-11-03', 3, 3),
(4, 'Album 4', 'Album de ejemplo 4', '2016-11-04', 4, 1),
(5, 'Album 5', 'Album de ejemplo  5', '2016-11-05', 1, 1),
(14, 'asdasd', '', '2014-12-12', 1, 0),
(15, 'Mis fotos', 'Mis fotos en la playa', '2014-12-12', 1, 0),
(16, 'Maravillosas fotos', 'hola', '0000-00-00', 1, 1),
(17, 'ASd', '', '2016-12-22', 1, 11),
(18, 'asdasd', '', '2016-12-22', 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `pais` int(11) NOT NULL,
  `album` int(11) DEFAULT NULL,
  `fichero` text NOT NULL,
  `fRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`idFoto`, `titulo`, `descripcion`, `fecha`, `pais`, `album`, `fichero`, `fRegistro`) VALUES
(1, 'selfie', 'Una foto que me saqué en la boda de mi hermana', '2015-03-14', 1, 2, 'img/te_fo.jpg', '2016-11-23 00:00:00'),
(3, 'party with my work mates!', 'A picture with my friends at the party of our aunt Mary Sunshine :D', '2015-02-15', 3, 3, 'img/si_o_que.jpg', '0000-00-00 00:00:00'),
(5, 'yo guapo', 'Miradme', '2015-04-03', 1, 0, 'img/tio_maquina.jpg', '2016-11-24 00:00:00'),
(6, 'my son''s first draw', 'Very porud of him! :)D', '2014-02-14', 2, 4, 'img/lacara.png', '2016-11-09 00:00:00'),
(7, 'Hola', 'Loquesea', '1995-12-22', 1, 16, 'img/1481795867Herrero.jpg', '2016-12-15 10:57:47'),
(8, 'Jaja', 'asd', '2015-12-16', 1, 17, 'img/14823331604e61a071f83f558d255d27f619e86ea8-d64mi81.jpg', '2016-12-21 16:12:40'),
(9, 'Me encanta', 'pero que', '2016-12-17', 1, 17, 'img/148233318982FF72081.jpg', '2016-12-21 16:13:09'),
(10, 'Familiariedad', 'Jeje', '2016-12-21', 1, 17, 'img/148233321387C8D8AD1.jpg', '2016-12-21 16:13:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Nombre` text NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Email` text NOT NULL,
  `Direccion` text NOT NULL,
  `Color` text NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` datetime NOT NULL,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` text NOT NULL,
  `Clave` text NOT NULL,
  `Email` text NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` text NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` text NOT NULL,
  `FRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`) VALUES
(1, 'Julian', 'murray50', 'julio@gmail.com', 1, '2015-09-15', 'Alicante', 1, 'img/lacara.png', '2016-11-15 00:00:00'),
(2, 'Alexis', 'alexeis12', 'alexiselmejor@gmail.com', 2, '2015-10-12', 'Priscilla city', 2, '''/img/lavida.png''', '2016-11-01 00:00:00'),
(3, 'Julieta', 'julia123', 'julio@gmail.com', 1, '2015-09-15', 'Samba land', 1, '''/img/photo1.png''', '2016-11-15 00:00:00'),
(4, 'test', 'test', 'test@gmail.com', 1, '2016-11-16', 'Alicante', 1, 'pos.jpg', '2016-11-16 00:00:00'),
(8, 'PapitoRico', 'Navidad25', 'alexei@gmail.com', 1, '2016-12-14', 'Aljub', 1, 'perfiles/PapitoRico1997116.jpg', '2016-12-20 14:15:48'),
(10, 'Manolo', 'Marisa2', 'ManoloMarisa@gmail.com', 1, '0000-00-00', 'alicante', 1, 'perfiles/Manolocamera_concept___el_origen_del_eden_by_badillafloyd-d6csqi8.jpg', '2016-12-20 15:09:30'),
(11, 'Alexei', 'Alexei1', 'alexei@gmail.com', 1, '1970-01-01', 'Alicante', 1, 'perfiles/Alexei1997116.jpg', '2016-12-20 15:29:31');

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
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
