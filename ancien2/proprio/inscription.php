<!--Ici se trouve les formulaires à insérer dans la page index, puis le traitement des info-->
<!--
<form method='post' action='inscription.php' enctype='multipart/form-data'>
			<h3>Connexion</h3>
			<fieldset>
				<legend>Accédez à votre compte</legend>
				<?php if($pb=='co'){echo "<legend class='close'> Mauvais mot de passe ou utilisateur inexistant.</legend>";} ?>
				<table cellspacing=10>
					<tr>
						<td><label>Utilisateur : </label><input name='nom' type='text' required></td>
						<td><label>Mot de passe : </label><input name='mdp' type='password' required></td>
						<td><input name='action' type='hidden' value='connexion'><input type='submit' value="connexion" required></td>
					</tr>
				</table>
			</fieldset>
		</form>
		<form method='post' action='inscription.php' enctype='multipart/form-data'>
			<h3>Formulaire d'inscription</h3>
			<fieldset>
				<legend>Informations personnelles*</legend>
				<table cellspacing=10>
					<tr>
						<td><label>Nom d'utilisateur: </label></td>
						<td><input name='nom' type='text' required><?php if($pb=='exist'){echo "<strong class='close'> Nom déjà existant.</strong>";} ?></td>
					</tr>
					<tr>
						<td><label>Adresse mail : </label></td>
						<td><input name='mail' type='mail' required></td>
					</tr>
					<tr><td><hr></td><td></td></tr>
					<tr>
						<td><label>Mot de passe : </label></td>
						<td><input name='mdp' type='password' value='ok'></td>
					</tr>
					<tr>
						<td><label>Confirmation : </label></td>
						<td><input name='mdpverif' type='password' value='ok'><?php if($pb=='mdp'){echo "<strong class='close'> Confirmation erronée.</strong>";} ?></td>
					</tr>
					<tr>
						<td><input name='action' type='hidden' value='inscription'><input type='submit' value="Inscription" required></td>
						<td></td>
					</tr>
				</table>
			</fieldset>
			<span class='close'>*Les informations personnelles ne seront jamais dévoilées publiquement sur le site ou à des personnes tiers.</span>
		</form>
-->


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
