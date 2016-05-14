<?php
// gestion de l'ajout d'utilisateur
//interdiction d'ouverture directe du fichier !
if('a28_actioninc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
// on affiche la liste des évènements survenus et encore utilisables par décroissance inverse
$db = new dbAccess();
$rq = "select * from a28_event where enabled = '1'";
$event_list = $db->select($rq);

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
}

</script>
<div id="table_div"></div>