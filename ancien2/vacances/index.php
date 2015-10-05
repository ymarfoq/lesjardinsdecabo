<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_GET['mdp'])){if($_GET['mdp']=='yoyo'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
#tableau{overflow:auto; height:100%;}
.photo{margin:10px; border-radius:5px; height:100px;}
#cache{position:absolute; top:0; right:0; left:0; bottom:0; background-color:black; z-index:200; opacity:0.7; display:none;}
.centrale{position:absolute; top:50px; right:10%; left:10%; bottom:10%; z-index:300; opacity:1; display:none; text-align:center;}
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
	$titre="Vacancier";
	include("../header.php");
	$alb="Alentours";
	if(isset($_GET['album'])){$alb=$_GET['album'];};
	 ?>
	<!--fin entête et menu-->
	
	<section>
		<div class='titre'>
			<h1>Vacancier</h1>
			<a href='./?album=Alentours' class='cible'>Alentours</a>
			<a href='./?album=Plage' class='cible'>Plage</a>
			<a href='./?album=Residence' class='cible'>Résidence</a>
			<!--<a href='./?album=Appartement' class='cible'>Appartements</a>-->
				</ul>
			</div>
		</div>
		<article id='piscine'>
			<?php include('description.php');?>		
		</article>
		<div id="cache"></div>
<?php
$alb='Alentours';
if(isset($_GET['album'])){$alb=$_GET['album'];};

$photos = $db->query('SELECT * FROM photos WHERE album="'.$alb.'";')->fetchAll();

foreach($photos as $donnee) {
	echo "<div class='centrale' id='".$donnee['id']."'>";
	echo "<img class='exit cible' src='../images/croix.png' width=15 onclick='cachage(".$donnee['id'].");'>
				<h2>".$alb."</h2>
				<table width='100%'>
					<td class='fleche_gauche fleche cible'><img src='../images/flechega.png' width='50' onclick='revelation(".$donnee['pre_id'].");'></td>
					<td class='image_principale'><img height=600 src=../".$donnee['photo'].">";
					if($_SESSION['admin']){
						echo "<form method='post' action='ajout_photo.php'>
							<input type='hidden' name='album' value='".$alb."'>
							<input type='hidden' name='action' value='supprimer'>
							<input type='hidden' name='id' value='".$donnee['id']."'>
							<input type = 'submit' value='Supprimer'>
						</form>";
					}
					echo "</td>
					<td class='fleche_droite fleche cible'><img src='../images/flechedr.png' width='50' onclick='revelation(".$donnee['post_id'].");'></td>
				</table>
			</div>";
}
?>
		<article id='herbe'>
			
<?php
echo "<div id='tableau'>";
foreach($photos as $donnee) {
	echo "<img src=../".$donnee['photo']." class='cible photo' onclick='revelation(".$donnee['id'].");'>";
}

if($_SESSION['admin']){
	echo "<form method='post' action='ajout_photo.php' enctype='multipart/form-data' class='photo'>
	<input type='hidden' name='album' value='".$alb."'>
	<input type='hidden' name='action' value='ajouter'>
	<input type='hidden' name='MAX_FILE_SIZE' value='12000000'>
	<input type='file' name='photos[]' multiple>
	<input type = 'submit' value='Ajouter'>
</form>";
}
echo "</div>";
$db=null;
?>
	</article>
	</section>
</body>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</html>	
