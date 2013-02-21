SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `sistCalidad` ;
CREATE SCHEMA IF NOT EXISTS `sistCalidad` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci ;
USE `sistCalidad` ;

-- -----------------------------------------------------
-- Table `sistCalidad`.`grupo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`grupo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `url_index` VARCHAR(45) NULL ,
  `delete` TINYINT(1) NOT NULL DEFAULT false ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Grupo de usuarios, por medio de los grupos sacare el menu';


-- -----------------------------------------------------
-- Table `sistCalidad`.`departamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`departamento` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistCalidad`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `userLogin` VARCHAR(45) NOT NULL ,
  `passwordLogin` VARCHAR(250) NOT NULL ,
  `nombre` VARCHAR(60) NOT NULL ,
  `apellido` VARCHAR(60) NOT NULL ,
  `correo` VARCHAR(80) NOT NULL ,
  `lastLogin` DATETIME NULL COMMENT 'Como ya tenemos un historial,\neste campo no es tan necesario,\nsolo lo conservo pra tener una \ninformacion extra de cuando fue la ultima vez que logueo este registro' ,
  `grupo_id` INT NOT NULL ,
  `url_index` VARCHAR(45) NULL ,
  `delete` TINYINT(1) NOT NULL DEFAULT 0 ,
  `departamento_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_grupo1` (`grupo_id` ASC) ,
  UNIQUE INDEX `userLogin_UNIQUE` (`userLogin` ASC) ,
  INDEX `fk_users_departamento1` (`departamento_id` ASC) ,
  CONSTRAINT `fk_users_grupo1`
    FOREIGN KEY (`grupo_id` )
    REFERENCES `sistCalidad`.`grupo` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_users_departamento1`
    FOREIGN KEY (`departamento_id` )
    REFERENCES `sistCalidad`.`departamento` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Usuarios que podran accesar al sistema';


-- -----------------------------------------------------
-- Table `sistCalidad`.`bitacora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`bitacora` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL DEFAULT 'Desconocido' ,
  `sql` TEXT NOT NULL ,
  `fecha` DATETIME NOT NULL COMMENT 'Fecha de la accion' ,
  `users_id_responsable` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_bitacora_users1` (`users_id_responsable` ASC) ,
  CONSTRAINT `fk_bitacora_users1`
    FOREIGN KEY (`users_id_responsable` )
    REFERENCES `sistCalidad`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
COMMENT = 'Aqui estaran registrados todos los sucesos relacionados con ' /* comment truncated */;


-- -----------------------------------------------------
-- Table `sistCalidad`.`menu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `url` VARCHAR(50) NULL DEFAULT '#' ,
  `parent` INT NULL ,
  `grupo` TEXT NULL ,
  `delete` TINYINT(1) NOT NULL DEFAULT false COMMENT 'Este campo se utilizara para las eliminaciones logicas' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_menu_menu1` (`parent` ASC) ,
  CONSTRAINT `fk_menu_menu1`
    FOREIGN KEY (`parent` )
    REFERENCES `sistCalidad`.`menu` (`id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Menu General del sistema, si restriccion de niveles';


-- -----------------------------------------------------
-- Table `sistCalidad`.`ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT 0 ,
  `ip_address` VARCHAR(16) NOT NULL DEFAULT 0 ,
  `user_agent` VARCHAR(120) NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT 0 ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) ,
  INDEX `last_activity_idx` (`last_activity` ASC) )
ENGINE = InnoDB
COMMENT = 'Se guardaran todas las sessiones activas';


-- -----------------------------------------------------
-- Table `sistCalidad`.`historialSessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`historialSessions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `users_id` INT NOT NULL ,
  `fechaIngreso` DATETIME NOT NULL COMMENT 'se guardara la fecha en que ingreso el user' ,
  `userData` TEXT NOT NULL COMMENT 'Aqui se guardara todo\n lo que tiene que ver con la session (TODO)' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_historialSessions_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_historialSessions_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `sistCalidad`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
COMMENT = 'Se guardara un registro por cada session del usuario y con e' /* comment truncated */;


-- -----------------------------------------------------
-- Table `sistCalidad`.`url_especiales`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistCalidad`.`url_especiales` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(50) NOT NULL ,
  `id_users` TEXT NULL COMMENT 'Si este campo esta en NULL\ntodos los usuarios podran ver el \ncontenido del controlador' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Aqui estara la direccion de los controladores, que no estara' /* comment truncated */;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
