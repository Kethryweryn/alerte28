<?php
require_once 'dbAccess.php';

$params = getopt("", array("start", "act:", "stop"));

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
		$db_access->commit ();
		
	} catch ( Exception $e ) {
		$db_access->rollback ();
	}
}

if(in_array($params, "act"))
{
	$act_nb = $params["act"];
	
	if (!is_int($act_nb))
		exit(-1);
	
	// On démarre l'acte demandé
}
