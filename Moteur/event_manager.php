<?php
class eventManager {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}
	
	public function getNewEvents()
	{
		// On récupère les événements en bdd
		$res = $db->basic_select("SELECT * from events");

		$events = array();

		while($event_db = $res->fetch_object())
		{
			$event = new Event();
			$events[] = $event;
		}

		return $events;
	}
}