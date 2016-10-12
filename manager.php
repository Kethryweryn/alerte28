<?php
require_once 'dbAccess.php';

$options = getopt("", array("start", "next"));

// Connexion bdd
$db_access = new dbAccess ();

// Event manager
$event_manager = new EventManager ( $db_access );

if ($options["start"])
{

}

if ($options["next"])
{

}
