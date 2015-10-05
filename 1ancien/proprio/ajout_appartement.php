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
							loyer TEXT,
							description TEXT,
							album TEXT)");
	
	$exist = $db->query("SELECT count(id) FROM appartements WHERE residence='".$_POST['residence']."' and numero='".$_POST['numero']."';")->fetch();
	if($exist[0]){
		header('location:perso.php?pb=app_exist');
	}
	else{
			
		$residence=htmlentities(addslashes($_POST['residence']));
		$numero=htmlentities(addslashes($_POST['numero']));
		$loyer=htmlentities(addslashes($_POST['loyer']));
		$description=$_POST['description'];
		$id_proprio=$membre_id;
		$id=time();
		$album='app'.$id;
		
		$qry = $db->prepare("INSERT INTO appartements (id, id_proprio, residence, numero, loyer, description, album) VALUES (?, ?, ?, ?, ?, ?, ?);");
		
		$qry->execute(array($id, $id_proprio, $residence, $numero, $loyer, $description, $album));
					
		//ajouter 1 appartement au propriétaire
		$db->query("UPDATE proprietaires SET appartements=appartements+1 WHERE id='".$membre_id."';");
	
		//ajouter les photos à l'album des appartements
		foreach($_POST['photos'] as $photo){
			
		}
	}
}
elseif($_POST['action']=='ajout photos'){
			
}
else{
	header('location:index.php');
}
?>
