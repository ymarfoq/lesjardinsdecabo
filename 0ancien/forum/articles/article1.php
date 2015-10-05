<h2>Quelques commentaires</h2>

<ul>
	<?php
try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$com = $bdd->query('SELECT * FROM commentaires;');

	foreach($com as $donnee){
		echo "<h3>De ".html_entity_decode(stripslashes($donnee ['nom'])).", le ".$donnee ['date']."</h3>
					<p>".nl2br(html_entity_decode(stripslashes($donnee ['com'])))."</p>
					<p>-------------------------------------------------------------------------------------</p>";
	}

	?>
</ul>
		
<fieldset class='temoignage'>			
	<legend>Postes ton propre commentaire</legend>
	<form method='post' action="com_post.php">
		<label for="nom">Nom : </label><span class="avert">Veuillez indiquer votre nom.</span>
		<br>
		<input type="text" name="nom" class="controle" placeholder="Ex:M.Marfoq"  maxlength="20" />
		<br/>
		<label for="com">Commentaire : </label><span class="avert">Veuillez indiquer un commentaire.</span>
		<br/>
		<textarea name="com" class="controle" rows="8" cols="50"></textarea>
		<br/>
		<input type = "submit" onclick="return verification();" value="Commenter">
	</form>
</fieldset>
