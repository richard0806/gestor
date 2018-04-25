-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2018 a las 15:01:45
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_gestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ndetalles`
--

CREATE TABLE `tbl_ndetalles` (
  `id` int(11) NOT NULL,
  `id_nc` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `id_alm` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_ndetalles`
--

INSERT INTO `tbl_ndetalles` (`id`, `id_nc`, `id_prod`, `cantidad`, `id_alm`, `fecha`) VALUES
(2, 2, 4761, 1, 1, '2018-02-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_ndetalles`
--
ALTER TABLE `tbl_ndetalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nc` (`id_nc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_ndetalles`
--
ALTER TABLE `tbl_ndetalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_ndetalles`
--
ALTER TABLE `tbl_ndetalles`
  ADD CONSTRAINT `rel_detalles_nc` FOREIGN KEY (`id_nc`) REFERENCES `tbl_devoluciones` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
