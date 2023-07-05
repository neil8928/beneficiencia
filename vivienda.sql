alter table fichasocioeconomica
  add tenenciavivienda_id int(11) NULL;
alter table fichasocioeconomica
  add acreditepropiedadvivienda_id int(11) NULL;  
alter table fichasocioeconomica
  add numeropisosvivienda smallint(6) NULL DEFAULT '0';
alter table fichasocioeconomica
  add numeroambientevivienda smallint(6) NULL DEFAULT '0';  
alter table fichasocioeconomica
  add materialparedesvivienda_id int(11) NULL;
alter table fichasocioeconomica
  add materialtechosvivienda_id int(11) NULL;
alter table fichasocioeconomica
  add materialpisosvivienda_id int(11) NULL;   

alter table fichasocioeconomica
  add alumbradopublicovivienda varchar(10) NULL;


DROP TABLE IF EXISTS `viviendas`;
CREATE TABLE IF NOT EXISTS `viviendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL, 
  `concepto` varchar(200) DEFAULT NULL,
  `materialvivienda_id` int(11) NOT NULL,
  `nombrematerialvivienda` varchar(200) DEFAULT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `usercrea` int(10) UNSIGNED NOT NULL,
  `fechacrea` date NOT NULL,  
  `usermod` int(10) UNSIGNED  NULL,
  `fechamod` date  NULL,  
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;  
  
  
  