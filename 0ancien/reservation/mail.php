<?php
     //-----------------------------------------------
     //DECLARE LES VARIABLES
     //-----------------------------------------------

     $message_texte='Bonjour '.$prenom.' '.$nom.'.'."\n\n"
									.'Votre réservation a bien été enregistrée.'."\n"
									.'Veuillez lire le contrat en pièce jointe, le signer et nous le renvoyer pour confirmer la réservation'."\n\n"
									.'Cordialement'."\n\n"
									.'Yohan Marfoq';

     $message_html='<html></html>';

     //-----------------------------------------------
     //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML
     //-----------------------------------------------

     $frontiere = '-----=' . md5(uniqid(mt_rand()));

     //-----------------------------------------------
     //HEADERS DU MAIL
     //-----------------------------------------------

     $headers = 'MIME-Version: 1.0'."\n";
     $headers .= 'Content-Type: multipart/mixed; boundary="'.$frontiere.'"';

     //-----------------------------------------------
     //MESSAGE TEXTE
     //-----------------------------------------------
     $message = 'This is a multi-part message in MIME format.'."\n\n";

     $message .= '--'.$frontiere."\n";
     $message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
     $message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
     $message .= $message_texte."\n\n";

     //-----------------------------------------------
     //MESSAGE HTML
     //-----------------------------------------------
     $message .= '--'.$frontiere."\n";

     $message .= 'Content-Type: text/html; charset="iso-8859-1"'."\n";
     $message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
     $message .= $message_html."\n\n";

     $message .= '--'.$frontiere."\n";

     //-----------------------------------------------
     //PIECE JOINTE
     //-----------------------------------------------

     $message .= 'Content-Type: contrat/pdf; name="'.$prenom.'_'.$nom.'.pdf"'."\n";
     $message .= 'Content-Transfer-Encoding: base64'."\n";
     $message .= 'Content-Disposition:attachement; filename="'.$prenom.'_'.$nom.'.pdf"'."\n\n";

     $message .= chunk_split(base64_encode(file_get_contents('../bases/contrats/'.$prenom.'_'.$nom.'.pdf')))."\n";
	
	$destinataire = $mail;
	$sujet = 'Location dans la résidence Les Jardins de Cabo';
?> 
