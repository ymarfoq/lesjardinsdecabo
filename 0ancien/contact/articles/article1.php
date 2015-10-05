<h2>Laissez nous un message</h2>
<ul>
<form method='post' action="message_post.php">
	<label for="nom">Nom : </label><span class="avert">Veuillez indiquer votre nom.</span></br>
	<input type="text" name="nom" placeholder="Ex : M.Marfoq"  maxlength="20" class='controle'/>
	<br/>
	<label for="mail">Mail : </label><span class="avert">Veuillez indiquer votre mail.</span></br>
	<input type="email" name="mail" placeholder="exemple@site.fr"  maxlength="40" size='60' class='controle'/>
	<br/>
	<label for="sujet">Sujet : </label><span class="avert">Veuillez indiquer un sujet.</span></br>
	<input type="text" name="sujet" placeholder="Changement de semaine de réservation"  maxlength="40" size='60' class='controle'/>
	<br/>
	<label for="mess">Message : </label><span class="avert">Veuillez indiquer un message.</span></br>
	<br/>
	<textarea name="mess" rows="20" cols="55" class='controle'></textarea>
	<br/>
	<input type = "submit" onclick="return verification()" value='Envoyer'>
</form>
</ul>
