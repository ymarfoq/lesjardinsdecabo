<?php
require('fpdf/fpdf.php');

class PDF extends FPDF{
	
// En-t�te
function Header(){
    // Logo
    //$this->Image('../images/logo_tr.png',6,4,15);
    // Saut de ligne
	$this->Ln(10);
	}

// Pied de page
function Footer(){
    // Positionnement � 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Times','I',9);
    //titre bas de page
    $this->Cell(50,10,'Contrat de location aux Jardins de Cabo',0,0);
    // Num�ro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	}
}

// Instanciation de la classe d�riv�e
$pdf = new PDF();					//cr�ation du pdf
$pdf->AliasNbPages();			//obtient le nombre de page dans {nb}
$pdf->AddPage();					//ajoute la premi�re page

// D�calage � droite
$pdf->Cell(30);
$pdf->SetFont('Times','B',16);	//police du titre
// Titre
$pdf->Cell(140,10,'LOCATION SAISONNIERE HABITATION MEUBLES',1,0,'C');
// Saut de ligne
$pdf->Ln(20);
    
//Cell(largeur, hauteur, text, bords(0,1), position ensuite(0:droite, 1:� la ligne, 2:en dessous, alignement)
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,10,'LES SOUSSIGNES : ',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(10);
$pdf->Cell(0,6,'Nom : Marfoq',0,2);
$pdf->Cell(0,6,'Pr�nom : Yohan',0,2);
$pdf->Cell(0,6,'Adresse : 7 rue de Moscou, 95520, Osny, France',0,2);

$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Ci-apr�s d�nomm� � Le BAILLEUR �',0,1,'R');
$pdf->Cell(0,8,'D\'une part',0,1,'R');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(10);
$pdf->Cell(0,6,'Nom : '.$nom,0,2);
$pdf->Cell(0,6,'Prenom : '.$prenom,0,2);
$pdf->Cell(0,6,'Adresse : '.$adresse,0,2);

$pdf->SetFont('Times','B',13);	//nouvelle police
$pdf->Cell(0,8,'Ci-apr�s d�nomm� � Le PRENEUR �',0,1,'R');
$pdf->Cell(0,8,'D\'autre part',0,1,'R');

$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,10,'ONT CONVENU CE QUI SUIT : ',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le BAILLEUR donne � bail pour la dur�e et les conditions ci-apr�s au PRENEUR qui accepte les locaux et ses agencements mobiliers et immobiliers. ',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'DUREE : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(0,6,'La pr�sente location est consentie et accept�e pour une dur�e de 1 semaine.',0,1);
$pdf->Cell(0,6,'A compt� du '.$datein.' � partir de 14h',0,1);
$pdf->Cell(0,6,'Pour se terminer le '.$dateout.' jusqu\'� 12h',0,1);

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'LOYER : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le pr�sent bail est consenti et accept� moyennant un loyer de '.$prix.' euros ( '.$prix.chr(128).' ) payable jusqu\'� 2 semaine apr�s la date de r�servation des lieux pour la totalit� de ce montant.',0,'J');
$pdf->Ln(6);
$pdf->MultiCell(0,6,'Ce montant s\'entend toutes charges comprises notamment les charges dites locatives de copropri�t�, et les consommations d\'eau et d\'�lectricit�, le loyer ci-avant fix� �tant stipul� net pour le PRENEUR.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'DEPOT DE GARANTIE : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'A son arriv�e � l\'appartement, le PRENEUR devra remettre au BAILLEUR un ch�que de : cent euros (100'.chr(128).') � titre de d�p�t de garantie qu\'il s\'engage � lui restituer sans int�r�t lors de son d�part sous d�duction, en cas de d�gradation des lieux ou de disparition d\'objets mobiliers des frais de remise en �tat des locaux et de leurs agencements dans leur �tat primitif.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'CHARGES ET CONDITIONS : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Les parties s\'engagent, chacune pour ce qui la concerne, � respecter les conditions suivantes : ',0,'J');

$pdf->Ln(6);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Obligations � la charge du PRENEUR',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le PRENEUR s\'engage � prendre les lieux lou�s dans l\'�tat o� ils se trouveront lors de l\'entr�e en jouissance, et � jouir paisiblement des locaux, �quipements et mobilier lou�s, conform�ment � l\'usage auxquels ils sont destin�s.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il ne pourra en aucun cas sous-louer, c�der ou pr�ter ses droits � la pr�sente convention ni s\'adjoindre un co-locataire ou un autre occupant m�me � titre gratuit sans l\'accord pr�alable du BAILLEUR.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'interdit de transporter hors des lieux lou�s les meubles et objets les garnissant.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Le PRENEUR sera tenu de s\'assurer � une compagnie d\'assurances contre les risques de vol, d\'incendie et d�g�ts des eaux, tant pour ses risques locatifs que pour le mobilier donn� en location, ainsi que pour les recours des voisins et � justifier du tout � premi�re demande du propri�taire qui d�cline toute responsabilit� pour le recours que leur compagnie d\'assurance pourrait exercer contre le PRENEUR en cas de sinistre.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Le PRENEUR sera tenu de s\'assurer � une compagnie d\'assurances contre les risques de vol, d\'incendie et d�g�ts des eaux, tant pour ses risques locatifs que pour le mobilier donn� en location, ainsi que pour les recours des voisins et � justifier du tout � premi�re demande du propri�taire qui d�cline toute responsabilit� pour le recours que leur compagnie d\'assurance pourrait exercer contre le PRENEUR en cas de sinistre.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'engage � remettre les lieux au BAILLEUR en bon �tat de propret�.',0,'J');

$pdf->Ln(6);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Obligations � la charge du BAILLEUR',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le BAILLEUR s\'engage � mettre les lieux lou�s et ses �quipements � la disposition du PRENEUR lors de son entr�e en jouissance en bon �tat de r�paration et de propret�, conform�ment � leur destination.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'oblige � d�livrer au PRENEUR des quittances de loyer si celui-ci en manifeste le souhait.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'CLAUSE RESOLUTOIRE',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'A d�faut de paiement aux �ch�ances fix�es ou d\'inex�cution d\'une clause quelconque du pr�sent engagement et huit jours apr�s mise en demeure rest�e infructueuse, le propri�taire pourra exiger la r�siliation imm�diate de la pr�sente convention et le PRENEUR devra quitter les lieux lou�s immediatement.',0,'J');

$pdf->Ln(10);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(130);
$pdf->Cell(0,8,'Fait � Cabo Negro',0,2,'');
$pdf->Cell(0,8,'Le '.date("d.m.y"),0,2,'');
$pdf->Cell(0,8,'En deux exemplaires',0,2,'');


//sauvegarde le document.
$pdf->Output('../bases/contrats/'.$prenom.'_'.$nom.'.pdf', 'F');

?>
