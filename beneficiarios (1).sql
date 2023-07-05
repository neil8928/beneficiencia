-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-06-2023 a las 01:16:20
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
-- Estructura de tabla para la tabla `beneficiarios`
--

DROP TABLE IF EXISTS `beneficiarios`;
CREATE TABLE IF NOT EXISTS `beneficiarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `swentrevistado` smallint(6) NOT NULL DEFAULT '0',
  `nombres` varchar(200) DEFAULT NULL,
  `apellidopaterno` varchar(200) DEFAULT NULL,
  `apellidomaterno` varchar(200) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `edad` smallint(6) NOT NULL DEFAULT '0',
  `sexo` smallint(6) NOT NULL DEFAULT '0',
  `telefono` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `estadocivil_id` int(11) NOT NULL,
  `niveleducativo_id` int(11) NOT NULL,
  `tiposeguro_id` int(11) NOT NULL,
  `cargafamiliar` int(11) NOT NULL DEFAULT '0',
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

COMMIT;
--
-- Volcado de datos para la tabla `beneficiarios`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
