<?php
session_start();
require_once('../config_inc.php');

//require_once('../classes_inc.php');

require_once('../../dbAccess.php');
//ouverture de connexion
//$db=new DB($sDBHost, $sDBUser, $sDBPass, $sDBName);
if(empty($_SESSION))
	header('location:../index.php?e=6');
	//vérification de session
	if(1==$_SESSION['is_admin']){ 
	$sFullName=$_SESSION['full_name'];
}
else{
	//header('location:index.php?e=2');
}

if(isset($_GET['page']))
{
	if($_SESSION['is_admin'] == 1)
		$clearance = 2;
	elseif ($_SESSION['leader'] == 1)
		$clearance = 1;
	else 
		$clearance = 0;
	switch ($clearance)
	{
		case 0:
			switch($_GET['page'])
			{
				case 'a28_accueil':
				case 'a28_action':
				case 'a28_event_action':
					break;
				default:
					header('location:gestion.php?page=a28_accueil');
					
					
			}
			case 1:
				switch($_GET['page'])
				{
					case 'a28_accueil':
					case 'a28_action':
					case 'a28_event_action':
					case 'a28_user':
					case 'a28_user_add':
						break;
					default:
						header('location:gestion.php?page=a28_accueil');
						break;
			
				}
			default:
				break;
					
	}
}


echo('<?xml version="1.0"?>');
?>

<!DOCTYPE html>
<html>
<head>
  <title>CIUB - Interface</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link rel="stylesheet" type="text/css" href="../../template/assets/lib/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="../../template/assets/css/keen-dashboards.css" />
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
		<link rel="stylesheet" type="text/css" href="../login_fichiers/styles.css">
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
          <li><a href="../../Google_charts/index.html">Home</a></li>
          <li><a href="../../Google_charts/twitter.html">Twitter</a></li>
          <li><a href="gestion.php">L'interface</a></li>
        </ul>
      </div>
    </div>
  </div>		
  		<div id="content-form">
			<div class="box-inner">
				<div>
					<a href="gestion.php">
						<img src="../img/logo_ciub.jpg" id="logo" alt="Logo CIUB" border="0" width="128" />
					</a>
				</div>
			
				<div id="logout" class="logoutAdmin">
					<a href="logout.php">
						<img src="../img/remote_logoff.png" title="logout" width="32px"/>D&eacute;connexion
					</a>
				</div>
				<?php
					if(isset($_GET['e']))
					{
						displayError($_GET['e'], $_GET['page']);
					}
					$page='a28_accueil_inc.php';
					if(!empty($_GET['page']) && file_exists($_GET['page']).'_inc.php'){
						$page=$_GET['page'].'_inc.php';
					}
					
					require_once($page);
				?>
			</div>
		</div>
		<div class="box-bottom">
		</div>
	</body>
</html>