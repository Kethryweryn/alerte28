<?php
require_once "dbConfig.php";

class dbAccess {
	private $db;
	private $host;
	private $login;
	private $password;
	private $mysqli;

	public function __construct() {
		$this->db = DB_NAME;
		$this->host = DB_HOST;
		$this->login = DB_LOGIN;
		$this->password = DB_PASSWORD;

		$this->mysqli = $this->connect();
	}

	public function __destruct() {
		$this->mysqli->close();
	}

	/**
	 * Connextion à la BDD
	 * @param -
	 * @return mysqli Object
	 */
	private function connect() {
		$mysqli = new mysqli($this->host, $this->login, $this->password, $this->db);
		if ($mysqli->connect_error) {
			die('Erreur de connexion (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);}
		return $mysqli;
	}
	
	/**
	 * renvoie l'objet mysqli
	 */
	public function getMysqli()
	{
		return $this->mysqli;
	}

	/**
	 * Passe une requête sur la base de données
	 * @param $rq string
	 * @return $ret : mysqli object
	 */

	public function query($rq) {
		return $this->mysqli->query($rq);
	}
	
	/**
	 * Prépare une requête bdd
	 * @param string $rq
	 */
	public function prepare($rq)
	{
		return $this->mysqli->prepare($rq);
	}

	/**
	 * Renvoie un tableau d'objets
	 * @param $rq string
	 * @return array[object]
	 */
	public function select($rq) {
		$ret = $this->query($rq);
		$array_ret = array();

		while ($obj = $ret->fetch_object()) {
			$array_ret[] = $obj;
		}
		return $array_ret;
	}

	public function begin() {
		$this->query("BEGIN;");
	}

	public function commit() {
		$this->query("COMMIT;");
	}

	public function rollback() {
		$this->query("ROLLBACK;");
	}
}
