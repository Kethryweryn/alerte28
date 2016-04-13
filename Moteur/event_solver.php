<?php
class eventSolver {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}
}