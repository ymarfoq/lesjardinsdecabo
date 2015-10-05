<?php
try  {	$bdd =new PDO('sqlite:../bases/base.bdd');	}

catch (Exception $e)	{    die('Erreur : ' . $e->getMessage());	}

$qry = $bdd->prepare('INSERT INTO messages (nom, mail, sujet, mess, date) VALUES (?,?,?,?,?);');

$nom=htmlentities(addslashes($_POST['nom']));
$mail=htmlentities(addslashes($_POST['mail']));
$sujet=htmlentities(addslashes($_POST['sujet']));
$mess=htmlentities(addslashes($_POST['mess']));
$date=date('F j, Y, \à G:i:s');

$qry->execute(array($nom, $mail, $sujet, $mess, $date));

//mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )

if (mail('yoma95@hotmail.fr', $sujet ,$mess,"From : ", $mail)){
header('Location: ./');}
else{echo "erreur lors de l'envoie";};
?>
