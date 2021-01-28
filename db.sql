CREATE TABLE `phprestcrud`.`posts` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `category_id` INT(11) NOT NULL , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `phprestcrud`.`categories` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `posts` ADD FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

