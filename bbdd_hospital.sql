-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-05-2021 a las 22:11:05
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BBDD_Hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(8) NOT NULL,
  `nombre` text COLLATE utf8mb4_bin NOT NULL,
  `apellidos` text COLLATE utf8mb4_bin NOT NULL,
  `edad` int(2) NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellidos`, `edad`, `direccion`, `telefono`, `fecha`) VALUES
(1, 'Daniel', 'Pintado Várez', 26, 'C/Miguel Delibes, 1, 1-C', '+34 654 32 14 85', '2021-04-01'),
(2, 'Jaime', 'Pintado Várez', 16, 'C/Arroyo, Nº 1-B', '+34 654 32 12 25', '2021-05-11'),
(3, 'Vicente', 'Antonio Prada', 23, 'C/ Canuto, S-N', '+34 625 62 32 11', '2021-04-07'),
(4, 'Kerly Karolina', 'Aymará González ', 26, 'C/ Aranda, S-N', '+593 12 335 4567', '2021-03-25'),
(5, 'María Inés', 'Várez Díaz', 52, 'C/ Arroyo, Nº 1-B', '+34 654 32 65 66', '2021-04-28'),
(6, 'Isidro', 'Pintado Bernal ', 52, 'C/Miguel Delibes, 1, 1-C', '+34 654 52 14 87', '2021-04-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `tipo_test` int(11) NOT NULL,
  `resultado` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tests`
--

INSERT INTO `tests` (`id`, `tipo_test`, `resultado`, `id_paciente`) VALUES
(1, 1, 0, 1),
(2, 2, 1, 4),
(3, 3, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_test`
--

CREATE TABLE `tipos_test` (
  `id` int(8) NOT NULL,
  `nombreTest` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_test`
--

INSERT INTO `tipos_test` (`id`, `nombreTest`) VALUES
(1, 'PCR'),
(2, 'ANTIGENOS'),
(3, 'ANTICUERPOS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_paciente` (`id_paciente`),
  ADD KEY `tipo_test` (`tipo_test`);

--
-- Indices de la tabla `tipos_test`
--
ALTER TABLE `tipos_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_test`
--
ALTER TABLE `tipos_test`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`tipo_test`) REFERENCES `tipos_test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
