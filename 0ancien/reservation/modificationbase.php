<?php

$bdd = new PDO('sqlite:../bases/base.bdd');

$qry = $bdd->prepare('INSERT INTO reservation (prenom, nom, mail, adresse, datein, dateout, nadultes, nenfants, prix, etat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

$qry->execute(array($prenom, $nom, $mail, $adresse, $datein, $dateout, $nadultes, $nenfants, $prix, $etat));

?>
