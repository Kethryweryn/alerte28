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
				<h1>Bienvenue sur la plateforme de communication du CUIB.</h1>
				
				<?php //affichage conditionnel Chef de service
				
					echo "<p>En tant que  { titreResponsableDeDirectionToto }, vous pouvez révoquer ou activer les droits d'accès à cette application des personnes suivantes :</p>";
					// on liste tous les membres de la direction de l'user connecté, Leader compris, utilisateur courant compris
				
				//affichage conditionnel DSI
				
					echo "<p>En tant que  { MembreDeLaDSI }, vous pouvez révoquer ou activer les droits d'accès à cette application des personnes suivantes :</p>";
					// on liste ici tous les users, user courant compris
				
				?>
					
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>