<div class="center">
<h2>Nos partenaires</h2>

<ul>
	<?php

try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$partenaire = $bdd->query('select * from partenaires;');


foreach($partenaire as $donnee){
	echo "
	<a href='".htmlspecialchars($donnee['site'])."' target='blank'><img src='".htmlspecialchars($donnee['logo'])."'' width='90%'></a>
	<br/>
	<br/>";
	}
	?>
</ul>
</div>
