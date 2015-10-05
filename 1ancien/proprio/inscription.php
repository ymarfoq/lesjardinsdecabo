<?php session_start() ?>
<?php


$db = new PDO('sqlite:../bases/base.db');

if($_POST['action']=='connexion'){
	$membre = $db->query("SELECT id,nom,mdp FROM proprietaires WHERE nom=='".$_POST['nom']."';")->fetch();
	if($_POST['mdp']==$membre['mdp']){
		$_SESSION['nom']=$membre['nom'];
		$_SESSION['id']=$membre['id'];
		header('location:perso.php');
		
	}
	else{
		header('location:index.php?pb=co');
	}
}
else if($_POST['action']=='inscription'){
	if($_POST['mdp']==$_POST['mdpverif']){
		$db->exec("CREATE TABLE IF NOT EXISTS proprietaires (
							id INTEGER PRIMARY KEY, 
							nom TEXT, 
							mdp TEXT, 
							mail TEXT,
							appartements INTEGER)");
							
		$exist = $db->query("SELECT count(id) FROM proprietaires WHERE nom='".$_POST['nom']."';")->fetch();
				
		if(!($exist[0])){			
			$qry = $db->prepare("INSERT INTO proprietaires (id, nom, mdp, mail, appartements) VALUES (?, ?, ?, ?,?)");
			
			$nom=htmlentities(addslashes($_POST['nom']));
			$mdp=htmlentities(addslashes($_POST['mdp']));
			$mail=htmlentities(addslashes($_POST['mail']));
			$id=time();
			
			$qry->execute(array($id, $nom, $mdp, $mail,0));
			
			$_SESSION['nom']=$nom;
			$_SESSION['id']=$id;
			header('location:perso.php');
			
		}
		else{
			header('location:index.php?pb=exist');
		}
	}
	else{
		header('location:index.php?pb=mdp');
	}
}
else{
	header('location:index.php');
}
?>
