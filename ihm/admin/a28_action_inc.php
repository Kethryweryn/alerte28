<?php



?>

<h1>Liste des actions</h1>
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
			<td><a href="gestion.php?page=user&id="><img src="img/wan_pencil.png" style="vertical-align:middle; width:48px;" /><a href="#" onClick="pop()">Modifier</a></a></td>
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
				
				
<form name="form" action="gestion.php" method="post">			
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
	<p class="formbuttons"><input class="button mainaction" value="Connexion" type="submit"></p>
</form>	