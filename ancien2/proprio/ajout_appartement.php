<?php session_start() ?>
<?php

$db = new PDO('sqlite:../bases/base.db');

if($_POST['action']=='ajout_app'){
	$membre_id = $_SESSION['id'];
	$db->exec("CREATE TABLE IF NOT EXISTS appartements (
							id INTEGER PRIMARY KEY, 
							id_proprio TEXT, 
							residence TEXT, 
							numero TEXT, 
							loyer1 TEXT,
							loyer2 TEXT,
							loyer3 TEXT,
							description TEXT,
							album TEXT)");
	
	$exist = $db->query("SELECT count(id) FROM appartements WHERE residence='".$_POST['residence']."' and numero='".$_POST['numero']."';")->fetch();
	if($exist[0]){
		header('location:perso.php?pb=app_exist');
	}
	else{
		$residence=htmlentities(addslashes($_POST['residence']));
		$numero=htmlentities(addslashes($_POST['numero']));
		$loyer1=htmlentities(addslashes($_POST['loyer1']));
		$loyer2=htmlentities(addslashes($_POST['loyer2']));
		$loyer3=htmlentities(addslashes($_POST['loyer3']));
		$description=$_POST['description'];
		$id_proprio=$membre_id;
		$id=time();
		$album='app'.$id;
		
		$db->exec("INSERT INTO appartements (id, id_proprio, residence, numero, loyer1, loyer2, loyer3, description, album) VALUES (".$id.",".$id_proprio.",'".$residence."','".$numero."','".$loyer1."','".$loyer2."','".$loyer3."','".$description."','".$album."');");
		
					
		//ajouter 1'appartement au propriétaire
		$db->exec("UPDATE proprietaires SET appartements=appartements+1 WHERE id='".$membre_id."';");
	
		//créer l'album des appartements
		mkdir("../bases/albums/".$album);
	}
}
elseif($_POST['action']=='ajout photos'){
			
}
else{
	header('location:index.php');
}
?>
