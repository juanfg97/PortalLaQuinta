-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2025 a las 22:35:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `urbanizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presidente_central`
--

CREATE TABLE `presidente_central` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Nombre_completo` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presidente_central`
--

INSERT INTO `presidente_central` (`id`, `usuario`, `password`, `Nombre_completo`, `telefono`, `correo`) VALUES
(1, 'Presidente', 'Prueba123.', 'Manuel Fernandez', '02123032548', 'juanmanuelfg9@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presidente_condominio`
--

CREATE TABLE `presidente_condominio` (
  `id` int(11) NOT NULL,
  `Terraza` enum('1','2','3','4','5','6','7','8','9','10','11','12','13') NOT NULL,
  `Edificio` enum('A','B','C','D','E','F','G','H','I','J','K') NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presidente_condominio`
--

INSERT INTO `presidente_condominio` (`id`, `Terraza`, `Edificio`, `usuario`, `password`, `nombre_completo`, `telefono`) VALUES
(1, '1', 'A', 'Juan ', 'Prueba123.', 'Juan Fernandez', '04143001934');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `presidente_central`
--
ALTER TABLE `presidente_central`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presidente_condominio`
--
ALTER TABLE `presidente_condominio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `presidente_central`
--
ALTER TABLE `presidente_central`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
