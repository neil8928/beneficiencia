ALTER TABLE `fichasocioeconomica` 
ADD `permanencia_id` INT NULL AFTER `otrosbienes`, 
ADD `fechainicio` DATE NULL AFTER `permanencia_id`, 
ADD `fechafin` DATE NULL AFTER `fechainicio`, 
ADD `anios` INT NULL DEFAULT '0' AFTER `fechafin`, 
ADD `meses` INT NULL DEFAULT '0' AFTER `anios`;

ALTER TABLE `fichasocioeconomica` ADD `dias` INT NULL AFTER `meses`;

ALTER TABLE `fichasocioeconomica` ADD `fechapreaprobacion` DATE NULL AFTER `fecha`;


ALTER TABLE `fichasocioeconomica` ADD `fechaaprobacion` DATE NULL AFTER `fechapreaprobacion`;


