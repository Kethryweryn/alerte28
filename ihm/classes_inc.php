<?php
#Connection class
class DB {
	
	function DB($sDBHost, $sDBUser, $sDBPass, $sDBName) {

        mysql_connect($sDBHost, $sDBUser, $sDBPass) or die('Connection : '.mysql_error());
        mysql_select_db($sDBName);
    }
}

function preselect($existant, $valeur_test, $deroulant){
	if($existant==$valeur_test){
		$deroulant.=' selected';
	}
	return $deroulant;
}

class debug
{
	function debug($input, $die)
	{
		echo $input.'<br />';
		if(1==$die){
			die();
		}
	}
}

class requete{
	var $req;
	var $liste;
	var $flag;
	var $idInsert;
	
	function requete($input, $flag){
		$this->flag=$flag;
		$this->req=mysql_query($input) or die($flag.' : '.mysql_error());
		
		$x=strpos($input, ' ');
		if(substr($input, 0, $x)=='INSERT'){
			$this->idInsert=mysql_insert_id();
		}
		return $this->req;
	}
	
	function redirection($page)
	{
		if(mysql_num_rows($this->req)!=0)
		{
			 return mysql_fetch_array($this->req);
		}
		else
		{
			echo '<script language="Javascript">;<!--',"\n",'location.href = \'',$page,'\';',"\n",'// --></script>',"\n";
		}
	}

	function liste_option($result, $name, $label, $default_value, $attributs, $valeur_test){
		$liste='';
		if(mysql_num_rows($result)==0){
			$liste='Liste vide'."\n";
		}
		elseif(mysql_num_rows($result)==1){
			$o=mysql_fetch_row($result);
			$liste='<input type="hidden" value="'.$o[0].'" name="'.$name.'" id="'.$name.'" />'.$o[1];
		}
		else{
			$liste.='<option>'.$label.'</option>'."\n";
			while($o=mysql_fetch_row($result)){
				$liste.='<option value="'.$o[0].'"';
				if(!empty($valeur_test)){
					$liste.=$this->preselect($o[0], $valeur_test);
				}
				$liste.='>'.$o[1].'</option>'."\n";
			}
			$liste='<select name="'.$name.'" id="'.$name.'" '.$attributs.'>'.$liste;
			$liste.='</select>';
		}
		
		return $liste;
	}
	
	
	
	function liste_option_multiple($result, $name, $label, $attributs, $aTest){
		if(mysql_num_rows($result)==0){
			$sListe='Liste vide'."\n";
		}
		elseif(mysql_num_rows($result)==1){
			$aResult=mysql_fetch_row($result);
			$sListe='<input type="hidden" value="'.$aResult[0].'" name="'.$name.'[]" id="'.$name.'[]" />'.$aResult[1];
		}
		else{
			$i=0;
			while($aResult=mysql_fetch_row($result)){
				$sListe.='<br /><input type="checkbox" name="'.$name.'[]" id="'.$name.'[]'.$i.'" value="'.$aResult[0].'"';

				if(!empty($aTest)){
					if(in_array($aResult[0], $aTest)){
						$sListe.=' checked';
					}
				}
				$sListe.=' /><label class="wide" for="'.$name.'[]'.$i.'">'.$aResult[1].'</label>'."\n";
				$i++;
			}
		}
		
		return $sListe;
	}
	
	
	
	function preselect($existant, $valeur_test){
		$test='';
		if($existant==$valeur_test){			
			$test.=' selected';
		}
		return $test;
	}
	
	
	
	function filler($input){
		$s_outputjs='<script language="JavaScript" type="text/javascript">'."\n".'var childaccounts = new Array();'."\n";
		$length=0;
		while($salle=mysql_fetch_array($input)){
			$s_outputjs.='childaccounts['.$length.'] = new Array("'.$salle[1].'","'.$salle[0].';'.$salle[1].';1");'."\n";
			$length++;
		}
		//echo $length;
		$s_outputjs.='</script>';
		return $s_outputjs;
	}
	
	
	
	function prefill($champ, $valeur){
		
	}
	
