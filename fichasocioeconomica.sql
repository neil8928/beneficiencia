-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-06-2023 a las 18:43:05
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbfichasocioeconomica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichasocioeconomica`
--

DROP TABLE IF EXISTS `fichasocioeconomica`;
CREATE TABLE IF NOT EXISTS `fichasocioeconomica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `encuestador_id` int(11) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `distrito_id` int(11) DEFAULT NULL,
  `centropoblado` varchar(200) DEFAULT NULL,
  `direccion` varchar(800) DEFAULT NULL,
  `diagnostico` varchar(800) DEFAULT NULL,
  `conclusiones` varchar(800) DEFAULT NULL,
  `estado_id` int(11) NOT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
