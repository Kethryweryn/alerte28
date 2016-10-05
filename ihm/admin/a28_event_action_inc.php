<?php
// gestion des actions des joueurs sur un évènement
//interdiction d'ouverture directe du fichier !
if('a28_event_action_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}

// Ici, on commence par présenter le détail de l'évènement, puis on présente la liste des actions 
// possibles pour agir sur l'évènement... 

$db = new dbAccess();

// on récupère la date de dernière action du service
$rq = "select DATE_ADD(action_on, INTERVAL 30 MINUTE) as target from a28_action_history where service_id = ".$_SESSION['service_id']." 
		and DATE_ADD(action_on, INTERVAL 30 MINUTE) > NOW() ";
$res = $db->select($rq);
if(count($res) == 0)
{

	$rq = "select name, description from a28_event where id = ".$_GET['eid'];
	$result = $db->select($rq);
	if(count($result))
	{
		echo "<div><h1>".$result[0]->name."</h1><p>".$result[0]->description."</p>";
		
	}
	
	
	// Ensuite,on récupère la liste des actions possibles et on les affiche dans une combo
	$service_id = $_SESSION['service_id'];
	$rq = "select a.id, a.name, a.html_content, a.description, a.password 
			from a28_action a 
			join a28_action_event b on b.action_id = a.id
			where b.event_id = ".$_GET['eid']." and a.service_id = $service_id
			group by b.event_id, a.service_id, b.action_id
			";
	$result = $db->select($rq);

?>
<p>
Vous trouverez ci-dessous la liste des actions que vous pouvez accomplir en tant que membre de votre service. 
</p>
<h1>
Nous vous rappelons que votre service ne peut faire qu'une seule action par demie-heure. 
</h1>

<script type="text/javascript">

   function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    //alert(selectedValue);
    $("#myfieldid").remove();
    $.post("getdata.php?option=spec_act&id="+selectedValue, function(response) {
    	$("<div>"+response+"</div>")
        .attr("id", "myfieldid")
        .prependTo("#my_form");
    });
    

       }

  </script>

<form method="POST" action="gestion.php?page=a28_action" id='my_form'> 

<?php 
	echo "<select name=action id=selectBox onchange=\"changeFunc();\">";
	foreach($result as $action)
	{
		$js = '';
		if(strlen($action->html_content))
		{
			// on ajoute le on click et la variable permettant de générer le nouvel élément qui va bien...
			$js = "onselect=\"alert('coucou')\"";
		}
		echo "<option value=".$action->id."  >".$action->name."</option>";
	}
	echo "</select>";
?>
<input type="hidden" name="send_order" value=<?php echo $_GET['eid']; ?> />
<input class="button mainaction" type=submit value="Accomplir" />
</form>

<?php 
}
else
{
?>
<script language="JavaScript">
	TargetDate = "<?php $date = date_create($res[0]->target); echo date_format($date, 'm/d/Y H:i:s'); ?>";
	//TargetDate sera calculé ainsi : récupération du timestamp de la dernière action + 30mn, conversion au format : MM/JJ/AAAA H:mm AM	
	
	BackColor = "";
	ForeColor = "";
	CountActive = true;
	CountStepper = -1;
	LeadingZero = false;
	DisplayFormat = "%%M%% Minutes, %%S%% Secondes";
	FinishMessage = "It is finally here!";
</script>
<p>Il vous reste <script language="JavaScript" src="../js/countdown.js"></script> d'ici votre prochaine action.</p>
				
<?php 
// Si le user est manager, il peut voir les actions précédemment effectuées... 
?>
<script type="text/javascript">
google.charts.load('current', {'packages':['table']});
google.charts.setOnLoadCallback(drawTable);

function drawTable() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Nom');
  data.addColumn('string', 'Login');
  data.addColumn('string', 'Service');
  data.addColumn('string', 'Date');
  data.addColumn('string', 'Action effectuée');
  
  data.addRows([
<?php 
function loadTable($db, $oActions)
{
	if($_SESSION['leader'])
	{
		// on ajoute tous les utilisateurs présents dans le système.
		$array_result = array();
		
		
		
		foreach($oActions as $action)
		{
			$array_result[] = "['".utf8_encode(mysqli_real_escape_string($db->getMysqli(),$action->name))."',
					'".mysqli_real_escape_string($db->getMysqli(),$action->log)."',
					'".mysqli_real_escape_string($db->getMysqli(),$action->service_name)."', 
					'".$action->action_on."', 
					'".utf8_encode(mysqli_real_escape_string($db->getMysqli(),$action->action_name))."']";
		}
		echo implode(",", $array_result);
		?>
		    
		  ]);
		
		  var table = new google.visualization.Table(document.getElementById('table_div'));
		
		  table.draw(data, { width: '100%',allowHtml: true});
		}
		
		</script>
		<div id="table_div"></div>
		<?php 
	}
}
$rq = "select a.action_on, concat(b.nom, ' ', b.prenom) as name, b.log, c.name as action_name, d.nom as service_name from a28_service_history a
					join a28_user b on b.id = a.user_id
					join a28_action c on c.id = a.action_id
					join a28_service d on d.id = a.service_id
					where a.service_id = ".$_SESSION['service_id']. "  order by action_on desc";
//echo $rq;
$oActions = $db->select($rq);

if(count($oActions) == 0)
{
	if($_SESSION['service_id'] == 5)
	{
		$rq = "select a.action_on, concat(b.nom, ' ', b.prenom) as name, b.log, c.name as action_name, d.nom as service_name from a28_service_history a
					join a28_user b on b.id = a.user_id
					join a28_action c on c.id = a.action_id
					join a28_service d on d.id = a.service_id
					order by action_on desc";
		$oActions = $db->select($rq);
		if(count($oActions))
			loadTable($db, $oActions);
	}
}
else 
{
	loadTable($db, $oActions);

}

}
?>