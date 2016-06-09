<?php
// gestion des actions des joueurs sur un évènement
//interdiction d'ouverture directe du fichier !
if('a28_action_event_admin_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
$db = new dbAccess();

$rq = "select a.service_id, b.nom as service_name, a.name as action_name, a.id as action_id from a28_action a
		join a28_service b on b.id = a.service_id
		order by a.service_id, name
		";

$result = $db->select($rq);
?>
<script type="text/javascript">
<?php 
foreach($result as $action)
{
	// TODO ajout dynamique de content suite au click dans le fieldset.
	echo '
		$( "#butt_'.$action->action_id.'" ).click(function(){
    $("div_'.$action->action_id.'").append("<b>Appended text</b>");
}); ';
}
?>

</script>
<?php 

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
	echo "<fieldset><legend>".$action->action_name."</legend><div id=div_".$action->action_id.">".fillSelect('sel_a_'.$action->action_id)."
			<input name=tex_a_".$action->action_id." type=text></div><button id=butt_".$action->action_id." >+</button></fieldset>";
	
}
echo "</fieldset>";
?>

 