DROP TABLE IF EXISTS `beneficios`;
CREATE TABLE IF NOT EXISTS `beneficios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `familiar_id` int(11) NOT NULL,
  `nombrefamiliar` varchar(200) DEFAULT NULL,
  `programabeneficiario_id` int(11) NOT NULL,
  `nombreprogramabeneficiario` varchar(200) DEFAULT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `usercrea` int(10) UNSIGNED NOT NULL,
  `fechacrea` date NOT NULL,  
  `usermod` int(10) UNSIGNED  NULL,
  `fechamod` date  NULL,  
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;  
