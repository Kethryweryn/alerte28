<?php
class EventSolver {
	private $db;
	public function __construct($db_access) {
		$this->$db = $db_access;
	}
	public function solve(UserAction $user_action) {
		// Cette fonction doit résoudre la problématique suivante : quelle est l'impact de l'action
		// faite par l'utilisateur sur l'événement ?
		// Cette problématique est gérée par la table action_event
		// Cette table fait le lien entre une action et ses conséquences pour un événement
		
		// Voici les impacts possibles :
		// - modifier les compteurs (fonction d'event_manager qui modifie la table a28_counters)
		// - terminer l'event, ce qui change le statut de l'event et active les événements suivants dans l'arbre
		
		// On récupère la liste des action_event en fonction d'action_id et event_id
		// (Note : action_id peut être NULL si c'est la résolution par défaut)
		$rq = "SELECT impact, counter_id, end_event, next_event_id from `a28_action_event` WHERE event_id = ?";
		if ($user_action->action_id)
			$rq .= "AND action_id = ?";
		else
			$rq .= "AND action_id IS NULL";
		$rq .= " ;";
		
		$stmt = $db->prepare ( $rq );
		if ($user_action->action_id)
			$stmt->bind_param ( "ii", $user_action->event_id, $user_action->action_id );
		else
			$stmt->bind_param ( "i", $user_action->event_id );
		
		$stmt->bind_result ( $impact, $counter_id, $end_event, $next_event_id );
		
		while ( $stmt->fetch () ) {
			// On résout ce que fait l'action
			if ($counter_id) {
				$rq_counter = "INSERT INTO a28_counters(counter_ref_id, event_on, value) VALUES(?, NOW(), ?) ;";
				$stmt_counter = $db->prepare ( $rq_counter );
				$stmt_counter->bind_param ( "id", $counter_id, $impact );
				$stmt_counter->execute ();
			}
			if ($end_event) {
				$rq_event = "UPDATE a28_event SET enabled = FALSE WHERE id = ? ;";
				$stmt_event = $db->prepare ( $rq_event );
				$stmt_event->bind_param ( "i", $user_action->event_id );
				$stmt_event->execute ();
			}
			if ($next_event_id) {
				$rq_next_event = "UPDATE a28_event SET enabled = TRUE WHERE id = ? ;";
				$stmt_next_event = $db->prepare ( $rq_next_event );
				$stmt_next_event->bind_param ( "i", $next_event_id );
				$stmt_next_event->execute ();
			}
		}
	}
}