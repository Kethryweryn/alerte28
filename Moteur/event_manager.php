<?php
class eventManager {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}
	
	public function getNewEvents()
	{
		// On récupère les événements en bdd
	}
}