ALTER TABLE `a28_action_event` ADD `end_event` BOOLEAN NOT NULL DEFAULT FALSE ;
ALTER TABLE `a28_action_event` ADD `next_event_id` INT NULL ;
ALTER TABLE `a28_action_event` ADD INDEX(`action_id`) ;
ALTER TABLE `a28_action_event` ADD INDEX(`event_id`) ;
ALTER TABLE `a28_action_event` ADD INDEX(`next_event_id`) ;
ALTER TABLE `a28_action_event` CHANGE `impact` `impact` DOUBLE NULL ;
ALTER TABLE `a28_action_event` CHANGE `counter_id` `counter_id` INT(11) NULL ;

DROP TABLE a28_action_params ;