<form method='post' action='ajout_appartement.php' enctype='multipart/form-data'>
			<input type='hidden' name='action' value=<?php if($ajout){echo "ajout_app";}else{echo "modif_app";}?>>
			<?php if(!$ajout){echo "<input name='id' value=".$appartement['id']." type='hidden'>";};?>
			<table cellspacing=10>
				
				<tr><th colspan=3>
					<?php
						if($ajout){
							echo "Ajouter un appartement à louer";
						}else{
							echo "Modification de l'appartement ".$appartement['numero']." dans la résidence \"".$appartement['residence']."\".";
						}
					?>
				</th></tr>
				
				<tr>
					<td>
						<label for='residence'>Résidence : </label>
						<input placeholder="Les Jardins de Cabo" list="residences" name="residence" <?php if(!$ajout){echo "value='".$appartement['residence']."'";}?>>
						<datalist id="residences">
							<?php 
							$residences=$db->query('SELECT DISTINCT residence FROM appartements;')->fetchAll();
							foreach($residences as $donnees){echo "<option value='".$donnees['residence']."'>";}
							?>
						</datalist>
					</td>
					<td>
						<label for='appartement'> Appartement : </label>
						<input type='text' size=10 name='numero' placeholder='n°' <?php if(!$ajout){echo "value='".$appartement['numero']."'";}?> required>
					</td>
				</tr>
				
				<tr><td height=30><hr></td></tr>
				
				<tr>
					<td colspan=2>
						<label for='description'>Description de l'appartement :</label><br>
						<textarea name='description' required><?php if(!$ajout){echo stripslashes($appartement['description']);}?></textarea>
					</td>
				</tr>
				<tr><td colspan=2><span>Vous aurez la possibilité d'ajouter des photos une fois l'appartement ajouté.</span></td></tr>
				
				<tr><td height=30><hr></td></tr>
				
				<tr>
					<th><label for='loyers'>Loyers :</label></th>
				<tr>
					<td align=center>
						<label for='loyer1'>Haute saison (Juillet + Aout)</label>
					</td>
					<td align=center>
						<input type='text' size=3 name='loyer1' placeholder='700' value='<?php if($ajout){echo "700";}else{echo $appartement['loyer1'];}?>' required>
						<span>€ / semaines</span>
					</td>
				</tr>
				<tr>
					<td align=center>
						<label for='loyer2'>Moyenne saison (Juin + Septembre)</label>
					</td>
					<td align=center>
						<input type='text' size=3 name='loyer2' placeholder='500' value='<?php if($ajout){echo "500";}else{echo $appartement['loyer2'];}?>' required>
						<span>€ / semaines</span>
					</td>
				</tr>
				<tr>
					<td align=center>
						<label for='loyer3'>Basse saison (Octobre -> Mai)</label>
					</td>
					<td align=center>
						<input type='text' size=3 name='loyer3' placeholder='300' value='<?php if($ajout){echo "300";}else{echo $appartement['loyer3'];}?>' required>
						<span>€ / semaines</span>
					</td>
				</tr>
				<tr><td height=30><hr></td></tr>
				<tr>
					<td><input type = 'submit' value='Ajouter'></td>
				</tr>
			</table>
		</form>
