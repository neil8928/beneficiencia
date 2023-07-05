SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE `dbfichasocioeconomica`;

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id`          int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo`      varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo`      tinyint(1) NOT NULL DEFAULT '1',
  `created_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('1','01','AMAZONAS',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('2','02','ANCASH',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('3','03','APURIMAC',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('4','04','AREQUIPA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('5','05','AYACUCHO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('6','06','CAJAMARCA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('7','07','CUSCO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('8','08','HUANCAVELICA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('9','09','HUANUCO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('10','10','ICA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('11','11','JUNIN',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('12','12','LA LIBERTAD',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('13','13','LAMBAYEQUE',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('14','14','LIMA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('15','15','LORETO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('16','16','MADRE DE DIOS',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('17','17','MOQUEGUA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('18','18','PASCO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('19','19','PIURA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('20','20','PUNO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('21','21','SAN MARTIN',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('22','22','TACNA',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('23','23','TUMBES',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('24','24','PROV. CONST. DEL CALLAO',1);
INSERT INTO `departamentos` (`id`,`codigo`, `descripcion`, `activo`) VALUES  ('25','25','UCAYALI',1);

COMMIT;
