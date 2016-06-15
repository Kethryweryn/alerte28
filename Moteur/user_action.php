<?php
class UserAction {
	public $id;
	public $user_id;
	public $action_id;
	public $event_id;
	public $service_id;
	public function __construct($id, $user_id, $action_id, $event_id, $service_id) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->action_id = $action_id;
		$this->event_id = $event_id;
		$this->service_id = $service_id;
	}
}