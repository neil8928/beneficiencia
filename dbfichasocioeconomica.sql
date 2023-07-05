-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-05-2023 a las 14:31:09
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
CREATE DATABASE IF NOT EXISTS `dbfichasocioeconomica` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbfichasocioeconomica`;

-- DROP DATABASE IF EXISTS `dbfichasocioeconomica`;

-- CREATE DATABASE `dbfichasocioeconomica`;
-- USE `dbfichasocioeconomica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoopciones`
--

DROP TABLE IF EXISTS `grupoopciones`;
CREATE TABLE IF NOT EXISTS `grupoopciones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupoopciones`
--

INSERT INTO `grupoopciones` (`id`, `nombre`, `icono`, `orden`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Usuarios', 'mdi-accounts-alt', 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55'),
(2, 'Mantenimiento', 'fa fa-cog', 2, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55'),
(3, 'Ficha Socieconomica', 'mdi-chart', 3, 1, '2020-09-24 17:47:55', NULL);
-- ,
-- (3, 'Productores', 'mdi-layers', 2, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55'),
-- (4, 'Aliados', 'mdi-coffee', 4, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55'),
-- (5, 'Calendario', 'mdi-calendar', 5, 1, '2023-03-02 03:23:30', '2023-03-02 03:23:30'),
-- (6, 'Trabajadores', 'mdi-face', 6, 1, '2023-04-15 16:54:29', '2023-04-15 16:54:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

DROP TABLE IF EXISTS `opciones`;
CREATE TABLE IF NOT EXISTS `opciones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagina` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grupoopcion_id` int(10) UNSIGNED NOT NULL,
  `seccion_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `grupoopcion_id` (`grupoopcion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `nombre`, `descripcion`, `pagina`, `activo`, `created_at`, `updated_at`, `grupoopcion_id`, `seccion_id`) VALUES
