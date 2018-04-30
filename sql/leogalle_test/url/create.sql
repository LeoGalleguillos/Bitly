CREATE TABLE `url` (
    `url_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `url` varchar(255) NOT NULL,
    `url_shortened` VARCHAR(255) NOT NULL,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`url_id`),
    INDEX (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
