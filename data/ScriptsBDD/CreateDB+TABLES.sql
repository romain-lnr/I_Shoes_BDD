-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.1.0-MariaDB
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

-- Dumping database structure for I_Shoes
DROP DATABASE IF EXISTS I_Shoes;
CREATE DATABASE IF NOT EXISTS I_Shoes;
USE I_Shoes;


-- Dumping structure for table users
DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  Name VARCHAR(50) NOT NULL,
  Username VARCHAR(50) NOT NULL,
  Firstname VARCHAR(50) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (Email)
  );
  
  
-- Dumping structure for table basket
DROP TABLE IF EXISTS basket;
CREATE TABLE IF NOT EXISTS basket (
  id INT(11) NOT NULL AUTO_INCREMENT,
  TotPrice INT(11) NOT NULL,
  PRIMARY KEY (id)
  );  

-- Dumping structure for table articles
DROP TABLE IF EXISTS articles;
CREATE TABLE IF NOT EXISTS articles (
  id INT(11) NOT NULL AUTO_INCREMENT,
  NumArticle INT(11) NOT NULL,
  Name VARCHAR(50) NOT NULL,
  Mark VARCHAR(20) NOT NULL,
  Description VARCHAR(1000) NOT NULL,
  Price INT(11) NOT NULL,
  Stock INT(11) NOT NULL,
  Image VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (NumArticle)
  );