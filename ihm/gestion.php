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