<?php
require_once 'dbAccess.php';
require_once '../Moteur/event_manager.php';
require_once '../Moteur/event_solver.php';
require_once '../Moteur/user_action.php';

// Connexion bdd
$db_access = new dbAccess ();

// On instancie une classe qui est en charge de gérer les events
$event_manager = new EventManager ( $db_access );

// On instancie une classe qui est en charge de résoudre les events
$event_solver = new EventSolver ( $db_access );

while ( 1 ) {
	try {
		// On commence une transaction
		$dbAccess->begin ();

		// Lecture en bdd voir si de nouveaux changements sont là
		// Puis on gère ces événements
		foreach ( $event_manager->getNewUserActions () as $user_action ) {
			try {
				$event_solver->solve ( $user_action );
			} catch ( Exception $e ) {
				$event_solver->markAsError ( $user_action, $e );
			}
		}

		// On truncate la table des user actions
		$dbAccess->query ( "TRUNCATE TABLE a28_user_action ;" );

		// On commit la transaction
		$dbAccess->commit ();
	} catch ( Exception $e ) {
		$dbAccess->rollback ();
	}

	// Gestion des événements à durée limitée

	// Il faut une gestion en actes donc il faut que chaque événement soit lié à un acte
	// Il faut pouvoir déclencher le début et la fin d'un acte

	// On récupère la liste des événements en cours
	// On fait la différence entre le start date de l'événement et sa durée
	// Si le temps est dépassé on solve l'événement avec la résolution par défaut
	// La résolution par défaut se fait en prenant les actions qui n'ont pas d'action_id dans la table action_event

	foreach ( $event_manager->getOutdatedEvents () as $event ) {
		// On crée une user_action qui n'a pas d'action_id et on la solve
		$user_action = new UserAction ( null, null, null, $event->id, null );
		try {
			$event_solver->solve ( $user_action );
		} catch ( Exception $e ) {
			$event_solver->markAsError ( $user_action, $e );
		}
	}

	sleep ( 1 );
}