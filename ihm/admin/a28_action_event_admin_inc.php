<?php
// gestion des actions des joueurs sur un évènement
//interdiction d'ouverture directe du fichier !
if('a28_action_event_admin_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
$db = new dbAccess();
if(isset($_POST))
{
	// nettoyage de toutes les données d'impact
	$rq = "delete from a28_action_event where event_id = ".$_GET['eid'];
	$db->query($rq);
	foreach($_POST as $val => $impact)
	{
		$array = explode("_", $val);
		if(!empty($impact))
			if($array[0] == "tex")
			{
				// on peut faire l'insert
				$rq = "insert into a28_action_event (action_id, event_id, impact, counter_id, end_event) VALUES (".
						$array[2].", ".
						$_GET['eid'].", ".
						$impact.", ".
						$_POST['sel_'.$array[1]."_".$array[2]].", false)";
				
				$db->query($rq);
			}
	}
}

$rq = "select a.service_id, b.nom as service_name, a.name as action_name, a.id as action_id from a28_action a
		join a28_service b on b.id = a.service_id
		order by a.service_id, name
		";

$result = $db->select($rq);

function fillSelect($name)
{
	$db = new dbAccess();
	
	$rq ="select id, name from a28_counters_ref";
	$res = $db->select($rq);
	$html_select = "<select name=$name> ";
	foreach($res as $counter)
	{
		$html_select .= "<option value=".$counter->id."  >".$counter->name."</option>";
	}
				
				
	
	$html_select .= "</select>";
	return $html_select;
}
?>
<form method=POST action="gestion.php?page=a28_action_event_admin?eid=<?php echo $_GET['eid']; ?>"> 
<?php 

$service = 0;
foreach( $result as $action)
{
	if($action->service_id != $service)
	{
		if($service != 0)
		{
			echo "</fieldset>";
		}
		echo "<fieldset>
				<legend>".$action->service_name."</legend>";
		$service = $action->service_id;
		
	}
	// TODO il faut mettre la valeur par défaut... 
	echo "<fieldset><legend>".$action->action_name."</legend>
			<div id=div_".$action->action_id.">".
				fillSelect('sel_a_'.$action->action_id)."
				<input name=tex_a_".$action->action_id." type=text></div><div>".
				fillSelect('sel_b_'.$action->action_id)."
				<input name=tex_b_".$action->action_id." type=text></div><div>".
				fillSelect('sel_c_'.$action->action_id)."
				<input name=tex_c_".$action->action_id." type=text>
			</div>
			</fieldset>";
	
}
echo "</fieldset>";
?>
<input type=submit value="Sauvegarder">
</form>
