-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-07-2023 a las 18:09:08
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
-- Estructura de tabla para la tabla `saludbeneficiarios`
--

DROP TABLE IF EXISTS `saludbeneficiarios`;
CREATE TABLE IF NOT EXISTS `saludbeneficiarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `discapacidad_id` int(11) NOT NULL,
  `discapacidad` varchar(200) NOT NULL,
  `niveldiscapacidad_id` int(11) NOT NULL,
  `niveldiscapacidad` varchar(200) NOT NULL,

  `tipodiscapacidad` varchar(300) NOT NULL,

  `tiposeguro_id` int(11) NOT NULL,
  `tiposeguro` varchar(200) NOT NULL,
  `cadtiposeguro` varchar(200)  NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `saludfamiliares`
--

DROP TABLE IF EXISTS `saludfamiliares`;
CREATE TABLE IF NOT EXISTS `saludfamiliares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,

  `familiar_id` int(11) NOT NULL,
  `parentesco_id` int(11) NOT NULL, -- de la tabla familiar
  `parentesco` varchar(200) NOT NULL, -- de la tabla familiar
  `nombrefamiliar` varchar(300) NOT NULL,

  `enfermedad` varchar(300) NOT NULL,

  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `saludfamiliares`
--

DROP TABLE IF EXISTS `saludmortalidad`;
CREATE TABLE IF NOT EXISTS `saludmortalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,

  `parentesco_id` int(11) NOT NULL,
  `parentesco` varchar(200) NOT NULL, -- de la tabla familiar
  `nombrefamiliar` varchar(300) NOT NULL,
  `enfermedad` varchar(300) NOT NULL,

  `lugarfallecimiento_id` int(11) NOT NULL,
  `lugarfallecimiento` varchar(200) NOT NULL,
  `cadlugarfallecimiento` varchar(200) NULL,

  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `documentosficha`;
CREATE TABLE IF NOT EXISTS `documentosficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `usercrea` int(11) NOT NULL,
  `fechacrea` date NOT NULL,
  `usermod` date  NULL,
  `fechamod` date  NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





DROP TABLE IF EXISTS `actividadeseconomicas`;
CREATE TABLE IF NOT EXISTS `actividadeseconomicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,

  `familiar_id` int(11) NOT NULL,
  `parentesco_id` int(11) NOT NULL,
  `parentesco` varchar(200) NOT NULL, -- de la tabla familiar
  `nombrefamiliar` varchar(300) NOT NULL,

  `ocupacionprincipal`  varchar(300) NOT NULL,
  `remuneracionmensual` FLOAT NOT NULL,
  `frecuenciaactividad` varchar(200) NOT NULL,
  `actividadesextras`   varchar(500) NOT NULL,


  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




-- CAMPOS TABLAS
INSERT INTO `conceptos`
 (`id`, `codigo`, `nombre`, `descripcion`, `activo`, `created_at`, `updated_at`) 
 VALUES (NULL, '00022', 'Lugar de Fallecimiento', 'Lugar de Fallecimiento del familiar del Beneficiario', '1', CURRENT_TIMESTAMP, NULL);


 ALTER TABLE
  `fichasocioeconomica`
   ADD `cfactveconbienes` VARCHAR(1000) NULL AFTER `cfamdenunciamaltrato`, 
   ADD `otrosbienes` VARCHAR(1000) NULL AFTER `cfactveconbienes`;


  

-- --------------------------------------------------------


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
