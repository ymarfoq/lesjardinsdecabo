<!DOCTYPE html>

<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="../mise_en_page.css"/>
		<title>Les Jardins de Cabo</title>
		<link rel="icon lien" href="../images/icone.ico">
</head>

<?php
$prenom=htmlentities(addslashes($_POST['prenom']));
$nom=htmlentities(addslashes($_POST['nom']));
$mail=htmlentities(addslashes($_POST['mail']));
$adresse=htmlentities(addslashes($_POST['adresse']));
$datein=htmlentities(addslashes($_POST['datein']));
$dateout=htmlentities(addslashes($_POST['dateout']));
$nadultes=htmlentities(addslashes($_POST['nadultes']));
$nenfants=htmlentities(addslashes($_POST['nenfants']));
$etat="Complet";
$prix=htmlentities(addslashes($_POST['prix']));
?>

<?php include("contrat.php");?>

<?php include("mail.php");?>

<?php include("modificationbase.php"); ?>


<body>
	
	<table width="100%" cellspacing="0">
		
		<tr>
			
			<td width="10%">
			</td>
			
			<td width="80%">
			<?php include("../entete.php");?>
			</td>
			
			<td width="10%">
			</td>
			
		</tr>
		
		<tr>
			
			<td width="10%">
				<img src="../images/pub.png" width="100%" >
			</td>
			
			<td width="80%">
				<!--partie principale du site-->

<?php

     if(mail($destinataire,$sujet,$message,$headers)){
		 echo "
			<br>
			<br>
			<article class='article'>
				<center>Nous vous remercions d'avoir choisis les Jardins de Cabo.
				<br><br>Votre réservation a bien été enregistrée.
				<br>Le contrat de location vous a été envoyé par mail.
				<br><br>Si vous n'avez rien reçu, veuillez nous <a href='../contact'>contacter</a>.
				</center>
				<h2>Réservez tout de suite votre vol</h2>
				<center>
					<iframe width='100%' height='700' src='http://www.comparateur-prix-billet-avion.com/index.html?Iprov=CDG&Idest=TNG&AR=1&date1=21/10/2013&date2=28/10/2013&AD=2&EN=1&BB=0&CL=1&provenance=alibabuy&format=1'></iframe>
				</center>
			</article>";
		}
	else{
		echo "
			<br>
			<br>
			<article class='article'>
				Nous vous prions de nous excuser, il y a eut un problème durant votre réservation.
				Veuillez réessayer ulterieurement.
			</article>";
		}
?>
		
<!--fin de la partie principale-->
			</td>
			
			<td width="10%">
				<img src="../images/pub.png" width="100%" >
			</td>
			
		</tr>
		
		<tr>
			
			<td width="10%">
			</td>
			
			<td width="80%">
				<!--pied de page-->
				<?php include("../bas_page.php")?>
				<!--fin du pied de page-->
			</td>
			
			<td width="10%">
			</td>
			
		</tr>
		
	</table>
	
</body>

</html>
