INSERT INTO `conceptos`
 (`id`, `codigo`, `nombre`, `descripcion`, `activo`, `created_at`, `updated_at`) 
 VALUES (NULL, '00022', 'Lugar de Fallecimiento', 'Lugar de Fallecimiento del familiar del Beneficiario', '1', CURRENT_TIMESTAMP, NULL);


 ALTER TABLE
  `fichasocioeconomica`
   ADD `cfactveconbienes` VARCHAR(1000) NULL AFTER `cfamdenunciamaltrato`, 
   ADD `otrosbienes` VARCHAR(1000) NULL AFTER `cfactveconbienes`;


  