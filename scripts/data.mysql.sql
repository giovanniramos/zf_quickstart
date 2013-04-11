-- scripts/data.mysql.sql
--
-- You can begin populating the database with the following SQL statements.

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
    ('ralph.schindler@zend.com',
    'Hello! Hope you enjoy this sample zf application!',
    NOW());
INSERT INTO guestbook (email, comment, created) VALUES
    ('foo@bar.com',
    'Baz baz baz, baz baz Baz baz baz - baz baz baz.',
    NOW());
