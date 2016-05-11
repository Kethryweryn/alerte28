<?php
require_once "dbConfig.php";

class dbAccess
{
	private $db;
	private $host;
	private $login;
	private $password;
	public function __construct()
	{
		$this->db = DB_NAME;
		$this->host = DB_HOST;
		$this->login = DB_LOGIN;
		$this->password = DB_PASSWORD;
	}
	
	/**
	 * Connextion à la BDD
	 * @param -
	 * @return mysqli Object
	 */
	private function connect()
	{
		$mysqli = new mysqli($this->host, $this->login, $this->password, $this->db);
		if ($mysqli->connect_error) {
    		die('Erreur de connexion (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);}
		return $mysqli;
	}
	
	/** 
	 * Passe une requête sur la base de données
	 * @param $rq string
	 * @return $ret : mysqli object
	 */
	 
	public function query($rq)
	{
		$mysqli = $this->connect();
		$ret = $mysqli->query($rq);
		$mysqli->close();
		return $ret;
	}
	
	/**
	 * Renvoie un tableau d'objets
	 * @param $rq string
	 * @return array[object]
	 */
	public function select($rq)
	{
		$ret = $this->query($rq);
		$array_ret = array();
		
		while($obj = $ret->fetch_object())
		{
			$array_ret[] = $obj;
		}
		return $array_ret;
	}

	public function basic_select($rq)
	{
		return $this->query($rq);
	}
}

