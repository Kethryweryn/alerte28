<?php
include_once('config_inc.php');



?>
<!DOCTYPE html>
<html class=" js mozilla">
	<head>
		<title>Console</title>
		<meta name="Robots" content="noindex,nofollow">
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
		<meta name="viewport" content="" id="viewport">
		<link rel="shortcut icon" href="https://webmail.gandi.net/skins/larry/images/favicon.ico">	
		<link rel="stylesheet" type="text/css" href="login_fichiers/styles.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
		<script language="JavaScript">
		
			TargetDate = "03/27/2025 4:30 PM";
			//TargetDate sera calculé ainsi : récupération du timestamp de la dernière action + 30mn, conversion au format : MM/JJ/AAAA H:mm AM	
			
			BackColor = "";
			ForeColor = "";
			CountActive = true;
			CountStepper = -1;
			LeadingZero = false;
			DisplayFormat = "%%M%% Minutes, %%S%% Secondes";
			FinishMessage = "It is finally here!";
		</script>
		
	</head>

	<body>
		<div id="logout">
			<a href="logout.php">
				<img src="img/remote_logoff.png" title="logout" width="32px"/>D&eacute;connexion
			</a>
		</div>
		
		<div id="login-form">
			<div class="box-inner">
				<div class="hombtn" style="float:right">
					<a href="action.php"><img src="img/home_w.png" title="Retour à l'accueil" style="width:32px" /></a>
				</div>
				<h1>Bienvenue sur l'Interface</h1>
				<p>L'interface est la plateforme de communication du CUIB. Elle vous permettra d'envoyer des ordres à 
				
				
				<p>En tant que membre de { direction toto }, vous disposez des ressources suivantes.<br />
				Que souhaitez-vous faire ?</p>
				
				<p><b>Important</b> : Votre département ne peut lancer qu'une action toutes les 30 minutes.<p>
				
				<p><a href="histo.php">Historique des actions de la { direction toto }</a>.</p>
				<?php 
				// on récupère le timestamp de la dernière action du service
				// et on le compare au timestamp actuel
				// si dernière action +30 mn > actuel : affichage du décompte
				
				echo "<p>Il vous reste <script language=\"JavaScript\" src=\"js/countdown.js\"></script> d'ici votre prochaine action.</p>";
				
				//sinon affichage des actions possibles pour le service
				

				echo "<form name=\"form\" action=\"ar.php\" method=\"post\">			
					<table>
						<tbody>
							<tr>
								<td class=\"title\">
									<label for=\"action\">Action</label>
								</td>
								<td class=\"input\">
									<a href=\"access_management.php\">Droits d'acc&eacute;s à l'Interface</a> <img src=\"help.png\" title=\"Aide\" /><br />";
								
										//listing des actions de service	
											echo "<input type=\"radio\" name=\"action\" value=\"Action_1\" id=\"Action_1\" /> <label for=\"Action_1\">Action 1</label> <br />";
									
							echo"	</td>
							</tr>
						</tbody>
					</table>
					<p class=\"formbuttons\"><input class=\"button mainaction\" value=\"Envoyer\" type=\"submit\"></p>
			</form>";
			?>
					
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>