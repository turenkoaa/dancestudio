drop database studio;
create database studio;
use studio;

-- -----------------------------------------------------
-- Table `Clients`
-- -----------------------------------------------------

CREATE TABLE `Clients` (
  `idClient` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `surnameCl` VARCHAR(45) NOT NULL COMMENT '',
  `nameCl` VARCHAR(45) NOT NULL COMMENT '',
  `middleNameCl` VARCHAR(45) NULL COMMENT '',
  `dateOfBirthCl` DATE NULL COMMENT '',
  `genderCl` ENUM('м', 'ж') NULL DEFAULT 'м' COMMENT '',
  `phoneCl` CHAR(11) NOT NULL COMMENT '',
  `emailCl` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idClient`)  COMMENT '',
   UNIQUE KEY `ix_clients` (`surnameCl`, `nameCl`, `phoneCl`),
  UNIQUE INDEX `id _clients_UNIQUE` (`idClient` ASC)  COMMENT '')
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Style`
-- -----------------------------------------------------

CREATE TABLE `Style` (
  `idStyle` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nameSt` VARCHAR(45) NOT NULL COMMENT '',
  `aboutSt` VARCHAR(300) NULL COMMENT '',
  PRIMARY KEY (`idStyle`)  COMMENT '',
  UNIQUE KEY `ix_style` (`nameSt`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Abonement`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `Abonement` (
  `idAbonement` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `typeOfTrainings` ENUM('персональные', 'групповые', 'мини группа') NOT NULL COMMENT '',
  `priceAb` INT NOT NULL COMMENT '',
  `numOfTrainings` INT NOT NULL COMMENT '',
  `numActiveDays` INT NULL COMMENT '',
  `sale` INT NULL COMMENT '',
  `nameAb` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`idAbonement`)  COMMENT '',
  UNIQUE KEY `ix_abonement` (`typeOfTrainings`, `nameAb`),
  UNIQUE INDEX `id_abonement_UNIQUE` (`idAbonement` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Staff`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `Staff` (
  `idStaff` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `post` VARCHAR(45) NULL DEFAULT 'тренер' COMMENT '',
  `surnameSt` VARCHAR(45) NOT NULL COMMENT '',
  `nameSt` VARCHAR(45) NOT NULL COMMENT '',
  `middleNameSt` VARCHAR(45) NULL COMMENT '',
  `dateOfBirthSt` DATE NULL COMMENT '',
  `genderSt` ENUM('м', 'ж') NOT NULL COMMENT '',
  `phoneSt` CHAR(11) NOT NULL COMMENT '',
  `passportSt` VARCHAR(10) NOT NULL COMMENT '',
  `emailSt` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idStaff`)  COMMENT '',
  UNIQUE KEY `ix_staff` (`surnameSt`, `nameSt`))
ENGINE = InnoDB;

/*
-- -----------------------------------------------------
-- Table `Coaches`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `Coaches` (
  `idCoach` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `idStaff` INT NOT NULL COMMENT '',
  `info` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idCoach`)  COMMENT '',
  INDEX `fk_Coaches_Staff1_idx` (`idStaff` ASC)  COMMENT '',
  CONSTRAINT `fk_Coaches_Staff1`
    FOREIGN KEY (`idStaff`)
    REFERENCES `Staff` (`idStaff`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

-- -----------------------------------------------------
-- Table `Trainings`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `Trainings` (
  `idTrain` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `typeOfTrain` ENUM('персональные', 'групповые', 'мини группа') NOT NULL COMMENT '',
  `idStyle` INT NOT NULL COMMENT '',
  `durationMinutes` INT NULL COMMENT '',
  `idCoach` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idTrain`)  COMMENT '',
  UNIQUE KEY `ix_train` (`idStyle`, `idCoach`, `typeOfTrain`),
  INDEX `fk_Trainings_Style_idx` (`idStyle` ASC)  COMMENT '',
  INDEX `fk_Trainings_Coaches1_idx` (`idCoach` ASC)  COMMENT '',
  CONSTRAINT `fk_Trainings_Style`
    FOREIGN KEY (`idStyle`)
    REFERENCES `Style` (`idStyle`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Trainings_Coaches1`
    FOREIGN KEY (`idCoach`)
    REFERENCES `Staff` (`idStaff`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AbonementOfClient`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS`AbonementOfClient` (
  `idAbonementOfClient` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `idClient` INT NOT NULL COMMENT '',
  `idAbonement` INT NOT NULL COMMENT '',
  `firstDate` DATE NOT NULL COMMENT '',
  `lastDate` DATE NULL COMMENT '',
  `statusAb` ENUM('активен', 'неактивен') NOT NULL DEFAULT 'активен' COMMENT '',
  `countOfTrains` INT NOT NULL DEFAULT 0 COMMENT '',
  `isPaid` BOOLEAN NOT NULL DEFAULT 0 COMMENT '',
  `amountPay` INT NULL COMMENT '',
  `datePay` DATE NULL COMMENT '',
  `freezingFirstDay` DATE NULL COMMENT '',
  `freezingNumberDays` INT COMMENT '',
  INDEX `fk_Payment_Clients1_idx` (`idClient` ASC)  COMMENT '',
  INDEX `fk_Payment_Abonement1_idx` (`idAbonement` ASC)  COMMENT '',
  PRIMARY KEY (`idAbonementOfClient`)  COMMENT '',
  UNIQUE KEY `ix_abonement_of_client` (`idClient`, `idAbonement`),
  CONSTRAINT `fk_Payment_Clients1`
    FOREIGN KEY (`idClient`)
    REFERENCES `Clients` (`idClient`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Payment_Abonement1`
    FOREIGN KEY (`idAbonement`)
    REFERENCES `Abonement` (`idAbonement`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `TimeOfTrain`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `TimeOfTrain` (
  `idTime` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `start` TIME NOT NULL COMMENT '', /* UK должен быть по этму полю */
  `end` TIME NULL COMMENT '',
  PRIMARY KEY (`idTime`)  COMMENT '',
  UNIQUE KEY `ix_timeoftrain` (`start`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Timetable`


CREATE TABLE IF NOT EXISTS `Timetable` (
  `idTimetable` INT  NOT NULL AUTO_INCREMENT COMMENT '',
  `dayOfWeek` ENUM('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun') NOT NULL COMMENT '',
  `numberOfGum` INT NOT NULL DEFAULT '1' COMMENT '',
  `idTime` INT NOT NULL COMMENT '',
  `idTrain` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idTimetable`)  COMMENT '',
  UNIQUE KEY `ix_timetable` (`dayOfWeek`, `numberOfGum`, `idTime`),
  INDEX `fk_Timetable_time_of_train1_idx` (`idTime` ASC)  COMMENT '',
  INDEX `fk_Timetable_Trainings1_idx` (`idTrain` ASC)  COMMENT '',
  CONSTRAINT `fk_Timetable_time_of_train1`
    FOREIGN KEY (`idTime`)
    REFERENCES `TimeOfTrain` (`idTime`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Timetable_Trainings1`
    FOREIGN KEY (`idTrain`)
    REFERENCES `Trainings` (`idTrain`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Registerings`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `Registerings` (
  `idRegisterings` INT NOT NULL AUTO_INCREMENT,
  `dateReg` DATE NOT NULL,
  `isVisit` ENUM('да', 'нет') NOT NULL,
  `idTimetable` INT NOT NULL,
  `idAbonement` INT NOT NULL,
  PRIMARY KEY (`idRegisterings`),
  UNIQUE KEY `ix_registerings` (`idAbonement`, `idTimetable`, `dateReg`),
  INDEX `fk_Registerings_Timetable_idx` (`idTimetable` ASC),
  INDEX `fk_Registerings_AbonementOfClient1_idx` (`idAbonement` ASC),
  CONSTRAINT `fk_Registerings_Timetable`
    FOREIGN KEY (`idTimetable`)
    REFERENCES `Timetable` (`idTimetable`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Registerings_AbonementOfClient1`
    FOREIGN KEY (`idAbonement`)
    REFERENCES `AbonementOfClient` (`idAbonementOfClient`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*
-- -----------------------------------------------------
-- Table ``Payment`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `Payment` (
  `idPayment` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `amountPay` INT NOT NULL COMMENT '',
  `datePay` DATE NOT NULL COMMENT '',
  `idAbonementOfClient` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idPayment`)  COMMENT '',
  INDEX `fk_Payment_abonement_of_client1_idx` (`idAbonementOfClient` ASC)  COMMENT '',
  CONSTRAINT `fk_Payment_abonement_of_client1`
    FOREIGN KEY (`idAbonementOfClient`)
    REFERENCES `AbonementOfClient` (`idAbonementOfClient`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
*/
