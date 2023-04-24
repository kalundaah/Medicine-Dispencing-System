CREATE TABLE `mda`.`allocation` (`id` INT NOT NULL AUTO_INCREMENT , `doctor` INT NOT NULL , `patient` INT NOT NULL , `medicine` INT NOT NULL , `scenario` INT NOT NULL , `allocated` INT NOT NULL , `cost` INT NOT NULL , `expected` DATE NOT NULL , `time` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `mda`.`doctor` (`id` INT NOT NULL AUTO_INCREMENT , `firstname` INT NOT NULL , `lastname` INT NOT NULL , `phonenos` VARCHAR(255) NOT NULL , `age` INT NOT NULL , `staffid` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `date_added` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `mda`.`medicine` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `type` INT NOT NULL , `cost` INT NOT NULL , `availableamt` INT NOT NULL , `initrestock` INT NOT NULL , `totalsold` INT NOT NULL , `revenue` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `mda`.`medicinetype` (`id` INT NOT NULL AUTO_INCREMENT , `type` VARCHAR(255) NOT NULL , `total` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `mda`.`patient` (`id` INT NOT NULL AUTO_INCREMENT , `firstname` VARCHAR(255) NOT NULL , `lastname` VARCHAR(255) NOT NULL , `phonenos` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `dob` DATE NOT NULL , `email` VARCHAR NOT NULL , `date_added` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `mda`.`scenar` (`id` INT NOT NULL AUTO_INCREMENT , `doctor` INT NOT NULL , `patient` INT NOT NULL , `symptoms` INT NOT NULL , `diagnosis` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `scenario` ADD FOREIGN KEY (`doctor`) REFERENCES `doctor`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `scenario` ADD FOREIGN KEY (`patient`) REFERENCES `patient`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `medicine` ADD FOREIGN KEY (`type`) REFERENCES `medicinetype`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `allocation` ADD FOREIGN KEY (`doctor`) REFERENCES `doctor`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `allocation` ADD FOREIGN KEY (`medicine`) REFERENCES `medicine`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `allocation` ADD FOREIGN KEY (`patient`) REFERENCES `patient`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `allocation` ADD FOREIGN KEY (`scenario`) REFERENCES `scenario`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;