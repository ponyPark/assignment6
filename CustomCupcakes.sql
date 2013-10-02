-- To execute this file, login to MySQL as root and run the following command:
-- source /path/to/file
-- where the "/path/to/file" is the file path to this .sql file.

--
-- Database: `CustomCupcakes`
--

CREATE DATABASE `CustomCupcakes`;
USE `CustomCupcakes`;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `MailingList` tinyint(1) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` int NOT NULL,
  `Privilege` tinyint(1) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `Cakes`
--

CREATE TABLE IF NOT EXISTS `Cakes` (
  `CakeID` int NOT NULL AUTO_INCREMENT,
  `Flavor` varchar(50) NOT NULL,
  `Img_Url` varchar(100) NOT NULL,
  PRIMARY KEY (`CakeID`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `Fillings`
--

CREATE TABLE IF NOT EXISTS `Fillings` (
  `FillingID` int NOT NULL AUTO_INCREMENT,
  `Flavor` varchar(50) NOT NULL,
  `RGB` varchar(10) NOT NULL,
  PRIMARY KEY (`FillingID`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `Frosting`
--

CREATE TABLE IF NOT EXISTS `Frosting` (
  `FrostingID` int NOT NULL AUTO_INCREMENT,
  `Flavor` varchar(50) NOT NULL,
  `Img_Url` varchar(100) NOT NULL,
  PRIMARY KEY (`FrostingID`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `Toppings`
--

CREATE TABLE IF NOT EXISTS `Toppings` (
  `ToppingsID` int NOT NULL AUTO_INCREMENT,
  `Flavor` varchar(50) NOT NULL,
  PRIMARY KEY (`ToppingsID`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `CupcakeOrders`
--

CREATE TABLE IF NOT EXISTS `CupcakeOrders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Quantity` int NOT NULL,
  `CakeID` int NOT NULL,
  `FillingID` int DEFAULT NULL,
  `FrostingID` int NOT NULL,
  PRIMARY KEY (`OrderID`),
  CONSTRAINT FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`CakeID`) REFERENCES `Cakes` (`CakeID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`FillingID`) REFERENCES `Fillings` (`FillingID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`FrostingID`) REFERENCES `Frosting` (`FrostingID`) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `Favorites`
--

CREATE TABLE IF NOT EXISTS `Favorites` (
  `FavoriteID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `CakeID` int NOT NULL,
  `FillingID` int DEFAULT NULL,
  `FrostingID` int NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`FavoriteID`),
  CONSTRAINT FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`CakeID`) REFERENCES `Cakes` (`CakeID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`FillingID`) REFERENCES `Fillings` (`FillingID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`FrostingID`) REFERENCES `Frosting` (`FrostingID`) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteToppings`
--

CREATE TABLE IF NOT EXISTS `FavoriteToppings` (
  `FavoriteToppingsID` int NOT NULL AUTO_INCREMENT,
  `FavoriteID` int NOT NULL,
  `ToppingsID` int NOT NULL,
  PRIMARY KEY (`FavoriteToppingsID`),
  CONSTRAINT FOREIGN KEY (`FavoriteID`) REFERENCES `Favorites` (`FavoriteID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`ToppingsID`) REFERENCES `Toppings` (`ToppingsID`) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `OrderToppings`
--

CREATE TABLE IF NOT EXISTS `OrderToppings` (
  `OrderToppingsID` int NOT NULL AUTO_INCREMENT,
  `OrderID` int NOT NULL,
  `ToppingsID` int NOT NULL,
  PRIMARY KEY (`OrderToppingsID`),
  CONSTRAINT FOREIGN KEY (`OrderID`) REFERENCES `CupcakeOrders` (`OrderID`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`ToppingsID`) REFERENCES `Toppings` (`ToppingsID`) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
