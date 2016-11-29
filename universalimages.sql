-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2016 a las 19:18:39
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `universalimages`
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
(5, 'Album 5', 'Album de ejemplo  5', '2016-11-05', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Album` int(11) NOT NULL,
  `Fichero` text NOT NULL,
  `FRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `FRegistro`) VALUES
(0, 'My best friend!', 'Here in the party', '2016-10-17', 5, 3, '''/img/party.png''', '2016-10-10 00:00:00'),
(0, 'My best friend!', 'Here in the party', '2016-10-17', 5, 3, '10', '2016-10-10 00:00:00'),
(0, 'Foto 2', 'Foto de ejemplo 2', '2016-11-02', 2, 2, '''images/foto2.png''', '2016-11-03 00:00:00'),
(0, 'Foto 2', 'Foto de ejemplo 2', '2016-11-02', 2, 2, '''images/foto2.png''', '2016-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` text NOT NULL
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
  `Ciudad` int(11) NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` text NOT NULL,
  `FRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`) VALUES
(1, 'Julian', 'murray50', 'julio@gmail.com', 1, '2015-09-15', 1, 1, '''/img/photo1.png''', '2016-11-15 00:00:00'),
(2, 'Alexis', 'alexeis12', 'alexiselmejor@gmail.com', 2, '2015-10-12', 3, 2, '''/img/lavida.png''', '2016-11-01 00:00:00'),
(3, 'Julieta', 'julia123', 'julio@gmail.com', 1, '2015-09-15', 1, 1, '''/img/photo1.png''', '2016-11-15 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`);

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
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
