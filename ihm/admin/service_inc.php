<?php
$oServices=new requete('SELECT `id`, `nom`  FROM `a28_service`','Services');
//on vérifie l'existence d'un service
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
					<input name="_service" id="_service" size="40" autocapitalize="off" autocomplete="off" type="text">
					<input name="page" id="page" type="hidden" value="service" />
				</td>
			</tr>
		</tbody>
	</table>
	<p class="formbuttons"><input class="button mainaction" value="<?php echo("test"); ?>" type="submit"></p>
</form>	