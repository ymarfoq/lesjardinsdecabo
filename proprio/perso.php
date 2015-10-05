<?php session_start(); 
 if(isset($_GET['mdp'])){if($_GET['mdp']=='4317SaintUrbain'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
textarea{width:100%; height:200px; background-color:rgba(255,255,255,0.3); border:0; padding:5px; font-family: Calibri;}
input,laber{margin:10px; text-align:center;}
#piscine p,#piscine h3{margin:10px; display:inline-block;}
.photo{margin:10px; border-radius:5px; height:100px;}
#cache{position:absolute; top:0; right:0; left:0; bottom:-100px; background-color:black; z-index:200; opacity:0.9; display:none;}
.centrale{position:absolute; top:20px; right:10%; left:10%; bottom:10%; z-index:300; opacity:1; display:none; text-align:center;}
.centrale h2{text-transform: uppercase; font: normal 16px "arial", sans-serif; margin:5px;}
.exit{float:right; margin:5px;}
	</style>
	<script type='text/javascript'>

function revelation(id){
	var elem=document.getElementById(id);
	var allelem=document.getElementsByClassName('centrale');
	var cache=document.getElementById('cache');
	var table=document.getElementById('tableau');
	for (var i = 0; i < allelem.length; ++i) {
			var autre = allelem[i];  
			autre.style.display='none';
		}
	elem.style.display='inline-block';
	cache.style.display='inline-block';
	table.parentNode.style.overflow='hidden';
}
function cachage(id){
	var elem=document.getElementById(id);
	var cache=document.getElementById('cache');
	var table=document.getElementById('tableau');
	elem.style.display='none';
	cache.style.display='none';
	table.parentNode.style.overflow='auto';
}
	</script>
<?php 
	$titre="Propriétaires : ".$_SESSION['nom'];
	include("../header.php");
?>
	<section>
		<div class='titre'>
			<h1>Bonjour <?php echo $_SESSION['nom']; ?></h1>
			<?php
				$appartements=$db->query('SELECT numero,id FROM appartements where id_proprio="'.$_SESSION["id"].'";')->fetchAll();
				if(count($appartements)>0){
					echo " <h1></h1><h1></h1><h1></h1><h1>Vos appartements :";
					foreach($appartements as $appartement){echo "<a href=?appartement=".$appartement['id'].">".$appartement['numero']."</a>";}
					echo "<a href='./perso.php'>Nouveau</a>";
					echo "</h1>";
				}
			?>		
		</div>
		<?php
			if(isset($_GET['appartement'])){
				$ajout=False;
				$appartement=$db->query('SELECT * FROM appartements where id="'.$_GET["appartement"].'";')->fetch();
			}
			else{$ajout=True;}

			if($ajout){
				echo "
				<article id='piscine'>
					<h3>Vous êtes propriétaire d'un appartement dans une résidence de la région de Cabo Negro?</h3>
					<p>Cette page vous permet d'ajouter ou de modifier un appartement que vous souhaitez louer.</p>
					<p>La description vous permettra d'indiquer la surface de l'appartement, le nombre de pièces, le mobilier qui le compose, ...<br>
					<h3>Soyez créatif et précis</h3>, votre appartement sera plus attractif.</p>
					<p>Il vous sera possible d'ajouter autant de photos que vous souhaitez une fois l'appartement ajouté.</p>
					<p>Si vous avez la moindre question à propos de ce formulaire, n'hésitez pas à me contacter <a href='mailto:proprietaire@lesjardinsdecabo.com'>ici</a>.</p>
				</article>";
			}
			else{
				echo "<div id='cache'></div>";	
				$album=$appartement['id'];

				$photos = $db->query('SELECT * FROM photos WHERE album="'.$album.'";')->fetchAll();

				foreach($photos as $donnee) {
					echo "<div class='centrale' id='".$donnee['id']."'>";
					echo "<img class='exit cible' src='../images/croix.png' width=12 onclick=cachage('".$donnee['id']."');>
								<h2>".$album."</h2>
								<table width='100%'>
									<td class='fleche_gauche fleche cible'><img src='../images/flechega.png' width='50' onclick=revelation('".$donnee['pre_id']."');></td>
									<td class='image_principale'><img height=500 src=../".$donnee['photo'].">
										<form method='post' action='ajout_appartement.php'>
											<input type='hidden' name='album' value='".$album."'>
											<input type='hidden' name='action' value='supp_photo'>
											<input type='hidden' name='id' value='".$donnee['id']."'>
											<input type = 'submit' value='Supprimer'>
										</form>
									</td>
									<td class='fleche_droite fleche cible'><img src='../images/flechedr.png' width='50' onclick=revelation('".$donnee['post_id']."');></td>
								</table>
							</div>";
				}
				echo "<article id='piscine'>
							<h3>Album photo de votre appartement : </h3>";
				echo "	<div id='tableau'>";
				foreach($photos as $donnee) {
					echo "	<img src=../".$donnee['photo']." class='cible photo' onclick=revelation('".$donnee['id']."');>";
				}
				echo "	<form method='post' action='ajout_appartement.php' enctype='multipart/form-data' class='photo'>
								<input type='hidden' name='album' value='".$album."'>
								<input type='hidden' name='action' value='ajout_photo'>
								<input type='hidden' name='MAX_FILE_SIZE' value='12000000'>
								<input type='file' name='photos[]' multiple>
								<input type = 'submit' value='Ajouter'>
							</form>
						</div>
					</article>";
			}
		?>
	<article id='herbe'>
		<?php include("ajout_appartement_formulaire.php");?>
	</article>
	</section>
</body>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</html>	
