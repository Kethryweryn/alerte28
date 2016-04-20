<?php
require_once 'dbAccess.php';

// Connexion bdd
$db_access = new dbAccess ();

// On instancie une classe qui est en charge de gérer les events
$event_manager = new eventManager ( $db_access );

// On instancie une classe qui est en charge de résoudre les events
$event_solver = new eventSolver ( $db_access );

while ( 1 ) {
	// Lecture en bdd voir si de nouveaux changements sont là
	// Puis on gère ces événements
	foreach ( $event_manager->getNewEvents () as $event ) {
		try
		{
			$event_solver->solve ( $event );
		}
		catch(Exception $e)
		{
			$event_solver->markAsError($event);
		}
		$event_manager->deleteEvent ( $event );
	}
	
	sleep ( 1 );
}