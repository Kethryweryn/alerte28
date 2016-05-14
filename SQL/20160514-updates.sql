rename table a28_task to a28_event; 

rename table a28_action_task to a28_action_event;

ALTER TABLE `a28_action_event` CHANGE `task_id` `event_id` INT(11) NULL DEFAULT NULL;

