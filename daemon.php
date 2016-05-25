<?php
require_once 'dbAccess.php';

// Connexion bdd
$db_access = new dbAccess();

// On instancie une classe qui est en charge de gérer les events
$event_manager = new eventManager($db_access);

// On instancie une classe qui est en charge de résoudre les events
$event_solver = new eventSolver($db_access);

while (1) {
	try
	{
		// On commence une transaction
		$dbAccess->begin();

		// Lecture en bdd voir si de nouveaux changements sont là
		// Puis on gère ces événements
		foreach ($event_manager->getNewUserActions() as $user_action) {
			try {
				$event_solver->solve($user_action);
			} catch (Exception $e) {
				$event_solver->markAsError($user_action);
			}
		}

		// On truncate la table des user actions
		$dbAccess->query("TRUNCATE TABLE a28_user_action ;");

		// On commit la transaction
		$dbAccess->commit();
	} catch (Exception $e) {
		$dbAccess->rollback();
	}

	// Gestion des événements à durée limitée
	
	// Il faut une gestion en actes donc il faut que chaque événement soit lié à un acte
	// Il faut pouvoir déclencher le début et la fin d'un acte
	
	// On récupère la liste des événements en cours
	// On fait la différence entre le start date de l'événement et sa durée
	// Si le temps est dépassé on solve l'événement avec la résolution par défaut
	// La résolution par défaut se fait en prenant les actions typées "default" (booléen) dans la table action_event

	sleep(1);
}