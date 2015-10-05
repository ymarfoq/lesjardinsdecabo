<?php
require('fpdf/fpdf.php');

class PDF extends FPDF{
	
// En-tête
function Header(){
    // Logo
    //$this->Image('../images/logo_tr.png',6,4,15);
    // Saut de ligne
	$this->Ln(10);
	}

// Pied de page
function Footer(){
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Times','I',9);
    //titre bas de page
    $this->Cell(50,10,'Contrat de location aux Jardins de Cabo',0,0);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	}
}

// Instanciation de la classe dérivée
$pdf = new PDF();					//création du pdf
$pdf->AliasNbPages();			//obtient le nombre de page dans {nb}
$pdf->AddPage();					//ajoute la première page

// Décalage à droite
$pdf->Cell(30);
$pdf->SetFont('Times','B',16);	//police du titre
// Titre
$pdf->Cell(140,10,'LOCATION SAISONNIERE HABITATION MEUBLES',1,0,'C');
// Saut de ligne
$pdf->Ln(20);
    
//Cell(largeur, hauteur, text, bords(0,1), position ensuite(0:droite, 1:à la ligne, 2:en dessous, alignement)
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,10,'LES SOUSSIGNES : ',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(10);
$pdf->Cell(0,6,'Nom : Marfoq',0,2);
$pdf->Cell(0,6,'Prénom : Yohan',0,2);
$pdf->Cell(0,6,'Adresse : 7 rue de Moscou, 95520, Osny, France',0,2);

$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Ci-après dénommé « Le BAILLEUR »',0,1,'R');
$pdf->Cell(0,8,'D\'une part',0,1,'R');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(10);
$pdf->Cell(0,6,'Nom : '.$nom,0,2);
$pdf->Cell(0,6,'Prenom : '.$prenom,0,2);
$pdf->Cell(0,6,'Adresse : '.$adresse,0,2);

$pdf->SetFont('Times','B',13);	//nouvelle police
$pdf->Cell(0,8,'Ci-après dénommé « Le PRENEUR »',0,1,'R');
$pdf->Cell(0,8,'D\'autre part',0,1,'R');

$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,10,'ONT CONVENU CE QUI SUIT : ',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le BAILLEUR donne à bail pour la durée et les conditions ci-après au PRENEUR qui accepte les locaux et ses agencements mobiliers et immobiliers. ',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'DUREE : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->Cell(0,6,'La présente location est consentie et acceptée pour une durée de 1 semaine.',0,1);
$pdf->Cell(0,6,'A compté du '.$datein.' à partir de 14h',0,1);
$pdf->Cell(0,6,'Pour se terminer le '.$dateout.' jusqu\'à 12h',0,1);

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'LOYER : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le présent bail est consenti et accepté moyennant un loyer de '.$prix.' euros ( '.$prix.chr(128).' ) payable jusqu\'à 2 semaine après la date de réservation des lieux pour la totalité de ce montant.',0,'J');
$pdf->Ln(6);
$pdf->MultiCell(0,6,'Ce montant s\'entend toutes charges comprises notamment les charges dites locatives de copropriété, et les consommations d\'eau et d\'électricité, le loyer ci-avant fixé étant stipulé net pour le PRENEUR.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'DEPOT DE GARANTIE : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'A son arrivée à l\'appartement, le PRENEUR devra remettre au BAILLEUR un chèque de : cent euros (100'.chr(128).') à titre de dépôt de garantie qu\'il s\'engage à lui restituer sans intérêt lors de son départ sous déduction, en cas de dégradation des lieux ou de disparition d\'objets mobiliers des frais de remise en état des locaux et de leurs agencements dans leur état primitif.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'CHARGES ET CONDITIONS : ',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Les parties s\'engagent, chacune pour ce qui la concerne, à respecter les conditions suivantes : ',0,'J');

$pdf->Ln(6);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Obligations à la charge du PRENEUR',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le PRENEUR s\'engage à prendre les lieux loués dans l\'état où ils se trouveront lors de l\'entrée en jouissance, et à jouir paisiblement des locaux, équipements et mobilier loués, conformément à l\'usage auxquels ils sont destinés.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il ne pourra en aucun cas sous-louer, céder ou prêter ses droits à la présente convention ni s\'adjoindre un co-locataire ou un autre occupant même à titre gratuit sans l\'accord préalable du BAILLEUR.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'interdit de transporter hors des lieux loués les meubles et objets les garnissant.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Le PRENEUR sera tenu de s\'assurer à une compagnie d\'assurances contre les risques de vol, d\'incendie et dégâts des eaux, tant pour ses risques locatifs que pour le mobilier donné en location, ainsi que pour les recours des voisins et à justifier du tout à première demande du propriétaire qui décline toute responsabilité pour le recours que leur compagnie d\'assurance pourrait exercer contre le PRENEUR en cas de sinistre.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Le PRENEUR sera tenu de s\'assurer à une compagnie d\'assurances contre les risques de vol, d\'incendie et dégâts des eaux, tant pour ses risques locatifs que pour le mobilier donné en location, ainsi que pour les recours des voisins et à justifier du tout à première demande du propriétaire qui décline toute responsabilité pour le recours que leur compagnie d\'assurance pourrait exercer contre le PRENEUR en cas de sinistre.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'engage à remettre les lieux au BAILLEUR en bon état de propreté.',0,'J');

$pdf->Ln(6);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(0,8,'Obligations à la charge du BAILLEUR',0,1);

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'Le BAILLEUR s\'engage à mettre les lieux loués et ses équipements à la disposition du PRENEUR lors de son entrée en jouissance en bon état de réparation et de propreté, conformément à leur destination.',0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,'Il s\'oblige à délivrer au PRENEUR des quittances de loyer si celui-ci en manifeste le souhait.',0,'J');

$pdf->Ln(8);
$pdf->SetFont('Times','B',14);	//nouvelle police
$pdf->Cell(0,10,'CLAUSE RESOLUTOIRE',0,1,'C');

$pdf->SetFont('Times','',11);	//nouvelle police
$pdf->MultiCell(0,6,'A défaut de paiement aux échéances fixées ou d\'inexécution d\'une clause quelconque du présent engagement et huit jours après mise en demeure restée infructueuse, le propriétaire pourra exiger la résiliation immédiate de la présente convention et le PRENEUR devra quitter les lieux loués immediatement.',0,'J');

$pdf->Ln(10);
$pdf->SetFont('Times','B',12);	//nouvelle police
$pdf->Cell(130);
$pdf->Cell(0,8,'Fait à Cabo Negro',0,2,'');
$pdf->Cell(0,8,'Le '.date("d.m.y"),0,2,'');
$pdf->Cell(0,8,'En deux exemplaires',0,2,'');


//sauvegarde le document.
$pdf->Output('../bases/contrats/'.$prenom.'_'.$nom.'.pdf', 'F');

?>
