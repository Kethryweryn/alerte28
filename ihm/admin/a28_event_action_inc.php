<?php
// gestion des actions des joueurs sur un évènement
//interdiction d'ouverture directe du fichier !
if('a28_event_action_inc.php'==$_SERVER['PHP_SELF']){
	header('location:index.php?e=6');
}


// Ici, on commence par présenter le détail de l'évènement, puis on présente la liste des actions 
// possibles pour agir sur l'évènement... 

$db = new dbAccess();
$rq = "select name, description from a28_event where id = ".$_GET['eid'];
$result = $db->select($rq);
if(count($result))
{
	echo "<div><h1>".$result[0]->name."</h1><p>".$result[0]->description."</p>";
	
}


// Ensuite,on récupère la liste des actions possibles et on les affiche dans une combo
$service_id = $_SESSION['service_id'];
$rq = "select a.id, a.name, a.html_content, a.description, a.password from a28_action a 
		join a28_action_event b on b.action_id = a.id
		where b.event_id = ".$_GET['eid']." and a.service_id = $service_id
		
		";
$result = $db->select($rq);

?>
<p>
Vous trouverez ci-dessous la liste des actions que vous pouvez accomplir en tant que membre de votre service. 
</p>
<h1>
Nous vous rappelons que votre service ne peut faire qu'une seule action par demie-heure. 
</h1>

<script type="text/javascript">

   function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    //alert(selectedValue);
    $("#myfieldid").remove();
    $.post("getdata.php?option=spec_act&id="+selectedValue, function(response) {
    	$("<div>"+response+"</div>")
        .attr("id", "myfieldid")
        .prependTo("#my_form");
    });
    

       }

  </script>

<form method="POST" action="gestion.php?page=a28_action" id='my_form'> 

<?php 
echo "<select name=action id=selectBox onchange=\"changeFunc();\">";
foreach($result as $action)
{
	$js = '';
	if(strlen($action->html_content))
	{
		// on ajoute le on click et la variable permettant de générer le nouvel élément qui va bien...
		$js = "onselect=\"alert('coucou')\"";
	}
	echo "<option value=".$action->id."  >".$action->name."</option>";
}
echo "</select>";
?>

<?php 
// s'il s'agit d'actions spéciales alors on affiche des données spécifiques




?>




<input type="hidden" name="send_order" value=<?php echo $_GET['eid']; ?> />
<input class="button mainaction" type=submit value="Accomplir" />
</form>