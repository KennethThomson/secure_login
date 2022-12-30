/* Insert this SQL statement into your database management application */

CREATE TABLE IF NOT EXISTS `accounts` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB;