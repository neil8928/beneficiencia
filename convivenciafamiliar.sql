alter table fichasocioeconomica
  add cfhabandono varchar(1000) NULL;
alter table fichasocioeconomica
  add cfhpensionalimenticia varchar(1000) NULL;  
alter table fichasocioeconomica
  add cfhdenunciapension varchar(1000) NULL;   
alter table fichasocioeconomica
  add cfhdenunciamaltrato varchar(1000) NULL;    

alter table fichasocioeconomica
  add cfamabandono varchar(1000) NULL;
alter table fichasocioeconomica
  add cfampensionalimenticia varchar(1000) NULL;  
alter table fichasocioeconomica
  add cfamdenunciapension varchar(1000) NULL;   
alter table fichasocioeconomica
  add cfamdenunciamaltrato varchar(1000) NULL;  
 
DROP TABLE IF EXISTS `convivenciafamiliares`;
CREATE TABLE IF NOT EXISTS `convivenciafamiliares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL, 
  `concepto` varchar(200) DEFAULT NULL,
  `conceptodetalle_id` int(11) NOT NULL,
  `nombreconceptodetalle` varchar(200) DEFAULT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '1',
  `usercrea` int(10) UNSIGNED NOT NULL,
  `fechacrea` date NOT NULL,  
  `usermod` int(10) UNSIGNED  NULL,
  `fechamod` date  NULL,  
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;  

-- tipoviolenciageneral

-- tipoviolenciahijo
-- institucionhijo

-- tipoviolenciaabuelo
-- institucionabuelo
  
  