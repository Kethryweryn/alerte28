<?php
class eventManager {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}

	public function getNewUserActions() {
		// On récupère les événements en bdd
		$res = $db->query("SELECT * from a28_user_action");

		$user_actions = array();

		while ($user_action_db = $res->fetch_object()) {
			$user_action = new UserAction();
			$user_actions[] = $user_action;
		}

		return $user_actions;
	}
}