<?php
//interdiction d'ouverture directe du fichier !
if('a28_service_inc.php'==$_SERVER['php_self']){
	header('location:index.php?e=6');
}

$oServices=new requete('SELECT `id`, `nom`  FROM `a28_service`','Liste des Services');

$sNomService="";
$sActionBouton="Ajouter";

if(!empty($_GET['id'])){
	$oServiceEdit=new requete('SELECT `id`, `nom`  FROM `a28_service` WHERE `id`="'.$_GET['id'].'"','Service à modifier');

	while($oServiceDetail=mysql_fetch_object($oServiceEdit->req)){
		$idService=$oServiceDetail->id;
		$sNomService=$oServiceDetail->nom;	
	}
	$sActionBouton="Modifier";

}

?>
<h1>Liste des services</h1>
	<?php
		$sTableau=$oServices->liste_tableau($oServices->req, 'a28_service', 'border="1"');
		echo $sTableau;
	?>

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