<?php

class UserAction {
	private $id;
	private $user_id;
	private $action_id;
	private $task_id;

	public function __construct($id, $user_id, $action_id, $task_id) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->action_id = $action_id;
		$this->task_id = $task_id;
	}
}