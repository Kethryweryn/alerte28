ALTER TABLE `a28_service_history` ADD `is_error` BOOLEAN NOT NULL DEFAULT FALSE , ADD `error_message` TEXT NULL ;
ALTER TABLE `a28_user_action` ADD `service_id` INT NOT NULL , ADD INDEX (`service_id`) ;

RENAME TABLE `a28_service_history` TO `a28_action_history`;
ALTER TABLE `a28_action_history` CHANGE `service_id` `service_id` INT(11) NULL, CHANGE `user_id` `user_id` INT(11) NULL;