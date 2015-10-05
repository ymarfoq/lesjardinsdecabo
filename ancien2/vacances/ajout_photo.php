<?php session_start();
// connection à la base
$db = new PDO('sqlite:../bases/base.db');

if ($_SESSION['admin']){
	if($_POST['action']=='ajouter'){
		
		$db->exec("CREATE TABLE IF NOT EXISTS photos (
							id INTEGER PRIMARY KEY,
							pre_id TEXT, 
							post_id TEXT, 
							album TEXT, 
							photo TEXT);");
							
		$album=$_POST['album'];
		for($i=0; $i < count($_FILES['photos']['name']); $i++){
			$id=time();
			sleep(1);
			$last=$db->query('SELECT * FROM photos WHERE album="'.$album.'" ORDER BY id DESC LIMIT 1;')->fetch();
			$first=$db->query('SELECT * FROM photos WHERE album="'.$album.'" ORDER BY id ASC LIMIT 1;')->fetch();
			$photo="bases/albums/".$album."/".$_FILES['photos']['name'][$i];
			if ($_FILES['photos']['error'][$i] > 0) $erreur = "Erreur lors du transfert de la photo.";
		  
			//enregistrement de l'image à l'adresse de $photo
			move_uploaded_file($_FILES['photos']['tmp_name'][$i],'../'.$photo);
		
			//Modification de la base de données en fonction de l'ajout de la nouvelle photo à la fin de la liste
			$db->exec('INSERT INTO photos (id, pre_id, post_id, album, photo) VALUES ('.$id.','.$last['id'].','.$first['id'].',"'.$album.'","'.$photo.'");');
			$db->exec('UPDATE photos SET post_id='.$id.' WHERE id='.$last['id'].';');
			$db->exec('UPDATE photos SET pre_id='.$id.' WHERE id='.$first['id'].';');
		}
	}
	elseif($_POST['action']=='supprimer'){

		$album=$_POST['album'];
		$photo=$db->query('SELECT * FROM photos WHERE id='.$_POST['id'].';')->fetch();
		$db->exec('DELETE FROM photos WHERE id='.$photo['id'].';');
		$db->exec('UPDATE photos SET post_id='.$photo['post_id'].' WHERE id='.$photo['pre_id'].';');
		$db->exec('UPDATE photos SET pre_id='.$photo['pre_id'].' WHERE id='.$photo['post_id'].';');
	}
// fermeture de la base
$db = null;
}
header('Location:.?album='.$album);
?>
