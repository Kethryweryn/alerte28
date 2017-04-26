<?php
require_once '../dbAccess.php';
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
	public function updateCounter($counter_ref_id, $value)
	{
		$now = new DateTime();
		$now = $now->format("Y-m-d H:m:s");
		
		
		$rq = "insert into a28_counters (counter_ref_id, event_on, value) " .
				"VALUES ($counter_ref_id, '".$now."','".$value."' )";
		$db = new dbAccess();
		$db->query($rq);
	}
	
	/**
	 * @brief : generates array between two times from a math function with a step of 10 mins
	 * @param : date $start_date
	 * @param : date $end_date
	 * @param : string $math_func
	 * @param : string $param 
	 * @return : array $spots
	 */
	 private function getCurveSpots($start_date, $end_date, $math_func, $param = NULL)
	 {
	 	// first, we define the number of points... 
	 	$sec_diff = strtotime($end_date) - strtotime($start_date);
	 	$spots_number = floor($sec_diff / 600);
	 	$spots = array();
	 	for($i = 0;$i<max($spots_number, 15);$i++)
	 	{
	 		if(is_null($param))
	 			$spots[] = $math_func($i);
	 		else
	 			$spots[] = $math_func($i, $param);
	  	}
	 	return $spots;
	 }
	
	/**
	 * @brief returns the data for the chart displaying cure progression
	 * @param -
	 * @return array
	 */
	 public function getCureProgress()
	 {
	 	$cure_array = array();
	 	$db = new dbAccess();
	 	 
	 	// first, we get the specific counters...
	 	
	 	$rq = "select event_value from a28_params where event_name = 'start_date'";
	 	$game_start = $db->select($rq);
	 	$game_start = $game_start[0]->event_value;
		$now = new DateTime();
		$now = $now->format("Y-m-d H:m:s");
		$cure_array = $this->getCurveSpots($game_start, $now, 'pow', 1);
	 	foreach($cure_array as $key=>$cure)
	 	{
	 		$cure_array[$key] = $cure * 0.005;
	 		
	 	}
	 	$counter_ref = $this->getRefCounter('CURE');
	 	$rq = "select value, event_on from a28_counters where counter_ref_id = $counter_ref";
	 	$counters = $db->select($rq);
	 	$counters_array = array();
	 	foreach($counters as $counter)
	 	{
	 		$add_level = floor((strtotime($counter->event_on) - strtotime($game_start))/600);
	 		for($j = $add_level;$j<count($cure_array);$j++)
	 		{
	 			$cure_array[$j] += $counter->value/100;
	 		}
	 	}
	 	
	 	return $cure_array;
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getPandemiaProgress()
	 {
	 	$pandemia_array = array();
	 	$db = new dbAccess();
	 	 
	 	// first, we get the specific counters...
	 	$rq = "select event_value from a28_params where event_name = 'start_date'";
	 	$game_start = $db->select($rq);
	 	$game_start = $game_start[0]->event_value;
	 	$now = new DateTime();
		$now = $now->format("Y-m-d H:m:s");
		
	 	$pandemia_array = $this->getCurveSpots($game_start, $now, 'pow', 2);
	 	foreach($pandemia_array as $key=>$cure)
	 	{
	 		$pandemia_array[$key] = $cure * 0.000195;
	 		
	 	}
	 	return $pandemia_array;
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying Stock Exchange progress
	  * @param -
	  * @return array
	  */
	 public function getStockExchangeProgress()
	 {
	 	$stockExchange_array = array();
	 	$db = new dbAccess();
	 	
	 	// first, we get the specific counters...
	 	 
	 	$rq = "select event_value from a28_params where event_name = 'start_date'";
	 	$game_start = $db->select($rq);
	 	$game_start = $game_start[0]->event_value;
	 	$now = new DateTime();
	 	$now = $now->format("Y-m-d H:m:s");
	 	$stockExchange_array = $this->getCurveSpots($game_start, $now, 'pow', 0);
	 	foreach($stockExchange_array as $key=>$cure)
	 	{
	 		if($key == 0)
	 			$stockExchange_array[$key] = 0;
	 		else
	 			$stockExchange_array[$key] = 100 + $cure * rand(-5, 5);
	 	
	 	}
	 	$counter_ref = $this->getRefCounter('STOCK_MARKET');
	 	$rq = "select value, event_on from a28_counters where counter_ref_id = $counter_ref";
	 	$counters = $db->select($rq);
	 	$counters_array = array();
	 	foreach($counters as $counter)
	 	{
	 		$add_level = floor((strtotime($counter->event_on) - strtotime($game_start))/600);
	 		for($j = $add_level;$j<count($stockExchange_array);$j++)
	 		{
	 			$stockExchange_array[$j] += $counter->value;
	 		}
	 	}
	 	 
	 	
	 	return $stockExchange_array;
	 }

	 /**
	  * @brief returns the data for the chart displaying Geographic pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getGeographicProgress()
	 {
	 	$geographic_array = array();
	 	
	 	return $geographic_array;
	 }
	 
	 /**
	  * @brief returns the data for the chart displaying Geographic pandemia progress
	  * @param -
	  * @return array
	  */
	 public function getCommunicationProgress()
	 {
	 	$comm_array = array();
	 	return $comm_array;
	 
	 }
	 
	 public function generateDiseaseCurves()
	 {
	 	$stream = '{
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Progression infection","pattern":"","type":"number"},
	{"id":"","label":"Progression vaccin","pattern":"","type":"number"}
      ],
  "rows": [';
  		$curve_disease = $this->getPandemiaProgress();
  		$curve_cure = $this->getCureProgress();
  		$array_stream = array();
  		foreach($curve_disease as $key=>$disease_level)
  		{
 			$array_stream[] = '{"c":[{"v":"T'.$key.'","f":null},{"v":'.$disease_level.',"f":null},{"v":'.$curve_cure[$key].',"f":null}]}';
  		}
  		
		$stream .= implode(",\n", $array_stream);
		$stream .= '
      ]
}';
		$fp = fopen("../Google_charts/sampleData.json","w");
		fwrite($fp, $stream);
		fclose($fp);
	 	
	 }
	 
	 
	 public function generateGeoCurves()
	 {
	 	$db = new dbAccess();
	 	 
	 	// first we deploy the disease around the world. 
	 	$rq = "select event_value from a28_params where event_name = 'start_date'";
	 	$game_start = $db->select($rq);
	 	$game_start = $game_start[0]->event_value;
	 	$now = new DateTime();
	 	$now = $now->format("Y-m-d H:m:s");
	 	
	 	$sec_diff = strtotime($now) - strtotime($game_start);
	 	$spots_number = floor($sec_diff / 600)*4;
	 	
	 	$rq = "select count(0) as val from a28_country_list where infected = 1";
	 	$res = $db->select($rq);
	 	$add_infection = $spots_number - $res[0]->val;
	 	if($add_infection>0)
	 	{
	 		$rq = "update a28_country_list set infected = 1 where infected = 0 order by RAND() limit $add_infection";
	 		
	 		$db->query($rq);
	 	}
	 	// then, we get the information
	 	$rq = "select code,infected from a28_country_list ";
	 	
	 	$geos = $db->select($rq);
	 	$stream = '{ "states":
[';
	 	foreach($geos as $key=>$geo)
	 	{
	 		$array_stream[] = '{"abbrev":"'.$geo->code.'", "Infection":'.$geo->infected.'}';
	 	}
	 
	 	$stream .= implode(",\n", $array_stream);
	 	$stream .= '
      ]
}';
	 	$fp = fopen("../Google_charts/sampleGeoData.json","w");
	 	fwrite($fp, $stream);
	 	fclose($fp);
	 	 
	 }
	 
	 
	 
	 function generateStockCurves()
	 {
	 	// we generate here a random curve around the first value (100$) for the stock exchange of +-3%. 
	 	$array = $this->getStockExchangeProgress();
	 	$glob_array = array();
	 	$glob_array['cols'][] = array('type' => 'string');
	 	$glob_array['cols'][] = array('type' => 'number');
	 	$stream = '{"cols":[{"type":"string"},{"type":"number"}],"rows":[';
	 	$array_stream = array();
	 	 
	 	foreach($array as $key=>$stock_level)
	 	{
	 		$array_stream[] = '{"c":[{"v":"T'.$key.'","f":null},{"v":'.$stock_level.',"f":null}]}';
	 	}
	 	$stream .= implode(",\n", $array_stream);
	 	$stream .= '
      ]
}';
	 	$fp = fopen("../Google_charts/sampleStockData.json","w");
	 	fwrite($fp, $stream);
	 	fclose($fp);
	 }
	 
}

