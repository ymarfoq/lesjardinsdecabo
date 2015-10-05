<?php session_start();
// connection à la base
$db = new PDO('sqlite:../bases/base.db');

if ($_SESSION['admin']){
	if($_POST['action']=='ajouter'){
			
		//création de la table des conférenciers
		$db->exec("CREATE TABLE IF NOT EXISTS photos (
							id INTEGER PRIMARY KEY,
							pre_id TEXT, 
							post_id TEXT, 
							album TEXT, 
							photo TEXT);");
							
		$id=time();
		$album=$_POST['album'];
		$last=$db->query('SELECT * FROM photos WHERE album="'.$album.'" ORDER BY id DESC LIMIT 1;')->fetch();
		$first=$db->query('SELECT * FROM photos WHERE album="'.$album.'" LIMIT 1;')->fetch();

		$photo="bases/albums/".$album."/".$_FILES['photo']['name'];
		$maxsize=htmlentities(addslashes($_POST['MAX_FILE_SIZE']));
		if ($_FILES['photo']['error'] > 0) $erreur = "Erreur lors du transfert de la photo.";
		if ($_FILES['photo']['size'] > $maxsize) $erreur = "La photo est trop grosse.";
		  
		$image_sizes = getimagesize($_FILES['photo']['tmp_name']);
		//enregistrement de l'image à l'adresse de $photo
		move_uploaded_file($_FILES['photo']['tmp_name'],'../'.$photo);
		//insertion du conférencier dans la base

		$pre=$db->prepare('UPDATE photos SET post_id=? WHERE id=?;');
		$pre->execute(array($id, $last['id']));
		$post=$db->prepare('UPDATE photos SET pre_id=? WHERE id=?;');
		$post->execute(array($id, $first['id']));
		$qry = $db->prepare('INSERT INTO photos (id, pre_id, post_id, album, photo) VALUES (?, ?, ?, ?, ?);');
		$qry->execute(array($id, $last['id'], $first['id'], $album, $photo));
	}
	elseif($_POST['action']=='supprimer'){

		$album=$_POST['album'];
		$photo=$db->query('SELECT * FROM photos WHERE id='.$_POST['id'].';')->fetch();
			
		$qry = $db->query('DELETE FROM photos WHERE id='.$photo['id'].';');
		$pre=$db->query('UPDATE photos SET post_id='.$photo['post_id'].' WHERE id='.$photo['pre_id'].';');
		$post=$db->query('UPDATE photos SET pre_id='.$photo['pre_id'].' WHERE id='.$photo['post_id'].';');
	}
// fermeture de la base
$db = null;
}
header('Location:.?album='.$album);
?>
