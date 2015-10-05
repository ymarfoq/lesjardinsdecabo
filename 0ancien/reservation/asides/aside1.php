<h2>Tous les Albums</h2>

<?php

try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$photos = $bdd->query('select * from photo group by dossier;');


foreach($photos as $donnee){

echo "<a href='../albums/?album=".htmlspecialchars($donnee['dossier'])."'>
			<h3>".htmlspecialchars($donnee['dossier'])."</h3>
			<img src='".htmlspecialchars($donnee['adresse'])."' width='80%'>
		</a>";
	
	}

?>
