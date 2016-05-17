<?php
// gestion de l'ajout d'utilisateur
//interdiction d'ouverture directe du fichier !
if('a28_action_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
// on affiche la liste des évènements survenus et encore utilisables par décroissance inverse
$db = new dbAccess();
$rq = "select * from a28_event where enabled = '1'";
$event_list = $db->select($rq);


// Gestion  de la création d'action sur event
if(isset($_POST['send_order']))
{
	// ajout de l'action dans la table du moteur. 
	$action_event_id = 0;
	if(isset($_POST['spec_action']))
	{
		// on a une action spécifique
		$action_event_id = $_POST['spec_action'];
	}
	$rq = "insert into a28_user_action `user_id`,`action_id`,  `event_id`, action_event_id ) 
			VALUES (".$_SESSION['uid'].", ".$_POST['action'].", ".$_POST['send_order'].", ".$action_event_id.")";
	$db->query($rq);
	

?>

<h1>Liste des Evènements</h1>
	<?php
		/*$sTableau=$oServices->liste_tableau($oServices->req, 'a28_service', 'border="1"');
		echo $sTableau;*/
		
	?>
<script type="text/javascript">
google.charts.load('current', {'packages':['table']});
google.charts.setOnLoadCallback(drawTable);

function drawTable() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'id');
  data.addColumn('string', 'Nom');
  data.addColumn('string', 'Intervenir');
  
  data.addRows([
<?php 
// on ajoute tous les utilisateurs présents dans le système.
$array_result = array();



foreach($event_list as $event)
{
	$array_result[] = "[". $event->id.",'".mysqli_real_escape_string($db->getMysqli(),$event->name)."', '<a href=gestion.php?page=a28_event_action&eid=".$event->id."><img src=\'../img/action.ico\' height=25/></a>']";
}
echo implode(",", $array_result);

?>
    
  ]);

  var table = new google.visualization.Table(document.getElementById('table_div'));

  table.draw(data, { width: '100%',allowHtml: true});

  google.visualization.events.addListener(table, 'select', selectHandler);
  function selectHandler(e) {
	  var selection = table.getSelection();
	  var item = selection[0];
	  // récupération de l'id
	  var str = data.getFormattedValue(item.row, 0);
	  $.post("getdata.php?id="+str, function(response) {
		  	$('#event_descrip').text(response);
	    });   

  }
}

</script>
<div id="table_div"></div>
<div id="event_descrip" height="300"></div>