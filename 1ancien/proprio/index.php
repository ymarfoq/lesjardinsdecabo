<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_GET['mdp'])){if($_GET['mdp']=='yoyo'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
#piscine p{margin-top:20px;}
#herbe table{margin:10px;}
.close{font-size:12px; color:red;}
</style>
<?php 
	$titre="Propriétaires";
	include("../header.php");
	$pb=False;
	if(isset($_GET['pb'])){$pb=$_GET['pb'];};
	 ?>
	
	<section>
		<div class='titre'>
			<h1>Propriétaire</h1>
		</div>
	<article id='piscine'>

	<h3>Louer votre appartement.</h3>
	<br><br>
	<p>Bonjour<br></p>
	<p>Vous êtes propriétaire d'un appartement à Cabo Negro et vous souhaitez rentabiliser un maximum cet investissement?</p>
	<p><strong>Rien de plus facile.</strong></p>
		<p>Nous vous proposons de rendre visible votre appartement sur notre site qui prendra tout en charge avant la location :</p><br>
		<p>Trouver des locataires serieux et fiables, les contacter, leur louer et s'assurer que tout se déroule parfaitement jusqu'à leur départ.</p>
		<p>Tous ce que vous avez à faire est de remplir le formulaire de la manière la plus complète afin que votre appartement soit choisis par les intéressée.</p>

	</article>
	<article id='herbe'>
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
			<span class='close'>*Les informations personnelles ne seront jamais dévoilées publiquement sur le site ou transmises à une autre personne.</span>
		</form>

	</article>
	</section>
</body>
<footer>
</footer>
</html>	
