<?php
require_once 'dbAccess.php';

$params = getopt("", array("start", "next", "stop"));

// Connexion bdd
$db_access = new dbAccess ();
