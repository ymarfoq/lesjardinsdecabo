<?php session_start() ?>
<?php

$db = new PDO('sqlite:../bases/base.db');

if($_POST['action']=='ajout_app'){
	$membre_id = $_SESSION['id'];
	$db->exec("CREATE TABLE IF NOT EXISTS appartements (
							id TEXT PRIMARY KEY, 
							id_proprio TEXT, 
							residence TEXT, 
							numero TEXT, 
							loyer1 TEXT,
							loyer2 TEXT,
							loyer3 TEXT,
							description TEXT);");

	$exist = $db->query("SELECT count(id) FROM appartements WHERE residence='".$_POST['residence']."' and numero='".$_POST['numero']."';")->fetch();
	if($exist[0]){
		header('location:perso.php');
	}
	else{
		$residence=htmlentities(addslashes($_POST['residence']));
		$numero=htmlentities(addslashes($_POST['numero']));
		$loyer1=htmlentities(addslashes($_POST['loyer1']));
		$loyer2=htmlentities(addslashes($_POST['loyer2']));
		$loyer3=htmlentities(addslashes($_POST['loyer3']));
		$description=addslashes($_POST['description']);
		$id_proprio=$membre_id;
		$id='ap'.round(microtime(true)*1000);
		
		$db->exec('INSERT INTO appartements (id, id_proprio, residence, numero, loyer1, loyer2, loyer3, description) VALUES ("'.$id.'","'.$id_proprio.'","'.$residence.'","'.$numero.'","'.$loyer1.'","'.$loyer2.'","'.$loyer3.'","'.$description.'");');
		
		//ajouter 1'appartement au propriétaire
		$db->exec("UPDATE proprietaires SET appartements=appartements+1 WHERE id='".$membre_id."';");
		
		//créer l'album des appartements
		mkdir("../bases/albums/".$id);
		header('location:perso.php?appartement='.$id);
	}
}
elseif($_POST['action']=='modif_app'){
	$residence=htmlentities(addslashes($_POST['residence']));
	$numero=htmlentities(addslashes($_POST['numero']));
	$loyer1=htmlentities(addslashes($_POST['loyer1']));
	$loyer2=htmlentities(addslashes($_POST['loyer2']));
	$loyer3=htmlentities(addslashes($_POST['loyer3']));
	$description=addslashes($_POST['description']);
	$id_proprio=$_SESSION['id'];
	$id=$_POST['id'];
	$db->exec('UPDATE appartements SET residence="'.$residence.'", numero="'.$numero.'", loyer1="'.$loyer1.'", loyer2="'.$loyer2.'", loyer3="'.$loyer3.'", description="'.$description.'" where id="'.$id.'";');
	
	header('location:perso.php?appartement='.$id);
}
elseif($_POST['action']=='ajout_photo'){
	$album=$_POST['album'];
	for($i=0; $i < count($_FILES['photos']['name']); $i++){
		$id='ph'.round(microtime(true)*1000);
		$last=$db->query('SELECT * FROM photos WHERE album="'.$album.'" ORDER BY id DESC LIMIT 1;')->fetch();
		$first=$db->query('SELECT * FROM photos WHERE album="'.$album.'" ORDER BY id ASC LIMIT 1;')->fetch();
		if($last['id']==""){echo "ok";  $last['id']=$id;}
		if($first['id']==""){echo "ok";  $first['id']=$id;}
		$photo="bases/albums/".$album."/".$_FILES['photos']['name'][$i];
		echo $last['id']."//".$first['id']."//".$id."///";
		if ($_FILES['photos']['error'][$i] > 0) $erreur = "transfert_photo";
	  
		//enregistrement de l'image à l'adresse de $photo
		move_uploaded_file($_FILES['photos']['tmp_name'][$i],'../'.$photo);
	
		//Modification de la base de données en fonction de l'ajout de la nouvelle photo à la fin de la liste
		$db->exec('INSERT INTO photos (id, pre_id, post_id, album, photo) VALUES ("'.$id.'","'.$last['id'].'","'.$first['id'].'","'.$album.'","'.$photo.'");');
		$db->exec('UPDATE photos SET post_id="'.$id.'" WHERE id="'.$last['id'].'";');
		$db->exec('UPDATE photos SET pre_id="'.$id.'" WHERE id="'.$first['id'].'";');
	}
	header('location:perso.php?appartement='.$album);
}
elseif($_POST['action']=='supp_photo'){
	$photo=$db->query('SELECT * FROM photos WHERE id="'.$_POST['id'].'";')->fetch();
	$db->exec('DELETE FROM photos WHERE id="'.$photo['id'].'";');
	$db->exec('UPDATE photos SET post_id="'.$photo['post_id'].'" WHERE id="'.$photo['pre_id'].'";');
	$db->exec('UPDATE photos SET pre_id="'.$photo['pre_id'].'" WHERE id="'.$photo['post_id'].'";');
}
elseif($_POST['action']=='supp_app'){
	$db->exec('DELETE FROM appartements WHERE id="'.$_POST['id'].'";');
}
?>
