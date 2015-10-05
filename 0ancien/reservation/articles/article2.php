<div class="center" id="resa_complet">
	<h2>Veuillez choisir une semaine disponnible dans le calendrier.</h2>
</div>

<div class="center" id="reservation">
	<h2>Réservation</h2>
	<form method="post" action="reservation_post.php">
		<table width='100%'>
<br/>
			<tr>
			<td><label for="nom">Nom : </label><input type="text" name="nom" id="nom" class="controle" maxlength="25" /><span class="avert">Veuillez indiquer votre nom.</span></td>
				<td><label for="prenom">Prénom : </label><input type="text" name="prenom" class="controle" maxlength="25" /><span class="avert">veuillez indiquer votre prénom.</span></td>
			</tr>
			<tr><td><br/></td></tr>
			<tr>	
				<td><label for="mail">Mail : </label><input type="email" name="mail" class="controle" maxlength="40" size="30" /><span class="avert">Veuillez indiquer votre mail.</span></td>
				<td><label for="adresse">Adresse : </label><br/><textarea cols='30' rows='2' name="adresse" class="controle"></textarea><span class="avert">Veuillez indiquer votre adresse postale.</span>
			</tr>
			<tr><td><br/></td></tr>
			<tr><td>Début du séjour : </td><td>Fin du séjour : </td></tr>
			<tr id='dates'><td>choisissez une semaine</td><td>choisissez une semaine</td></tr>
			<input id='datein' name='datein' type='hidden' value=''>
			<input id='dateout' name='dateout' type='hidden' value=''>
			<tr>
				<td>à partir de 14h</td>
				<td>Jusqu'à 12h</td>
			</tr>
			<tr><td><br/></td></tr>
			<tr>
				<td><label for="nadultes">Nb d'adultes : </label><input type="number" name="nadultes" class="controle" value="2"/><span class="avert">Il doit y avoir au moins un adulte.</span></td>
				<td><label for="nenfants">Nb d'enfants : </label><input type="number" name="nenfants" class="controle" value="2"/><span></span></td>
			</tr>
			<!--
			<tr><td><br/></td></tr>
			<tr>
				<td>ménage : <input type="checkbox" name="services" value="menage"></td>
				<td>cuisine : <input type="checkbox" name="service" value="cuisine"></td>
			</tr>
			-->
			<tr><td><br/></td></tr>
			<tr>
				<td>Le prix du séjour est de <span id='prixaffiche'>0</span>€<input type='hidden' id='prixenvoie' name='prix' value='800'/></td>
				<td><input type = "submit" onclick="return verification()" value="Réserver"></td>
			</tr>
		</table>
		</br>
		
	</form>
</div>

<script src="script_resa.js"></script>
