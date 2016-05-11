<?php
session_start();
require_once('../config_inc.php');

require_once('../classes_inc.php');

//ouverture de connexion
$db=new DB($sDBHost, $sDBUser, $sDBPass, $sDBName);

//vérification de session
if(isset($_SESSION) && 1==$_SESSION['is_admin']){

	if(!empty($_POST['_nomService'])){
		if(!empty($_POST['_idService'])){
			// si id pas vide, on modifie le service existant
			$oServiceEdit=new requete('UPDATE `a28_service` SET `nom`="'.$_POST['_nomService'].'" WHERE `id`="'.$_POST['_idService'].'"','Modification de Service');
		}
		else{
			// si id vide, on ajoute le service
			$oServiceAdd=new requete('INSERT `a28_service` SET `nom`="'.$_POST['_nomService'].'", `id`=""','Ajout de Service');
		}
		header('location:gestion.php?page=a28_service');
	}
	else{
		//formulaire vide
		header('location:gestion.php?page=a28_service&e=5');
	}
}
else{
	// pas le droit d'être là
	header('location:../index.php?e=4');
}

?>