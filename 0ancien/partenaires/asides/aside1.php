<h2>Devenir Partenaire</h2>

<form method="post" action="post_partenaire.php" enctype="multipart/form-data">
	<br/>
	<label for="partenaire">Nom de votre entreprise : </label>
	<br/><span class="avert">Veuillez indiquer le nom de votre entreprise.</span>
	<input type="text" name="nom" placeholder="Ex : Crédit Agricole"  maxlength="40" />
	<br/>
	<br/>
	<label for="logo">Votre logo(max=1Mo) : </label>
	<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	<input type="file" name="logo" />
	<br/>
	<br/>
	<label for="site">Votre site internet : </label>
	<br/><span class="avert">Veuillez indiquer l'adresse de votre site internet.</span>
	<input type="text" name="site" placeholder="Ex : lesjardinsdecabo.free.fr"  maxlength="50" />
	<br/>
	<br/>
	<label for="contact">Mail du contact : </label>
	<br/><span class="avert">Veuillez indiquer votre mail.</span>
	<input type="email" name="contact" placeholder="Ex : nom@serveur.fr"  maxlength="50" />
	<br/>
	<br/>
	<input type="submit" onclick="return verification();" value="Envoyer la demande">
</form>
