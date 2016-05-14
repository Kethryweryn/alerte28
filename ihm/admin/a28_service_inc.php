<?php
//interdiction d'ouverture directe du fichier !
if('a28_service_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}
$db = new dbAccess();
$rq = 'SELECT `id`, `nom`  FROM `a28_service`';
$oServices = $db->select($rq);

$sNomService="";
$sActionBouton="Ajouter";

if(!empty($_GET['id'])){
	$rq = 'SELECT `id`, `nom`  FROM `a28_service` WHERE `id`="'.$_GET['id'].'"';
	$oServiceEdit = $db->select($rq);

	foreach($oServiceEdit as $oServiceDetail){
		$idService=$oServiceDetail->id;
		$sNomService=$oServiceDetail->nom;	
	}
	$sActionBouton="Modifier";

}

?>
<h1>Liste des services</h1>
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
  data.addRows([
<?php 
// on ajoute tous les utilisateurs présents dans le système.
$array_result = array();



foreach($oServices as $service)
{
	$array_result[] = "[". $service->id.",'".mysqli_real_escape_string($db->getMysqli(),$service->nom)."']";
}
echo implode(",", $array_result);

?>
    
  ]);

  var table = new google.visualization.Table(document.getElementById('table_div'));

  table.draw(data, { width: '100%',allowHtml: true});
}

</script>
<div id="table_div"></div>
<form name="form" action="editService.php" method="post">			
	<table>
		<tbody>
			<tr>
				<td class="title">
					<label for="_service">Nom du service</label>
				</td>
				<td class="input">
					<input name="_nomService" id="_nomService" size="40" autocapitalize="off" autocomplete="off" type="text" value="<?php echo($sNomService); ?>">
					<input name="page" id="page" type="hidden" value="service" />
					<input name="_idService" id="_idService" type="hidden" value="<?php echo($_GET['id']); ?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<p class="formbuttons"><input class="button mainaction" value="<?php echo($sActionBouton); ?>" type="submit"></p>
</form>	