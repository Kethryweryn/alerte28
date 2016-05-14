<?php

class UserAction {
	private $id;
	private $user_id;
	private $action_id;
	private $event_id;

	public function __construct($id, $user_id, $action_id, $event_id) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->action_id = $action_id;
		$this->event_id = $event_id;
	}
}