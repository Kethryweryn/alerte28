CREATE TABLE IF NOT EXISTS `a28_act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `a28_event`
  DROP `predecessor`,
  DROP `successor`;
  
 ALTER TABLE `a28_event` ADD `start_on` DATETIME NULL , ADD `act_id` INT NOT NULL , ADD `start_with_act` BOOLEAN NOT NULL DEFAULT FALSE , ADD INDEX (`act_id`) ;