<?php
/**
 * Classe gérant les compteurs d'intervention des PJ sur le jeu
 */
class CounterManager
{
	public function __construct()
	{
		
	}
	
	/**
	 * @brief : renvoie l'identifiant unique du compteur
	 * @param : $unique_name string convention de nommage de l'identifiant
	 * @return : $id : identifiant du compteur
	 */
	public function getRefCounter($unique_name)
	{
		$rq = "select id from a28_counters_ref where unique_name = '".$unique_name."'";
		$db = new dbAccess();
		$result = $db->select($rq);
		foreach($result as $obj)
		{
			return $obj->id;
		}
	}
	
	/**
	 * Met à jour le compteur en fonction de l'heure à laquelle a été passé l'appel à cette méthode
	 * @param $counter_id INT External_ref
	 * @param $value : float
	 * @return none
	 */
	public function updateCounter($counter_id, $value)
	{
		$now = new DateTime();
		$rq = "insert into a28_counters (counter_ref_id, event_on, value) " .
				"VALUES ($counter_ref_id, '".$now."','".$value."' )";
		$db = new dbAccess();
		$db->query($rq);
	}
	
	/**
	 * @brief returns the data for the chart displaying cure progression
	 * @param -
	 * @return array
	 */
	 public function getCureProgress()
	 {
	 	
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getPandemiaProgress()
	 {
	 	
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying Stock Exchange progress
	  * @param -
	  * @return array
	  */
	 public function getStockExchangeProgress()
	 {
	 	
	 }

	 /**
	  * @brief returns the data for the chart displaying Geographic pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getGeographicProgress()
	 {
	 	
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying Geographic pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getCommunicationProgress()
	 {
	 	
	 }

	 
}
