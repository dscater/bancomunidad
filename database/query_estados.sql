ALTER TABLE `funcionarios` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `agencias` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `regionals` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `cargos` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `sistemas` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `perfil_sistemas` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;

ALTER TABLE `formularios` ADD `estado` INT NOT NULL DEFAULT '1' AFTER `fecha_registro`;