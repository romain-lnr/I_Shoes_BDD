-- MySQL Script generated by MySQL Workbench
-- Mon Jun 12 08:58:19 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
  `idUsers` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Username` VARCHAR(45) NOT NULL,
  `Firstname` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE INDEX `UNIQUE_Email` (`Email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Basket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Basket` (
  `idBasket` INT NOT NULL,
  `Users_idUsers` INT NOT NULL,
  PRIMARY KEY (`idBasket`),
  INDEX `fk_Basket_Users1_idx` (`Users_idUsers` ASC) VISIBLE,
  CONSTRAINT `fk_Basket_Users1`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `mydb`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Articles` (
  `idArticles` INT NOT NULL,
  `Brand` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(45) NOT NULL,
  `Price` INT(11) NOT NULL,
  `Stock` INT(11) NOT NULL,
  `Image` BLOB(255) NOT NULL,
  PRIMARY KEY (`idArticles`),
  UNIQUE INDEX `UNIQUE_Name` (`Name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Purchase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Purchase` (
  `idPurchase` INT NOT NULL,
  `Date` DATE NOT NULL,
  `Total` INT(11) NOT NULL,
  `Users_idUsers` INT NOT NULL,
  PRIMARY KEY (`idPurchase`),
  INDEX `fk_Purchase_Users1_idx` (`Users_idUsers` ASC) VISIBLE,
  CONSTRAINT `fk_Purchase_Users1`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `mydb`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Basket_has_Articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Basket_has_Articles` (
  `Basket_idBasket` INT NOT NULL,
  `Articles_idArticles` INT NOT NULL,
  `Number` INT(11) NOT NULL,
  PRIMARY KEY (`Basket_idBasket`, `Articles_idArticles`),
  INDEX `fk_Basket_has_Articles_Articles1_idx` (`Articles_idArticles` ASC) VISIBLE,
  INDEX `fk_Basket_has_Articles_Basket1_idx` (`Basket_idBasket` ASC) VISIBLE,
  CONSTRAINT `fk_Basket_has_Articles_Basket1`
    FOREIGN KEY (`Basket_idBasket`)
    REFERENCES `mydb`.`Basket` (`idBasket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Basket_has_Articles_Articles1`
    FOREIGN KEY (`Articles_idArticles`)
    REFERENCES `mydb`.`Articles` (`idArticles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Purchase_has_Articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Purchase_has_Articles` (
  `Purchase_idPurchase` INT NOT NULL,
  `Articles_idArticles` INT NOT NULL,
  PRIMARY KEY (`Purchase_idPurchase`, `Articles_idArticles`),
  INDEX `fk_Purchase_has_Articles_Articles1_idx` (`Articles_idArticles` ASC) VISIBLE,
  INDEX `fk_Purchase_has_Articles_Purchase1_idx` (`Purchase_idPurchase` ASC) VISIBLE,
  CONSTRAINT `fk_Purchase_has_Articles_Purchase1`
    FOREIGN KEY (`Purchase_idPurchase`)
    REFERENCES `mydb`.`Purchase` (`idPurchase`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Purchase_has_Articles_Articles1`
    FOREIGN KEY (`Articles_idArticles`)
    REFERENCES `mydb`.`Articles` (`idArticles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;