(1, 'Usuarios', 'Usuarios', 'gestion-de-usuarios', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(2, 'Roles', 'Roles', 'gestion-de-roles', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(3, 'Permisos', 'Permisos', 'gestion-de-permisos', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(4, 'Grupo Opciones', 'Grupo Ópciones', 'gestion-de-grupoopciones', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 2, 0),
(5, 'Opciones', 'Opciones', 'gestion-de-opciones', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 2, 0),
(6, 'Ficha Socieconomica', 'Ficha Socieconomica', 'gestion-ficha-socieconomica', 1, '2020-09-24 17:47:55', NULL, 3, 0),
(7, 'Reportes', 'Reportes', 'gestion-reportes-ficha-socieconomica', 1,'2020-09-24 17:47:55', NULL, 3, 0);

-- (6, 'Categorias', 'Categorias', 'gestion-de-categorias', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 2, 0),
-- (7, 'Seccion Pagina', 'Gestion Seccion Pagina', 'gestion-de-secciones', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 2, 0),
-- (8, 'Testimonio Productores', 'Gestion Testimonio', 'gestion-de-testimonios-productores', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 3, 3),
-- (9, 'Comentarios Productores', 'Gestion Comentarios', 'gestion-de-comentarios-productores', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 3, 4),
-- (10, 'Empresa', 'Gestion Empresa', 'gestion-de-empresas', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 4, 0),
-- (11, 'Gestion', 'Gestion', 'gestion-de-aliados', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 4, 0),
-- (12, 'Gestion Productos', 'Gestion Productos', 'gestion-productos', 1, '2023-03-02 03:24:40', '2023-03-02 03:24:40', 5, 0),
-- (13, 'Cargar Datos Produccion', 'Cargar Datos Produccion', 'gestion-cargar-datos-produccion', 1, '2023-03-04 18:35:19', '2023-03-04 18:35:19', 5, 0),
-- (14, 'Gestion Calendario Estacional', 'Gestion Calendario Estacional', 'gestion-calendario-estacional', 1, '2023-03-05 23:50:49', '2023-03-05 23:50:49', 5, 0),
-- (15, 'Gestion Cosecha', 'Gestion Cosecha', 'gestion-cosecha', 1, '2023-03-17 14:14:57', '2023-03-17 14:14:57', 5, 0),
-- (16, 'Cargar Datos Cosecha', 'Cargar Datos Cosecha', 'gestion-cargar-datos-cosecha', 1, '2023-03-24 05:24:08', '2023-03-24 05:24:08', 5, 0),
-- (17, 'Trabajadores', 'Gestión Trabajadores', 'gestion-trabajadores', 1, '2023-04-15 16:54:59', '2023-04-15 16:54:59', 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolopciones`
--

DROP TABLE IF EXISTS `rolopciones`;
CREATE TABLE IF NOT EXISTS `rolopciones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orden` int(11) NOT NULL,
  `ver` int(11) NOT NULL,
  `anadir` int(11) NOT NULL,
  `modificar` int(11) NOT NULL,
  `eliminar` int(11) NOT NULL,
  `todas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `opcion_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  KEY `opcion_id` (`opcion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rolopciones`
--

INSERT INTO `rolopciones` (`id`, `orden`, `ver`, `anadir`, `modificar`, `eliminar`, `todas`, `created_at`, `updated_at`, `rol_id`, `opcion_id`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 1),
(2, 2, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 2),
(3, 3, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 3),
(4, 4, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 4),
(5, 5, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 5),
(6, 6, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 6),
(7, 7, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

DROP TABLE IF EXISTS `rols`;
CREATE TABLE IF NOT EXISTS `rols` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55');

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `trabajadores`
--

-- DROP TABLE IF EXISTS `trabajadores`;
-- CREATE TABLE IF NOT EXISTS `trabajadores` (
--   `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
--   `empresa_id` int(10) UNSIGNED NOT NULL,
--   `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `dni` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `cargo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `urllinkedin` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `fechanacimiento` date DEFAULT NULL,
--   `activo` tinyint(1) NOT NULL DEFAULT '1',
--   `fechacrea` date NOT NULL,
--   `usercrea` int(10) UNSIGNED NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   `deleted_at` timestamp NULL DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email`, `name`, `password`, `activo`, `created_at`, `updated_at`, `rol_id`) VALUES
(1, 'Administrador', 'Web', 'francito20al@gmail.com', 'admin', 'eyJpdiI6Ik9PNGhlR0d0bjFlVFwvZ1pCZTdtdFVBPT0iLCJ2YWx1ZSI6InA5UVl1NzF1U3ZkOFwvdmQxcU9UUHR3PT0iLCJtYWMiOiIwNzg3YTlhNjhjNjU3ZjkwN2Y2ZWM5M2IyYjI5OGQzYjZhOGZhMGMyMzIzZmMwN2ZjYTc5ODg3ODkyOGVlMzVmIn0=', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1);




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razonsocial` varchar(200) COLLATE utf8mb4_unicode_ci  NOT NULL,
  `ruc` varchar(50) COLLATE utf8mb4_unicode_ci  NULL,
  `direccion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `razonsocial`, `ruc`, `direccion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'AGUSTIN GAVIDIA SALCEDO', 'AGUSTIN GAVIDIA SALCEDO', '11111111111', 'PERU - LAMBAYEQUE',  1, '2020-09-24 17:47:55', '2023-02-22 15:41:30');


-- -- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisouserempresas`
--

DROP TABLE IF EXISTS `permisouserempresas`;
CREATE TABLE IF NOT EXISTS `permisouserempresas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `empresa_id` int(10) UNSIGNED NOT NULL,
  `userreg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisouserempresas`
--

INSERT INTO `permisouserempresas` (`id`, `user_id`, `empresa_id`, `userreg`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'admin', 1, '2023-03-02 06:31:09', '2023-04-15 17:09:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

DROP TABLE IF EXISTS `conceptos`;
CREATE TABLE IF NOT EXISTS `conceptos` (
  `id`          int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo`      varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre`      varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo`      tinyint(1) NOT NULL DEFAULT '1',
  `created_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('1','parentesco','00001','parentesco familiar con el beneficiario',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('2','estado civil','00002','estado civil de cada familiar ',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('3','nivel educativo','00003','nivel educativo de cada familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('4','tipo de seguro','00004','tipo de seguro de cada familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('5','discapacidad','00005','discapacidad familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('6','nivel de discapacidad','00006','nivel de discapacidad familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('7','ocupacion','00007','ocupacion familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('8','frecuencia actividad','00008','frecuencia actividad familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('9','bienes','00009','bienes familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('10','programa beneficiario','00010','programa beneficiario familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('11','tenencia de vivienda','00011','tenencia de vivienda familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('12','documentacion de vivienda','00012','documentacion de vivienda familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('13','material de la vivienda','00013','material de la vivienda familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('14','servicios publicos','00014','servicios publicos familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('15','abastecimiento agua','00015','abastecimiento agua familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('16','servicios higienicos','00016','servicios higienicos familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('17','tipo de violencia familiar','00017','tipo de violencia familiar',1);
INSERT INTO `conceptos` (`id`, `nombre`,`codigo`, `descripcion`,`activo`) VALUES ('18','institucion apoyo violencia','00018','institucion apoyo violencia familiar',1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleconceptos`
--

DROP TABLE IF EXISTS `detalleconceptos`;
CREATE TABLE IF NOT EXISTS `detalleconceptos` (
  `id`          int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `nombre`      varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo`      tinyint(1) NOT NULL DEFAULT '1',
  `created_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalleconceptos`
--
INSERT INTO `detalleconceptos` (`id`, `concepto_id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
(1,1,'Padre',1,'2023-06-21 21:42:15',NULL),
(2,1,'Madre',1,'2023-06-21 21:42:15',NULL),
(3,1,'Hijo(a)',1,'2023-06-21 21:42:15',NULL),
(4,1,'Hermano(a)',1,'2023-06-21 21:42:15',NULL),
(5,1,'Tio(a)',1,'2023-06-21 21:42:15',NULL),
(6,1,'Primo(a)',1,'2023-06-21 21:42:15',NULL),
(7,1,'Sobrino(a)',1,'2023-06-21 21:42:15',NULL),
(8,2,'Soltero(a)',1,'2023-06-21 21:45:23',NULL),
(9,2,'Conviviente',1,'2023-06-22 00:36:24',NULL),
(10,2,'Casado(a)',1,'2023-06-22 00:36:24',NULL),
(11,2,'Viudo(a)',1,'2023-06-22 00:36:24',NULL),
(12,2,'Divorciado(a)',1,'2023-06-22 00:36:24',NULL),
(13,2,'Separado(a)',1,'2023-06-22 00:36:24',NULL),
(14,3,'Ninguno',1,'2023-06-22 00:36:24',NULL),
(15,3,'Prim.Completa',1,'2023-06-22 00:36:24',NULL),
(16,3,'Prim.Incompleta',1,'2023-06-22 00:36:24',NULL),
(17,3,'Sec.Completa',1,'2023-06-22 00:36:24',NULL),
(18,3,'Sec.Incompleta',1,'2023-06-22 00:36:24',NULL),
(19,3,'Sup.Univers.',1,'2023-06-22 00:36:24',NULL),
(20,3,'Sup.No Univers.',1,'2023-06-22 00:36:24',NULL),
(21,3,'Otros',1,'2023-06-22 00:36:24',NULL),
(22,4,'SIS',1,'2023-06-22 00:36:24',NULL),
(23,4,'ESSALUD',1,'2023-06-22 00:36:24',NULL),
(24,4,'EPS',1,'2023-06-22 00:36:24',NULL),
(25,4,'SSP',1,'2023-06-22 00:36:24',NULL),
(26,5,'Física',1,'2023-06-22 00:36:24',NULL),
(27,5,'Sensorial',1,'2023-06-22 00:36:24',NULL),
(28,5,'Mental',1,'2023-06-22 00:36:24',NULL),
(29,5,'Intelectual',1,'2023-06-22 00:36:24',NULL),
(30,6,'Leve',1,'2023-06-22 00:36:24',NULL),
(31,6,'Moderada',1,'2023-06-22 00:36:24',NULL),
(32,6,'Severa',1,'2023-06-22 00:36:24',NULL),
(33,9,'Automóvil',1,'2023-06-22 00:36:24',NULL),
(34,9,'Camión',1,'2023-06-22 00:36:24',NULL),
(35,9,'Tractor Agrícola',1,'2023-06-22 00:36:24',NULL),
(36,9,'Refrigeradora',1,'2023-06-22 00:36:24',NULL),
(37,9,'Computadora',1,'2023-06-22 00:36:24',NULL),
(38,9,'Lavadora',1,'2023-06-22 00:36:24',NULL),
(39,9,'Horno Micro.',1,'2023-06-22 00:36:24',NULL),
(40,9,'Cocina a gas',1,'2023-06-22 00:36:24',NULL),
(41,9,'Equipos de Son.',1,'2023-06-22 00:36:24',NULL),
(42,9,'Otros',1,'2023-06-22 00:36:24',NULL),
(43,10,'QALIWARMA',1,'2023-06-22 13:19:18',NULL),
(44,10,'CONADIS',1,'2023-06-22 13:19:18',NULL),
(45,10,'Juntos',1,'2023-06-22 13:19:18',NULL),
(46,10,'Pensión 65',1,'2023-06-22 13:19:18',NULL),
(47,10,'Vaso de leche',1,'2023-06-22 13:19:18',NULL),
(48,11,'Propia ',1,'2023-06-22 13:19:18',NULL),
(49,11,'Alquilada ',1,'2023-06-22 13:19:18',NULL),
(50,11,'Cuidador',1,'2023-06-22 13:19:18',NULL),
(51,12,'Tit.Propiedad y/o Escrit.Publ.',1,'2023-06-22 13:19:18',NULL),
(52,12,'Constancia de Posesión',1,'2023-06-22 13:19:18',NULL),
(53,12,'Otro',1,'2023-06-22 13:19:18',NULL),
(54,21,'Ladrillo',1,'2023-06-22 13:19:18',NULL),
(55,21,'Adobe',1,'2023-06-22 13:19:18',NULL),
(56,21,'Quincha',1,'2023-06-22 13:19:18',NULL),
(57,21,'Esteras',1,'2023-06-22 13:19:18',NULL),
(58,21,'Plástico',1,'2023-06-22 13:19:18',NULL),
(59,14,'Luz ',1,'2023-06-22 13:19:18',NULL),
(60,14,'Agua',1,'2023-06-22 13:19:18',NULL),
(61,14,'Agua y luz',0,'2023-06-22 13:19:18',NULL),
(62,14,'gas',1,'2023-06-22 13:19:18',NULL),
(63,14,'Internet',1,'2023-06-22 13:19:18',NULL),
(64,14,'Cable',1,'2023-06-22 13:19:18',NULL),
(65,15,'Red Públ.Dentro de casa',1,'2023-06-22 13:19:18',NULL),
(66,15,'Red Públ.Fuera de casa',1,'2023-06-22 13:19:18',NULL),
(67,15,'Pozo artesanal / Pilón',1,'2023-06-22 13:19:18',NULL),
(68,15,'Cisterna',1,'2023-06-22 13:19:18',NULL),
(69,16,'Serv.Dentro de casa',1,'2023-06-22 13:19:18',NULL),
(70,16,'Serv.Fuera de casa',1,'2023-06-22 13:19:18',NULL),
(71,16,'Pozo ciego / Letrina',1,'2023-06-22 13:19:18',NULL),
(72,17,'Física',1,'2023-06-22 13:19:18',NULL),
(73,17,'Psicológica',1,'2023-06-22 13:19:18',NULL),
(74,17,'Sexual',1,'2023-06-22 13:19:18',NULL),
(75,17,'Económica',1,'2023-06-22 13:19:18',NULL),
(76,18,'DEMUNA',1,'2023-06-22 13:19:18',NULL),
(77,18,'Juez de paz',1,'2023-06-22 13:19:18',NULL),
(78,18,'Policía',1,'2023-06-22 13:19:18',NULL),
(79,18,'CEM',1,'2023-06-22 13:19:18',NULL),
(80,18,'Otra',1,'2023-06-22 13:19:18',NULL),
(81,10,'FONCODES',1,'2023-06-22 13:19:18',NULL),
(82,10,'Contigo',1,'2023-06-22 13:19:18',NULL),
(83,10,'CUNA MAS',1,'2023-06-22 13:19:18',NULL),
(84,10,'CIAM',1,'2023-06-22 13:19:18',NULL),
(85,19,'Concreto armado',1,'2023-06-22 13:19:18',NULL),
(86,19,'Caña y barro',1,'2023-06-22 13:19:18',NULL),
(87,19,'Esteras',1,'2023-06-22 13:19:18',NULL),
(88,19,'Calaminas',1,'2023-06-22 13:19:18',NULL),
(89,19,'Eternit',1,'2023-06-22 13:19:18',NULL),
(90,19,'Otro',1,'2023-06-22 13:19:18',NULL),
(91,20,'Cemento ',1,'2023-06-22 13:19:18',NULL),
(92,20,'Adobe',1,'2023-06-22 13:19:18',NULL),
(93,20,'Tierra',1,'2023-06-22 13:19:18',NULL),
(94,20,'Arena',1,'2023-06-22 13:19:18',NULL),
(95,20,'Madera',1,'2023-06-22 13:19:18',NULL),
(96,20,'Cerámico',1,'2023-06-22 13:19:18',NULL);

--
-- Base de datos: `dbfichasocioeconomica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'GENERADO', '2023-06-22 19:18:33', '2023-06-22 19:18:33'),
(2, 'APROBADO', '2023-06-22 19:18:33', '2023-06-22 19:18:33'),
(3, 'ELIMINADO', '2023-06-22 19:18:33', '2023-06-22 19:18:33'),
(4, 'CONFIRMADO', '2023-06-22 19:18:33', '2023-06-22 19:18:33'),
(5, 'ENVIADO', '2023-06-22 19:18:33', '2023-06-22 19:18:33'),
(6, 'TERMINADA', '2023-06-22 19:19:02', '2023-06-22 19:19:02');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichasocieconomica`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `familiares`;
CREATE TABLE IF NOT EXISTS `familiares` (
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
  `parentesco_id` int(11) NOT NULL,
  `estadocivil_id` int(11) NOT NULL,
  `niveleducativo_id` int(11) NOT NULL,
  `tiposeguro_id` int(11) NOT NULL,
  `cargafamiliar` int(11) NOT NULL DEFAULT '0',
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
