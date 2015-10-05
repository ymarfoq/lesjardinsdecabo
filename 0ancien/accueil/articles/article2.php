<table id='roll' width="300">
		
<?php

try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$photos = $bdd->query('SELECT * FROM photo ORDER BY RANDOM( );');

if( htmlspecialchars($donnee['dossier'])==$_GET['album'] ){
	$dossier=$_GET['album'];
}
else {$dossier='*';}

foreach($photos as $donnee){
		echo	"<td>
						<a href='../albums?album=".htmlspecialchars($donnee['dossier'])."'>
							<img src='../bases/albums/".htmlspecialchars($donnee['dossier'])."/".htmlspecialchars($donnee['nom']).".png' alt='".htmlspecialchars($donnee['nom'])."' height='100px'>
						</a>
					</td>";
	}
	
?>

</table>
