<?php
// gestion des actions des joueurs sur un évènement
//interdiction d'ouverture directe du fichier !
if('a28_action_event_admin_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
$db = new dbAccess();
if(!empty($_POST))
{
	print_r($_POST);
	// nettoyage de toutes les données d'impact
	$rq = "delete from a28_action_event where event_id = ".$_GET['eid'];
	$db->query($rq);
	foreach($_POST as $val => $impact)
	{
		if(substr($val,0,4) == 'play')
		{
			if(strlen($impact))
			{
				$rq = "insert into a28_action_event (action_id, event_id,player_description, impact, counter_id, end_event) 
						VALUES (".
						$array[2].", ".
						$_GET['eid'].", '".
						$impact."', ".
						"0,0, false)";
						$db->query($rq);
						
			}
		}
		elseif(substr($val,0,4) == 'twit')
		{
			if(strlen($impact))
		
			{
				$rq = "insert into a28_action_event (action_id, event_id,twitter_description, impact, counter_id, end_event) 
						VALUES (".
						$array[2].", ".
						$_GET['eid'].", '".
						$impact."', ".
						"0,0, false)";
						$db->query($rq);
			}
		}
		elseif(substr($val,0,4)=='end_')
		{
			
		}
		else 
		{
		$array = explode("_", $val);
		if(!empty($impact))
			if($array[0] == "tex")
			{
				// on peut faire l'insert
				$rq = "insert into a28_action_event (action_id, event_id, impact, counter_id, end_event) 
						VALUES (".
						$array[2].", ".
						$_GET['eid'].", ".
						$impact.", ".
						$_POST['sel_'.$array[1]."_".$array[2]].", false)";
						
			}
		}
	}
}

$rq = "select a.service_id, b.nom as service_name, a.name as action_name, a.id as action_id from a28_action a
		join a28_service b on b.id = a.service_id
		order by a.service_id, name
		";

$result = $db->select($rq);

function fillSelect($name, $val)
{
	$db = new dbAccess();
	
	$rq ="select id, name from a28_counters_ref";
	$res = $db->select($rq);
	$html_select = "<select name=$name> ";
	foreach($res as $counter)
	{
		if($val != $counter->id)
			$html_select .= "<option value=".$counter->id."  >".$counter->name."</option>";
		else
			$html_select .= "<option value=".$counter->id." selected=true >".$counter->name."</option>";
	}
				
				
	
	$html_select .= "</select>";
	return $html_select;
}
?>
<a href="gestion.php?page=a28_action_admin">Retour à la liste des events</a>
<form method=POST action="gestion.php?page=a28_action_event_admin&eid=<?php echo $_GET['eid']; ?>"> 
<?php 
// on récupère les valeurs des edit boxes

$service = 0;
foreach( $result as $action)
{
	$rq = "select counter_id, impact, twitter_description, player_description, end_event from a28_action_event where  action_id=".$action->action_id." and event_id=".$_GET['eid'];
	$impacts = $db->select($rq);
	// QUE C'EST CRAAAADE !!!
	$val_a = '';
	$val_b = '';
	$val_c = '';
	$sel_a = 1;
	$sel_b = 1;
	$sel_c = 1;
	$twitt = '';
	
	$player_desc = '';
	$end_event = '';
	
	
	
	if(count($impacts))
	{
		foreach($impacts as $impact)
		{
			if($val_a == '')
			{
				$val_a = $impact->impact;
				$sel_a = $impact->counter_id;
				
			}
			elseif($val_b == '')
			{
				$val_b = $impact->impact;
				$sel_b = $impact->counter_id;
				
			}
			elseif($val_c == '')
			{
				$val_c = $impact->impact;
				$sel_c = $impact->counter_id;
				
			}
			elseif($twitt == '') 
			{
				$twitt = $impact->twitter_description;
			}
			elseif($player_desc == '') 
			{
				$player_desc = $impact->player_description;
				
			}
			else 
			{
				$end_event = $impact->end_event;
			}
		}
	}
	
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
				fillSelect('sel_a_'.$action->action_id, $sel_a)."
				<input name=tex_a_".$action->action_id." value='".$val_a."' type=text></div><div>".
				fillSelect('sel_b_'.$action->action_id, $sel_b)."
				<input name=tex_b_".$action->action_id." value='".$val_b."' type=text></div><div>".
				fillSelect('sel_c_'.$action->action_id, $sel_c)."
				<input name=tex_c_".$action->action_id." value='".$val_c."' type=text>
				<label for='twitt'>Twitter</label> <textarea rows=4 cols=42 name=twitt_".$action->action_id." id='twitt'  >$twitt</textarea>
				<label for='desc'>Description</label><textarea rows=4 cols=42 name=player_desc_".$action->action_id." id='desc'  >$player_desc</textarea>
				<br /><input type='checkbox' name=end_event_".$action->action_id."   >Action de fin ?
				</div>
			</fieldset>";
	
}
echo "</fieldset>";
?>
<input type=submit value="Sauvegarder">
</form>
