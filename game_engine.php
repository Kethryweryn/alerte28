<?php
require_once 'dbAccess.php';

$params = getopt("", array("start", "next", "stop"));

// Connexion bdd
$db_access = new dbAccess ();

if(in_array($params, "start"))
{
	//Début du jeu
	try {
		$db_access->begin ();
		$rq_params = "INSERT INTO a28_params(event_name, event_value) VALUES("start_date", NOW())";
		$stmt_params = $db_access->prepare ( $rq_params );
		$stmt_params->execute ();
		$stmt_params->close();
		// On commit la transaction
		$db_access->commit ();
	} catch ( Exception $e ) {
		$db_access->rollback ();
	}
}
