<?php
//interdiction d'ouverture directe du fichier !
if('a28_user_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}

// Gestion de la création d'utilisateur

if(isset($_POST['create_user']))
{
	
	$db = new dbAccess();
	$mysqli = $db->connect();
	$rq = "insert into a28_user (nom, prenom, log, pass, actif, service_id, leader, admin) 
			VALUES ('".mysqli_real_escape_string($mysqli, $_POST['nom'])."',
					'".mysqli_real_escape_string($mysqli, $_POST['prenom'])."',
					'".mysqli_real_escape_string($mysqli, $_POST['login'])."',
					'".a28crypt($mysqli, $_POST['password'])."',
					'".mysqli_real_escape_string($mysqli, $_POST['active'])."',
					'".mysqli_real_escape_string($mysqli, $_POST['service'])."',
					'".mysqli_real_escape_string($mysqli, $_POST['manager'])."',
					0)";
	$mysqli->close();
	$db->query($rq);
}


?>

<h1>Liste des utilisateurs</h1>

<script type="text/javascript">
google.charts.load('current', {'packages':['table']});
google.charts.setOnLoadCallback(drawTable);

function drawTable() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'id');
  data.addColumn('string', 'Prénom');
  data.addColumn('string', 'Nom');
  data.addColumn('string', 'Service');
  data.addColumn('string', 'Modifier');
  data.addRows([
<?php 
// on ajoute tous les utilisateurs présents dans le système.
$array_result = array();

$db = new dbAccess();
 

$rq ='SELECT a.id, a.nom, prenom, b.nom as nom_service
		FROM `a28_user` a
		join a28_service b on b.id = a.service_id

		';
$user_list = $db->select($rq);

foreach($user_list as $user)
{
	$array_result[] = "[". $user->id.",'". utf8_encode($user->prenom)."','". $user->nom
			."','" .$user->nom_service. "', '<a href=gestion.php?page=a28_user_add&uid=".$user->id."><img src=\'../img/wan_pencil.png\' height=25/></a>']";
}
echo implode(",", $array_result);

?>
    
  ]);

  var table = new google.visualization.Table(document.getElementById('table_div'));

  table.draw(data, { width: '100%',allowHtml: true});
}

</script>
<div id="table_div"></div>


	<p class="formbuttons">
	<input class="button mainaction" value="Ajouter un utilisateur" type="submit" onclick="window.location='gestion.php?page=a28_user_add';"></p>
	