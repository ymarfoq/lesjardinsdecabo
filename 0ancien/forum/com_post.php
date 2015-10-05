<?php
try  {	$bdd =new PDO('sqlite:..\bases\base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}


$qry = $bdd->prepare('INSERT INTO commentaires (nom, com, date) VALUES (?, ?,?)');

$nom=htmlentities(addslashes($_POST['nom']));
$com=htmlentities(addslashes($_POST['com']));
$date=date('d F Y');

$qry->execute(array($nom, $com, $date));

header('Location: .');
?>
