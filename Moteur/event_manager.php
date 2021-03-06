<?php
class EventManager {
	private $db;
	/**
	 * Constructeur
	 *
	 * @param unknown $db_access
	 */
	public function __construct($db_access) {
		$this->db = $db_access;
	}
	/**
	 * Récupération des actions joueurs
	 */
	public function getNewUserActions() {
		// On récupère les événements en bdd
		$res = $this->db->query ( "SELECT * from `a28_user_action` ;" );

		$user_actions = array ();

		while ( $user_action_db = $res->fetch_object () ) {
			$user_action = new UserAction ( $user_action_db->id, $user_action_db->user_id, $user_action_db->action_id, $user_action_db->event_id, $user_action_db->service_id );
			$user_actions [] = $user_action;
		}

		return $user_actions;
	}
	/**
	 * Récupération des événements terminés
	 */
	public function getOutdatedEvents() {
		$res = $this->db->query ( "SELECT a28_event.id from a28_event JOIN a28_act ON a28_event.act_id = a28_act.id WHERE a28_event.enabled = 1 AND TIMESTAMPDIFF(MINUTE, a28_act.start_on, a28_event.start_on) > a28_event.duration ;" );

		// var_dump($this->db->error());

		$event_ids = array ();

		while ( $event_db = $res->fetch_object () ) {
			$event_ids [] = $event_db->id;
		}

		return $event_ids;
	}
}