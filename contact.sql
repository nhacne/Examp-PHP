CREATE TABLE IF NOT EXISTS `contact` (
                                         `id` int(11) NOT NULL AUTO_INCREMENT,
                                         `name` varchar(100) NOT NULL,
                                         `phone number` int(10) NOT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 4;

INSERT INTO `contact` (`id`, `name`, `phone number`) VALUES
                                                         (1, 'Jackie Ross', '0123456789'),
                                                         (2,'Logan Bennett', '0987654321'),
                                                         (3, 'Judy Fuller', '0975312468');