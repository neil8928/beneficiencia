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
-- Base de datos: `bdweb`
--

CREATE DATABASE `bdweb`;
USE `bdweb`;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupoopciones`
--

INSERT INTO `grupoopciones` (`id`, `nombre`, `icono`, `orden`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Usuarios', 'mdi-accounts-alt', 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55'),
(2, 'Mantenimiento', 'fa fa-cog', 2, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grupoopcion_id` int(10) UNSIGNED NOT NULL,
  `seccion_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `grupoopcion_id` (`grupoopcion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `nombre`, `descripcion`, `pagina`, `activo`, `created_at`, `updated_at`, `grupoopcion_id`, `seccion_id`) VALUES
(1, 'Usuarios', 'Usuarios', 'gestion-de-usuarios', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(2, 'Roles', 'Roles', 'gestion-de-roles', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(3, 'Permisos', 'Permisos', 'gestion-de-permisos', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(4, 'Grupo Opciones', 'Grupo Ópciones', 'gestion-de-grupoopciones', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0),
(5, 'Opciones', 'Opciones', 'gestion-de-opciones', 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 0);

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
  `created_at` timestamp NULL DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
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
(5, 5, 1, 1, 1, 1, 1, '2020-09-24 17:47:55', '2020-09-24 17:47:55', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

DROP TABLE IF EXISTS `rols`;
CREATE TABLE IF NOT EXISTS `rols` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
