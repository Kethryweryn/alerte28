<?php
session_start();
require_once('../config_inc.php');

//require_once('../classes_inc.php');

require_once('../../dbAccess.php');
//ouverture de connexion
//$db=new DB($sDBHost, $sDBUser, $sDBPass, $sDBName);

//vérification de session
if(1==$_SESSION['is_admin']){
	$sFullName=$_SESSION['full_name'];
}
else{
	header('location:index.php?e=2');
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
		<link rel="stylesheet" type="text/css" href="../login_fichiers/styles.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
	</head>

	<body>
		<div id="login-form">
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