ALTER TABLE `a28_action` ADD `password` VARCHAR(255) NOT NULL AFTER `name`;

ALTER TABLE `a28_action` ADD `description` TEXT NOT NULL AFTER `password`;

ALTER TABLE `a28_action` ADD `html_content` VARCHAR(255) NOT NULL AFTER `description`;

CREATE TABLE `a28_action_params` (
  `id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `a28_action_params` ADD `counter_id` INT NOT NULL AFTER `val`, ADD `impact` INT NOT NULL AFTER `counter_id`;

ALTER TABLE `a28_action_event` ADD `counter_id` INT NOT NULL AFTER `impact`;

ALTER TABLE `a28_user_action` ADD `action_param_id` INT NOT NULL AFTER `event_id`;