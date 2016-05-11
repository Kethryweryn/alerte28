<?php
include_once('config_inc.php');



?>
<!DOCTYPE html>
<html class=" js mozilla">
	<head>
		<title>Console - accusé de réception</title>
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
				<h1>Demande enregistr&eacute;e</h1>
						
				<p>Il vous reste <script language="JavaScript" src="js/countdown.js"></script> d'ici votre prochaine action.</p>
				
				<p><a href="histo.php">Historique des actions de la { direction toto }</a>.</p>
				
				<p><a href="action.php">Demander une action</a>.</p>
				
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>