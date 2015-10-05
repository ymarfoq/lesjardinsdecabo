<?php session_start(); 
 if(isset($_GET['mdp'])){if($_GET['mdp']=='yoyo'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
textarea{width:100%; height:200px;}
input,laber{margin:10px; text-align:center;}
	</style>
<?php 
	$titre="Propriétaires : ".$_SESSION['nom'];
	include("../header.php");
?>
	<section>
		<div class='titre'>
			<h1>Bonjour <?php echo $_SESSION['nom']; ?><h1>
<?php
$appartements=$db->query('SELECT numero FROM appartements where id_proprio='.$_SESSION["id"].';')->fetchAll();
if(count($appartements)>0){
	echo " <h1></h1><h1></h1><h1></h1><h1>Vos appartements :";
	foreach($appartements as $numero){echo "<a href=?appartement=".$numero['numero'].">".$numero['numero']."</a>";}
	echo "</h1>";
}

?>		
		</div>
	<article id='piscine'>
		<form method='post' action='ajout_appartement.php' enctype='multipart/form-data'>
			<input type='hidden' name='action' value='ajout_app'>
			<table cellspacing=10>
				
				<tr><th colspan=3>Ajouter un appartement à louer</th></tr>
				
				<tr>
					<td width=200><label for='residence'>Appartement : </label></td>
					<td>
						<select name="residence">
							<?php 
							$residences=$db->query('SELECT DISTINCT residence FROM appartements;')->fetchAll();
							foreach($residences as $donnees){echo "<option value='".$donnees['residence']."'>".$donnees['residence']."</option>";}
							?>
						</select>
					</td>
					<td>
						<input type='text' size=8 name='numero' placeholder='n° appartement'>
					</td>
				</tr>
				
				<tr><td height=30><hr></td></tr>
				
				<tr>
					<td colspan=3>
						<label for='description'>Description de l'appartement :</label><br>
						<textarea name='description'></textarea>
					</td>
				</tr>
				<tr><td colspan=3><span>Vous aurez la possibilité d'ajouter des photos une fois l'appartement ajouté.</span></td></tr>
				
				<tr><td height=30><hr></td></tr>
				
				<tr>
					<th><label for='loyers'>Loyers :</label></th>
				<tr>
					<td align=center><label for='loyer1'>Haute saison<br>(Juillet / Aout)</label></td>
					<td align=center><input type='text' size=3 name='loyer1' value="700"></td>
					<td><span>€ / semaines</span></td>
				</tr>
				<tr>
					<td align=center><label for='loyer2'>Moyenne saison<br>(Mai / Juin / Septembre)</label></td>
					<td align=center><input type='text' size=3 name='loyer2' value="500"></td>
					<td><span>€ / semaines</span></td>
				</tr>
				<tr>
					<td align=center><label for='loyer3'>Basse saison<br>(de Octobre à Avril)</label></td>
					<td align=center><input type='text' size=3 name='loyer3' value="300"></td>
					<td><span>€ / semaines</span></td>
				</tr>
				<tr><td height=30><hr></td></tr>
				<tr>
					<td colspan=3><input type = 'submit' value='Ajouter'></td>
				</tr>
			</table>
		</form>
	</article>
	<article id='herbe'>
		
	</article>
	</section>
</body>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</html>	
