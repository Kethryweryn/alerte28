<?php
require_once('../../dbAccess.php');
$db = new dbAccess();
if(!isset($_GET['option']))
{
	$rq = "select description from a28_event where id = ".$_GET['id'];
	$result = $db->select($rq);
	
	echo $result[0]->description;
}
else 
{
	switch($_GET['option'])
	{
		case 'spec_act':
			$action_id = $_GET['id'];
			$rq = "select html_content from a28_action where id=$action_id";
			$res_type = $db->select($rq);
			//$rq2 = "select name, val from a28_action_params where action_id=$action_id";
			$rq2 = "select id, name from a28_action where parent_id = ".$action_id;
			$res_opt = $db->select($rq2);
			$content = "";
			switch($res_type[0]->html_content)
			{
				case 'select':
					$content .= "<select name='spec_action'>";
					foreach($res_opt as $option)
					{
						$content .= "<option value='".$option->id."' >".$option->name."</option>";
					}
					$content .= "</select>";
					break;
				default : 
					break;
			}
			echo $content;
			break;

		default:
			break;
	}
}