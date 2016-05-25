<?php
class EventSolver {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}
	
	public function solve(UserAction $user_action)
	{
		// Cette fonction doit résoudre la problématique suivante : quelle est l'impact de l'action
		// faite par l'utilisateur sur l'événement ?
		// Cette problématique est gérée par la table action_event
		// Cette table fait le lien entre une action et ses conséquences pour un événement
		
		// Voici les impacts possibles :
		// - modifier les compteurs (fonction d'event_manager qui modifie la table a28_counters)
		// - terminer l'event, ce qui change le statut de l'event et active les événements suivants dans l'arbre
	}
}