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

		// On commit la transaction
		$dbAccess->commit();
	} catch (Exception $e) {
		$dbAccess->rollback();
	}

	// Gestion des événements à durée limitée

	sleep(1);
}