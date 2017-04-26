<?php
// gestion de l'ajout d'utilisateur
//interdiction d'ouverture directe du fichier !
if('a28_user_add_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}

// si on est en mode modification, alors on charge les valeurs par défaut. 
$prenom = "";
$nom = "";
$login = "";
$pass = "";
$actif = 1;
$manager = 0;
$service_id = 0;
if(isset($_GET['uid']))
{
	$db = new dbAccess();
	$rq ="select * from a28_user where id = ".$_GET['uid'];
	$result = $db->select($rq);
	
	$prenom = $result[0]->prenom;
	$nom = $result[0]->nom;
	$login = $result[0]->log;
	$actif = $result[0]->actif;
	$manager = $result[0]->leader;
	$service_id = $result[0]->service_id;
}
?>
<div>
<form action="gestion.php?page=a28_user" method="post">

	<div>
		<label for="nom">Nom : </label>
		<input type="text" name="nom" value='<?php echo ($nom);?>'>
	</div>
	<div>
	<label for="prenom">Prénom : </label>
	<input type="text" name="prenom" value='<?php echo ($prenom);?>'>
	</div>
	
	<div>
		<label for="login">Identifiant : </label>
		<input type="text" name="login"  value='<?php echo $login;?>'>
	</div>
	<div>
		<label for="password">Mot de passe : </label>
		<input type="password" name="password">
	</div>
	<div>
		<label for="active">Actif : </label>
		<input type="radio" name="active" value=1 <?php if($actif == 1) {echo "checked=1";}?>>Actif
		<input type="radio" name="active" value=0 <?php if($actif == 0) {echo "checked=1";}?>>Inactif
	</div>
	<div>
		<label for="leader">Manager : </label>
		<input type="radio" name="manager" value="1" <?php if($manager == 1) {echo "checked=1";}?>>Manager
		<input type="radio" name="manager" value="0" <?php if($manager == 0) {echo "checked=1";}?>>Employé	
		</div>
	
	<div>
	<label for="service">Service : </label>
	<select name="service">
<?php 
$db = new dbAccess();
$rq = "select id, nom from a28_service";
$result = $db->select($rq);
foreach($result as $service)
{
	$sel = "";
	if($service->id == $service_id)
		$sel = 'selected="selected"';
	echo "<option value=$service->id ".$sel.">$service->nom</option>";
}
?>	
	</select>
	</div>
	<input type="hidden" name="<?php if(isset($_GET['uid'])) {echo "update_user";} else {echo "create_user";} ?>" value=<?php if(isset($_GET['uid'])){echo $_GET['uid'];} else {echo"1";} ?>>
	<input value="<?php if(isset($_GET['uid'])){echo "Modifier";} else { echo "Ajouter";} ?>" type="submit">

</form>
</div>