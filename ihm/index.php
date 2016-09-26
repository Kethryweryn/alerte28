<?php
session_start();
require_once('config_inc.php');

require_once('../dbAccess.php');
//require_once('classes_inc.php');

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
		$rq = 'SELECT `id`, CONCAT(`prenom`," ",`nom`) as full_name, `admin`, `actif`, service_id, leader FROM `a28_user` WHERE `log`="'.$pseudo.'"';
		//TODO j'arrive pas à le faire correctement fonctionner avec le mot de passe... 
		//$rq = 'SELECT `id`, CONCAT(`prenom`," ",`nom`), `admin`, `actif` FROM `a28_user` WHERE `log`="'.$pseudo.'" AND `pass`="'.$pass.'"';
		
		$result = $db->select($rq);
		if(count($result)>=1){
			$_SESSION['pseudo']=$pseudo;
			$redacteur=1;//mysql_fetch_row($oui->req);
			$_SESSION['id']=$result[0]->id;
			$_SESSION['full_name']=$result[0]->full_name;
			$_SESSION['is_admin']=$result[0]->admin;
			$_SESSION['service_id']=$result[0]->service_id;
			$_SESSION['actif']=$result[0]->actif;
			$_SESSION['visible']='="1"';
			$_SESSION['masque']='Voir';
			$_SESSION['leader'] = $result[0]->leader;
			
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
<html>
<head>
  <title>Dashboard Starter UI, by Keen IO</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link rel="stylesheet" type="text/css" href="../template/assets/lib/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="../template/assets/css/keen-dashboards.css" />
<style>
  
  blockquote.twitter-tweet {
  display: inline-block;
  font-family: "Helvetica Neue", Roboto, "Segoe UI", Calibri, sans-serif;
  font-size: 12px;
  font-weight: bold;
  line-height: 16px;
  border-color: #eee #ddd #bbb;
  border-radius: 5px;
  border-style: solid;
  border-width: 1px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
  margin: 10px 5px;
  padding: 0 16px 16px 16px;
  max-width: 468px;
}
 
blockquote.twitter-tweet p {
  font-size: 16px;
  font-weight: normal;
  line-height: 20px;
}
 
blockquote.twitter-tweet a {
  color: inherit;
  font-weight: normal;
  text-decoration: none;
  outline: 0 none;
}
 
blockquote.twitter-tweet a:hover,
blockquote.twitter-tweet a:focus {
  text-decoration: underline;
}
  </style>
 		<link rel="stylesheet" type="text/css" href="./login_fichiers/styles.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
	<body class="application">
	  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="navbar-brand" href="./">Suivi CIUB</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">
          <li><a href="../Google_charts/index.html">Home</a></li>
          <li><a href="../Google_charts/twitter.html">Twitter</a></li>
          <li><a href="index.php">L'interface</a></li>
        </ul>
      </div>
    </div>
  </div>
	
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
									<input name="_pass" id="rcmloginpwd" size="40" autocapitalize="off" autocomplete="off" type="password" class="enter_password">
								</td>
							</tr>
						</tbody>
					</table>
					<p class="formbuttons"><input class="button mainaction" value="" type="submit"></p>
			</form>	
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>