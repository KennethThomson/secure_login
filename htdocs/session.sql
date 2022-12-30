/* Insert this SQL statement into your database management application */

CREATE TABLE IF NOT EXISTS `accounts` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB;

/* Insert Test Data */
INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com');
