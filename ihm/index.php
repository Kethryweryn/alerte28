<?php
session_start();
require_once('config_inc.php');

require_once('../dbAccess.php');
require_once('classes_inc.php');

//ouverture de connexion
//$db=new DB($sDBHost, $sDBUser, $sDBPass, $sDBName);

//vérification de connexion
if($_POST){
	$pseudo=$_POST['_user'];
	$pass=a28crypt($_POST['_pass']);
	if(empty($pseudo) || empty($pass)){
			header('location:index.php?e=1');
	}
	else{
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}
		else{
			$page='accueil';
		}
		$db = new dbAccess();
		$rq = 'SELECT `id`, CONCAT(`prenom`," ",`nom`) as full_name, `admin`, `actif` FROM `a28_user` WHERE `log`="'.$pseudo.'"';
		//TODO j'arrive pas à le faire correctement fonctionner avec le mot de passe... 
		//$rq = 'SELECT `id`, CONCAT(`prenom`," ",`nom`), `admin`, `actif` FROM `a28_user` WHERE `log`="'.$pseudo.'" AND `pass`="'.$pass.'"';
		
		$result = $db->select($rq);
		if(count($result)>=1){
			$_SESSION['pseudo']=$pseudo;
			$redacteur=1;//mysql_fetch_row($oui->req);
			$_SESSION['id']=$result[0]->id;
			$_SESSION['full_name']=$result[0]->full_name;
			$_SESSION['is_admin']=$result[0]->admin;
			$_SESSION['actif']=$result[0]->actif;
			$_SESSION['visible']='="1"';
			$_SESSION['masque']='Voir';
			
			if(1==$_SESSION['is_admin']){
				header('location:admin/gestion.php?page=a28_'.$page);
			}
			else{
				if(1==$_SESSION['actif']){
					header('location:index.php?page=a28_'.$page);
				}
				else{
					header('location:index.php?e=3');	
				}
			}
		}
		else{
			header('location:index.php?e=2');
		}
	}
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
		<link rel="shortcut icon" href="https://webmail.gandi.net/skins/larry/images/favicon.ico">	
		<link rel="stylesheet" type="text/css" href="login_fichiers/styles.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>

	<body>
		<div id="login-form">
			<div class="box-inner">
				<img src="img/logo_ciub.jpg" id="logo" alt="Logo CIUB" border="0" width="128" />

				<?php
				if(isset($_GET['e']) && isset($_GET['page']))
					{displayError($_GET['e'], $_GET['page']);}
				?>
				<form name="form" action="index.php" method="post">			
					<table>
						<tbody>
							<tr>
								<td class="title">
									<label for="rcmloginuser">Utilisateur</label>
								</td>
								<td class="input">
									<input name="_user" id="rcmloginuser" size="40" autocapitalize="off" autocomplete="off" type="text">
								</td>
							</tr>
							<tr>
								<td class="title">
									<label for="rcmloginpwd">Mot de passe</label>
								</td>
								<td class="input">
									<input name="_pass" id="rcmloginpwd" size="40" autocapitalize="off" autocomplete="off" type="password">
								</td>
							</tr>
						</tbody>
					</table>
					<p class="formbuttons"><input class="button mainaction" value="Connexion" type="submit"></p>
			</form>	
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>