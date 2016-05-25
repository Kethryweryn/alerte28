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
		
		// On récupère la liste des action_event en fonction d'action_id et event_id
		// (Note : action_id peut être NULL si c'est la résolution par défaut)
		
		$stmt = $db->prepare("SELECT * from `a28_action_event` WHERE event_id = ? AND action_id = ? ;");
		$stmt->bind_param($user_action->event_id, $user_action->action_id);
		$stmt->bind_result(); // TODO
		
		while($stmt->fetch())
		{
			
		}
	}
}