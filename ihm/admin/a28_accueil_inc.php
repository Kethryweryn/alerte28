

			Bienvenue <?php echo($_SESSION['full_name']); ?><br />
			<?php 
			if($_SESSION['leader'] == 1)
			{
			?>
				<a href="gestion.php?page=a28_user">Utilisateurs</a><br />
				<?php 
			}
				?>
				<a href="gestion.php?page=a28_action">Actions</a><br />
<?php 
if($_SESSION['is_admin'] == 1)
{
	echo '				<a href="gestion.php?page=a28_action_admin">Administration des actions</a>';
echo '<br /><a href="gestion.php?page=a28_service">Service</a> <br />
				';
}				
?>