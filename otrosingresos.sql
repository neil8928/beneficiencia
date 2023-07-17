DROP TABLE IF EXISTS `otrosingresos`;
CREATE TABLE IF NOT EXISTS `otrosingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `parentesco_id` int(11) NOT NULL,
  `parentesco` varchar(200) NOT NULL,
  `nombrefamiliar` varchar(300) NULL,
  `ocupacionprincipal` varchar(500) NULL,
  `saldodeapoyo` float NULL, 
  `usercrea` int(10) UNSIGNED NULL,
  `fechacrea`  date  NULL,
  `usermod` int(10) UNSIGNED NULL,
  `fechamod`  date  NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;