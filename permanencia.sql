-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-07-2023 a las 17:18:27
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
-- Estructura de tabla para la tabla `permanencia`
--

DROP TABLE IF EXISTS `permanencia`;
CREATE TABLE IF NOT EXISTS `permanencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(1000) DEFAULT NULL,
  `indsinlimite` int(11) NOT NULL DEFAULT '0',
  `indedad` int(11) NOT NULL DEFAULT '1',
  `edadmin` int(11) DEFAULT NULL,
  `edadmax` int(11) DEFAULT NULL,
  `indvulneravilidad` int(11) NOT NULL DEFAULT '0',
  `indriesgosocial` int(11) NOT NULL DEFAULT '0',
  `indsueldo` int(11) NOT NULL DEFAULT '0',
  `sueldominimo` float NOT NULL DEFAULT '0',
  `indcantpersonas` int(11) NOT NULL DEFAULT '0',
  `cantpersonas` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
