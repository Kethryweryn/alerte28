<?php
session_start();
require_once('config_inc.php');

require_once('classes_inc.php');

//ouverture de connexion
$db=new DB($sDBHost, $sDBUser, $sDBPass, $sDBName);

//vérification de session
if(isset($_SESSION) && isset($_GET['page']) && file_exists($_GET['page'].'_inc.php'))
		{
			// vérification de l'existence du fichier "$_POST['page']_inc.php"
			$page=$_POST['page'];			
		}

else{
	header('location:index.php?page='.$page);
}

if(isset($_GET['page'])){
	$erreur='Vous n\'êtes pas habilit&eacute; à l\'administration du site';
	$direction='<input type="hidden" name="page" id="page" value="'.$_GET['page'].'" />';
}
echo('<?xml version="1.0"?>');
?>

<!DOCTYPE html>
<html class=" js mozilla">
	<head>
		<title>Console</title>
		<meta name="Robots" content="noindex,nofollow">
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
		<meta name="viewport" content="" id="viewport">
		<link rel="stylesheet" type="text/css" href="login_fichiers/styles.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
	</head>

	<body>
		<div id="login-form">
			<div class="box-inner">
				<!--<img src="login_fichiers/roundcube_logo.png" id="logo" alt="Roundcube Webmail" border="0">-->
				Logo
				<?php
					if(isset($erreur)){
						echo $erreur.$direction;
					}
				?>
				<a href="gestion.php?page=service">Service</a> <br />
				<a href="gestion.php?page=user">Utilisateurs</a><br />
				<a href="gestion.php?page=action">Actions</a><br />
				<a href="gestion.php?page=cata">Catastrophe</a>
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>