	function liste_tableau($result, $table, $attributs){
		$titre=$this->flag;
		$s=$this->requete('SHOW COLUMNS FROM `'.$table.'`', 'autres colonnes');
		$colspan=mysql_num_rows($s);
		$liste='<table '.$attributs.'><tr><td colspan="'.$colspan.'">'.$titre.'</td></tr>';

		$liste.='<tr style="font-weight:bold">';
		// on affiche le nom des colonnes
		while($colonne=mysql_fetch_row($s)){
			if($colonne[0]!='id_'.$table){
				$liste.='<td>'.$colonne[0].'</td>';
			}
		}
		$liste.='</tr>';
		
		//liste vide
		if(0==mysql_num_rows($result)){
			$liste.='<tr><td colspan="'.$colspan.'">Liste vide</td></tr>';
		}
		else{
		//liste pas vide
			$l=0;
			while($o=mysql_fetch_row($result)){
				$liste.='<tr>';
				//première case : id
				$liste.='<td>'.$o[0].'</td>';
				//seconde case : nom + lien
				$liste.='<td><a href="gestion.php?page='.$table.'&id='.$o[0].'">'.$o[1].'</a></td>';
				// éventuelles colonnes au delà de deux.
				if(2>$colspan){
					for($i=1;$i<=$colspan;$i++){
						$liste.='<td>'.$o[$i].'</td>';
					}
				}
				$liste.='</tr>';
				$l++;
			}
		}
		$liste.='</table>';
		return $liste;
	}
}

class doublon extends requete{
	var $nom;
	var $message;
	
	function doublon($a_inserer, $table, $correction){
		if($correction==0){		
			if($table!='programmation'){
				$nom=$a_inserer['nom_'.$table];
				$t=$this->requete('SELECT COUNT(`id_'.$table.'`) FROM `'.$table.'` WHERE `nom_'.$table.'`="'.$nom.'"', 'anti doublon');
				$test=mysql_result($t,0);
			}
			else{
				$nom='Programmation';
				$test=0;
			}
			if($test==0){
				$this->requete('INSERT INTO `'.$table.'` (`id_'.$table.'`, `nom_'.$table.'`) VALUES ("", "'.$nom.'")', 'insertion dans '.$table);
				$id=mysql_insert_id();
				foreach($_POST as $key=>$val){
					if($key!='id_'.$table && $key!='nom_'.$table && $key!='action' && $key!='redirection'){
						$i++;
						$this->requete('UPDATE `'.$table.'` SET `'.$key.'`="'.$val.'" WHERE `id_'.$table.'`="'.$id.'"', 'Update d\'insertion des autres donnees');
					}
				}
				$this->message='"'.$nom.'" a &eacute;t&eacute; correctement inser&eacute; dans la table "'.$table.'"';
			}
			else{	
				$this->message='"'.$nom.'" existe déj&agrave; dans la table "'.$table.'"';
			}
		}
		else{
			$id=$a_inserer['id_'.$table];
			foreach($_POST as $key=>$val){
				if($key!='id_'.$table && $key!='action' && $key!='redirection'){
					$this->requete('UPDATE `'.$table.'` SET `'.$key.'`="'.$val.'" WHERE `id_'.$table.'`="'.$id.'"', 'Update de correction des autres donnees');
				}
			}
			$this->message='"'.$nom.'" corrig&eacute; dans la table "'.$table.'"';
		}
	}	
}

function a28crypt($str){
	return crypt($str, "$1$CV6Z5FY8$53.nr/x4UwCCKwDEgBwTD/");
}

function displayError($e, $p){
	
	//$e attend $_GET['e'], $p attend $_GET['page']
	
	$aMsgLogError=array('0',
'Vos identifiants sont vides.',
'Vos identifiants sont erron&eacute;s ou ne vous habilitent pas &agrave; l\'administration du site.',
'Votre compte est inactif',
'Votre session est expir&eacute;e.',
'Formulaire vide',
'Cette adresse n\'est pas valide.');
		
		if(isset($e)){
			echo('<p><span style="color:red; font-size:large; font-weight:bold;">'.$aMsgLogError[$e].'</span></p><input type="hidden" name="page" id="page" value="'.$p.'" />');
					}


}
?>