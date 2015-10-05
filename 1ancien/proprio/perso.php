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
			<h1>Bonjour <?php echo $_SESSION['nom']; ?></h1>
		</div>
	<article id='piscine'>
		<form method='post' action='ajout_appartement.php' enctype='multipart/form-data'>
			<input type='hidden' name='action' value='ajout_app'>
			<table cellspacing=10>
				<tr><th colspan=2>Ajouter un appartement à louer</th></tr>
				<tr>
					<td><label for='residence'>Appartement : </label></td>
					<td>
						<select name="residence">
							<option>Résidence</option>
							<?php 
							//$residenses=$db->query('SELECT DISTINCT residence FROM appartements;')->fetchAll();
							//foreach($residences as $données){echo "<option value='".$residences['residence']."'>".$residences['residence']."</option>";}
							?>
							<option value="Les Jardins de Cabo">Les Jardins de Cabo</option>
							<option value="Lina">Lina</option>
						</select>
						<input size=5 type='text' name='numero' value='n°'>
					</td>
				</tr>
				<tr>
					<td><label for='loyer1S'>Loyers(€) : </label></td>
					<td>
						<input type='text' size=5 name='loyer'>/semaine
						<!--<table>
							<tr>
								<td align=center><label for='loyer1S'>par semaine</label></td>
								<td align=center><label for='loyer2S'>2 sem</label></td>
								<td align=center><label for='loyer1M'>par mois</label></td>
								<td align=center><label for='loyer2M'>2 mois</label></td>
							</tr>
							<tr>
								<td><input type='text' size=5 name='loyerS1'></td>
								<td><input type='text' size=5 name='loyerS2'></td>
								<td><input type='text' size=5 name='loyerM1'></td>
								<td><input type='text' size=5 name='loyerM2'></td>
							</tr>
						</table>-->
				</tr>
				<tr>
					<td colspan=2>
						<label for='description'>Description de l'appartement :</label><br>
						<textarea name='description'></textarea>
					</td>
				</tr>
				<tr>
					<td>Photos :</td>
					<td><input type='file' name='photos'></td>
				</tr>
				<tr>
					<td colspan=2><input type = 'submit' value='Ajouter'></td>
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
