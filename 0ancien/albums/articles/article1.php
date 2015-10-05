<div class="center">

<?php

$alb='Appartement';
if(isset($_GET['album'])){$alb=$_GET['album'];};

try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$photos = $bdd->query('SELECT * FROM photo;');

$i=0;
foreach($photos as $donnee){
	if( htmlspecialchars($donnee['dossier']) == $alb ){
		$nom[$i]=htmlspecialchars($donnee['nom']);
		$i++;
	}
}

echo "<h2>".$alb."</h2>
	<table width='100%'>
		<td id='fleche_gauche' class='fleche'><img src='../images/flechega.png' width='80%'></td>
		<td id='image_principale' 'width=80%'><img width='100%' dossier='".$alb."' name=";
		foreach($nom as $donnee){
			echo $donnee.",";}
			echo " src=''></td>
		<td id='fleche_droite' class='fleche'><img src='../images/flechedr.png' width='80%'></td>
	</table>";
?>
</div>
