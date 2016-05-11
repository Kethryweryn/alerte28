<?php
//interdiction d'ouverture directe du fichier !
if('a28_user_inc.php'==$_SERVER['php_self']){
	header('location:index.php?e=6');
}

$oUsers=new requete('SELECT `id`, `nom`  FROM `a28_user`','Liste des Users');

$sNomUser="";
$sPrenomUser="";
$iServiceId="";
$iIsLeader="";
$sActionBouton="Ajouter";

if(!empty($_GET['id'])){
	$oUserEdit=new requete('SELECT `id`, `nom`, `prenom`, `idService`, `isLeader` FROM `a28_user` WHERE `id`="'.$_GET['id'].'"','user à modifier');

	while($oUserDetail=mysql_fetch_object($oUserEdit->req)){
		$idUser=$oUserDetail->id;
		$sNomUser=$oUserDetail->nom;	
		$sPrenomUser=$oUserDetail->prenom;
		$iServiceId=$oUserDetail->idService;
		$iIsLeader=$oUserDetail->isLeader;
	}
	
	$sActionBouton="Modifier";
}

// liste des services
$oServices=new requete('SELECT `id`, `nom`  FROM `a28_service`','Liste des Services');

?>

<h1>Liste des utilisateurs</h1>

<?php
	$sTableau=$oUsers->liste_tableau($oUsers->req, 'a28_user', 'border="1"');
	echo $sTableau;
?>
	<table border="1">
		<tr>
			<th>Nom</th>
			<th>Pr&eacute;nom</th>
			<th colspan="2">Service</th>
		</tr>
		<tr>
			<td>Nom</td>
			<td>Pr&eacute;nom</td>
			<td>Service</td>
			<td><a href="gestion.php?page=user&id="><img src="img/wan_pencil.png" style="vertical-align:middle; width:48px;" />Modifier</a></td>
		</tr>
		<tr>
			<td>Nom</td>
			<td>Pr&eacute;nom</td>
			<td>Service</td>
			<td><a href="gestion.php?page=user&id="><img src="img/wan_pencil.png" style="vertical-align:middle; width:48px;" />Modifier</a></td>
		</tr>
		<tr>
			<td>Nom</td>
			<td>Pr&eacute;nom</td>
			<td>Service</td>
			<td><a href="gestion.php?page=user&id="><img src="img/wan_pencil.png" style="vertical-align:middle; width:48px;" />Modifier</a></td>
		</tr>
</table>
				
				
<form name="form" action="editUser.php" method="post">			
	<table>
		<tbody>
			<tr>
				<td class="title">
					<label for="_username">Nom</label>
				</td>
				<td class="input">
					<input name="_username" id="_username" size="40" autocapitalize="off" autocomplete="off" type="text" value="<?php echo($sNomService); ?>">
					<input name="page" id="page" type="hidden" value="user" />
				</td>
				<td class="title">
					<label for="_firstname">Pr&eacute;nom</label>
				</td>
				<td class="input">
					<input name="_firstname" id="_firstname" size="40" autocapitalize="off" autocomplete="off" type="text" value="<?php echo($sNomService); ?>">
				</td>
				<td class="title">
					<label for="_service">Service</label>
				</td>
				<td class="input">
					<?php
						echo($oServices->liste_option($oServices->req, '_service', 'Choisissez un service...', '', '', $iServiceId));
					?>
				</td>
				<td class="title">
					<label for="_leader">Chef ?</label>
				</td>
				<td class="input">
					<input type="radio" id="_leader" value="1" <?php echo(preselect(1, $iIsLeader, '')); ?> /> Oui <br />
					<input type="radio" id="_leader" value="0" <?php echo(preselect(0, $iIsLeader, '')); ?> /> Non
					<input name="_idUser" id="_idUser" type="hidden" value="<?php echo($_GET['id']); ?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<p class="formbuttons"><input class="button mainaction" value="<?php echo($sActionBouton); ?>" type="submit"></p>
</form>	