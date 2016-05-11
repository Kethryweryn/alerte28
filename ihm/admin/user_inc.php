<?php

//si le nouveau gus est chef de service, prév

?>

<h1>Liste des membres</h1>
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
				
				
<form name="form" action="gestion.php" method="post">			
	<table>
		<tbody>
			<tr>
				<td class="title">
					<label for="_username">Nom</label>
				</td>
				<td class="input">
					<input name="_username" id="_username" size="40" autocapitalize="off" autocomplete="off" type="text">
					<input name="page" id="page" type="hidden" value="user" />
				</td>
				<td class="title">
					<label for="_firstname">Pr&eacute;nom</label>
				</td>
				<td class="input">
					<input name="_firstname" id="_firstname" size="40" autocapitalize="off" autocomplete="off" type="text">
				</td>
				<td class="title">
					<label for="_service">Service</label>
				</td>
				<td class="input">
					<input type="radio" id="_service" value="Service1" /> Service 1
				</td>
				<td class="title">
					<label for="_leader">Chef ?</label>
				</td>
				<td class="input">
					<input type="radio" id="_leader" value="1" /> Oui <br />
					<input type="radio" id="_leader" value="0" /> Non
				</td>
			</tr>
		</tbody>
	</table>
	<p class="formbuttons"><input class="button mainaction" value="Connexion" type="submit"></p>
</form>	