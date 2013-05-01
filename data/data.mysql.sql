#---------------------------------
#  DATABASE guestbook
#---------------------------------
CREATE TABLE `guestbook` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
	`comment` TEXT NULL,
	`created` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

INSERT INTO guestbook (email, comment, created) VALUES
    ('giovanniramos@live.com',
    'Hello friends! Welcome to my guestbook',
    NOW());

#---------------------------------
#  DATABASE books
#---------------------------------
CREATE TABLE `books` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `author` VARCHAR(50) NOT NULL,
    `description` TEXT NULL,
    PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;
