
			Bienvenue <?php echo($sFullName.", vous &ecirc;tes SuperAdmin, enjoy !"); ?><br />
<a href="gestion.php?page=a28_service">Service</a> <br />
				<a href="gestion.php?page=a28_user">Utilisateurs</a><br />
				<a href="gestion.php?page=a28_action">Actions</a><br />
<?php 
if($_SESSION['is_admin'] == 1)
	echo '				<a href="gestion.php?page=a28_action_admin">Administration des actions</a>';
				
?>