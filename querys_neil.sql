ALTER TABLE `fichasocioeconomica` 
ADD `permanencia_id` INT NULL AFTER `otrosbienes`, 
ADD `fechainicio` DATE NULL AFTER `permanencia_id`, 
ADD `fechafin` DATE NULL AFTER `fechainicio`, 
ADD `anios` INT NULL DEFAULT '0' AFTER `fechafin`, 
ADD `meses` INT NULL DEFAULT '0' AFTER `anios`;

ALTER TABLE `fichasocioeconomica` ADD `dias` INT NULL AFTER `meses`;

ALTER TABLE `fichasocioeconomica` ADD `fechapreaprobacion` DATE NULL AFTER `fecha`;


ALTER TABLE `fichasocioeconomica` ADD `fechaaprobacion` DATE NULL AFTER `fechapreaprobacion`;






DROP TABLE IF EXISTS `permanencia`;
CREATE TABLE IF NOT EXISTS `permanencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(1000) DEFAULT NULL,
  `indsinlimite` int(11) NOT NULL DEFAULT '0',
  `indedad` int(11) NOT NULL DEFAULT '1',
  `edadmin` int(11) DEFAULT NULL,
  `edadmax` int(11) DEFAULT NULL,
  `indvulnerabilidad` int(11) NOT NULL DEFAULT '0',
  `indriesgosocial` int(11) NOT NULL DEFAULT '0',
  `indsueldo` int(11) NOT NULL DEFAULT '0',
  `sueldomaximo` float NOT NULL DEFAULT '0',
  `indcantpersonas` int(11) NOT NULL DEFAULT '0',
  `cantpersonas` int(11) DEFAULT '0',
  `anios` int(11) NOT NULL DEFAULT '0',
  `meses` int(11) NOT NULL DEFAULT '0',
  `dias` int(11) NOT NULL DEFAULT '0',
  `activo` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usercrea` int(11) NOT NULL,
  `fechacrea` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usermod` int(11) DEFAULT NULL,
  `fechamod` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;