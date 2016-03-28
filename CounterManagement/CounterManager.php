<?php
class CounterManager
{
	public function __construct()
	{
		
	}
	
	public function getRefCounter($unique_name)
	{
		$rq = "select id from ";
	}
	
	public function updateCounter($counter_id, $value)
	{
		$now = new DateTime();
		$rq = "insert into a28_counters (counter_ref_id, event_on, value) " .
				"VALUES ($counter_ref_id, '".$now."','".$value."' )";
		$db = new dbAccess();
		$db->query($rq);
	}
}
?>
