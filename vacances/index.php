<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_GET['mdp'])){if($_GET['mdp']=='4317SaintUrbain'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
.appartement{overflow:hidden; -webkit-transition: max-height 2s ease 0s; -moz-transition:max-height 2s ease 0s; -o-transition:max-height 2s ease 0s;  transition:max-height 2s ease 0s;}
.loyer{width:100%; background:rgba(255,255,255,0.7); text-align:center;}
.titre *{height:20px;}
#residences{display:inline-block; width:250px; text-align:left; background:#7C7C7C; position:relative; top:4px; z-index:100;}
#residences tr{background:#7C7C7C; color:#E8E8E8;}
.residence{display:none; height:30px; padding-right:10px;}
.photo{margin:10px; border-radius:5px; height:100px;}
#cache{position:absolute; top:0; right:0; left:0; bottom:-100px; background-color:black; z-index:200; opacity:0.9; display:none;}
.centrale{position:absolute; top:20px; right:10%; left:10%; bottom:10%; z-index:300; opacity:1; display:none; text-align:center;}
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

function residences(disp){
	var x = document.getElementsByClassName("menu_parc");
	for (var i = 0; i < x.length; i++) {
		x[i].style.display = disp;
	}
}

function taille(elem,taille){
	if(elem.offsetHeight>150){
		elem.style.maxHeight='30px';
	}else{
		elem.style.maxHeight=taille;
	}
}
	</script>
<?php 
	$titre="Vacancier";
	include("../header.php");
	$alb="Alentours";
	if(isset($_GET['album'])){$alb=$_GET['album'];};
	 ?>
	<!--fin entête et menu-->
	
			<div class='titre' valign=top>
				<h1>Vacancier</h1>
				<a href='./?album=Alentours' class='cible'>Alentours</a>
				<a href='./?album=Plage' class='cible'>Plage</a>
				<table id='residences' cellspacing=0>
					<tr class='cible' onmouseover=residences('block')><td><a >Résidences</a></td></tr>
					<?php $residences=$db->query('SELECT DISTINCT residence FROM appartements;')->fetchAll();
							foreach($residences as $donnees){
								echo "<tr class='residence' onmouseout=residences('none') onmouseover=residences('block')>
											<td>
												<a class='cible' href='./?album=Residence&residence=".$donnees['residence']."'>".$donnees['residence']."</a>
											</td>
										</tr>";}
					?>
				</table>
		</div>
		<article id='piscine'>
			<?php include('description.php');?>		
		</article>
		
		<div id="cache"></div>
<?php
$alb='Alentours';
if(isset($_GET['album'])){$alb=$_GET['album'];};

if($alb=='Residence'){
	$appartements=$db->query('SELECT * FROM appartements WHERE residence="'.$_GET['residence'].'";')->fetchAll();
	foreach($appartements as $appartement){
		$photos = $db->query('SELECT * FROM photos WHERE album="'.$appartement['id'].'";')->fetchAll();
		foreach($photos as $donnee) {
			echo "<div class='centrale' id='".$donnee['id']."'>";
			echo "	<img class='exit cible' src='../images/croix.png' width=15 onclick=cachage('".$donnee['id']."');>
					<table width=100%>
						<td class='fleche_gauche fleche cible'><img src='../images/flechega.png' width='50' alt='gauche' onclick=revelation('".$donnee['pre_id']."');></td>
						<td class='image_principale'><img src=../".$donnee['photo']." height=500 alt='".$donnee['photo']."'>";
						if($_SESSION['admin']){
						echo "		<form method='post' action='ajout_photo.php'>
									<input type='hidden' name='album' value='".$alb."'>
									<input type='hidden' name='action' value='supprimer'>
									<input type='hidden' name='id' value='".$donnee['id']."'>
									<input type = 'submit' value='Supprimer'>
								</form>";
							}
							echo "</td><td class='fleche_droite fleche cible'><img src='../images/flechedr.png' width='50' alt='droite' onclick=revelation('".$donnee['post_id']."');></td>
						</table>
					</div>";
		}
	}
	echo "<article id='herbe'>
				<h2>".$_GET['residence']."</h2>";
				
	foreach($appartements as $appartement){
		echo "<div style='max-height:140px;' class='appartement'>
					<h3 onclick=taille(this.parentNode,'2000px') class='cible'>Appartement : ".$appartement['numero']."</h3>";
		$photos = $db->query('SELECT * FROM photos WHERE album="'.$appartement['id'].'";')->fetchAll();
		foreach($photos as $donnee) {
			echo "<img src=../".$donnee['photo']." class='cible photo' alt='".$donnee['photo']."' onclick=revelation('".$donnee['id']."');>";
		}
		echo "<br><br><h4>Description de l'appartement</h4>";
		echo "<p>".nl2br(html_entity_decode(stripslashes($appartement['description'])))."</p><br>";
		echo "<h4>Loyers par semaine</h4>";
		echo "<table class='loyer'>
					<tr>
						<td>Haute saison<br>(Juillet + Aout)</td>
						<td>Moyenne saison<br>(Juin + Septembre)</td>
						<td>Basse saison<br>(Octobre -> Mai)</td>
					</tr>
					<tr>
						<td>".$appartement['loyer1']."€/semaine</td>
						<td>".$appartement['loyer2']."€/semaine</td>
						<td>".$appartement['loyer3']."€/semaine</td>
					</tr>
				</table>";
				echo "<br><hr><br>
					</div>";
	}
}
else{
	echo "<article id='herbe'>";
	$photos = $db->query('SELECT * FROM photos WHERE album="'.$alb.'";')->fetchAll();
	foreach($photos as $donnee) {
		echo "<div class='centrale' id='".$donnee['id']."'>
			<img class='exit cible' src='../images/croix.png' width=15 onclick=cachage('".$donnee['id']."');>
			<table width=100%>
				<td class='fleche_gauche fleche cible'><img src='../images/flechega.png' width='50' onclick=revelation('".$donnee['pre_id']."');></td>
				<td class='image_principale'><img height=500 src=../".$donnee['photo'].">";
				if($_SESSION['admin']){
					echo "		<form method='post' action='ajout_photo.php'>
								<input type='hidden' name='album' value='".$alb."'>
								<input type='hidden' name='action' value='supprimer'>
								<input type='hidden' name='id' value='".$donnee['id']."'>
								<input type = 'submit' value='Supprimer'>
							</form>";
						}
						echo "</td>
						<td class='fleche_droite fleche cible'><img src='../images/flechedr.png' width='50' onclick=revelation('".$donnee['post_id']."');></td>
					</table>
				</div>";
	}
	echo "<div id='tableau'>";
	foreach($photos as $donnee) {
		echo "<img src=../".$donnee['photo']." class='cible photo' onclick=revelation('".$donnee['id']."');>";
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
}
?>
	</article>
</section>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</body>
</html>	
