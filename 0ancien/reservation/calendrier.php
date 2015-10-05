<?php

class semaine {

	private $jourDebut;
	private $jourFin;
	private $mois;
	private $nomMois = array("","Janvier", "Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");
	private $annee;
	private $numeroDansLeMois;
	private $etat = "Disponible";
	private $prix;

function __construct( $timestamp ) {
	  $this->jourDebut = date("d",$timestamp);
	  $this->jourFin = date("d",$timestamp+7*24*3600);
	  $this->mois = date("m",$timestamp);
	  $this->annee = date("Y",$timestamp);
	  
	  $bdd =new PDO('sqlite:../bases/base.bdd');
	  $resa = $bdd->query('SELECT datein,etat FROM reservation;');
	  foreach($resa as $donnee){
		  if (html_entity_decode(stripslashes($donnee ['datein']))=="Samedi ".floor($this->jourDebut)." ".$this->nomMois[floor($this->mois)]." ".$this->annee){
			$this->etat=$donnee['etat'];}
		}
		
	  $this->numeroDansLeMois = floor(($this->jourDebut-2)/7+1);
	  if(
		$this->mois==6 & $this->numeroDansLeMois<3 || 
		$this->mois==9 & $this->numeroDansLeMois>2 ||
		$this->mois<6 || $this->mois>9 )
			{$this->prix="500";}
	  elseif(
		$this->mois==6 & $this->numeroDansLeMois>2 || 
		$this->mois==9 & $this->numeroDansLeMois<3)
			{$this->prix="700";}
	  else {$this->prix="800";}
	  
	  }	

  // getInstance method
  
  public function getdateDebut() {
	  return "Samedi ".floor($this->jourDebut)." ".$this->nomMois[floor($this->mois)]." ".$this->annee;
  }  
	  
  public function getdateFin() {
	  if(floor($this->jourFin)>floor($this->jourDebut)){
			return "Samedi ".floor($this->jourFin)." ".$this->nomMois[floor($this->mois)]." ".$this->annee;
		}
		else{
			return "Samedi ".floor($this->jourFin)." ".$this->nomMois[floor($this->mois+1)]." ".$this->annee;
		}
  }  
	  
  public function getjourDebut() {
    return $this->jourDebut;
	}
	
public function getjourFin() {
    return $this->jourFin;
	}
	
public function getmois() {
    return $this->mois;
	}
	
public function getnomMois($n) {
    return $this->nomMois[$n];
	}	
	
public function getannee() {
    return $this->annee;
	}


public function getnumeroDansLeMois() {
    return $this->numeroDansLeMois;
	}


public function getetat() {
    return $this->etat;
	}

public function getprix() {
    return $this->prix;
	}
	
	
public function reserver(){
	$this->etat = "complet";
}

public function liberer(){
	$this->etat = "disponible";
}

}



class calendrier {

	private $annee;
	private $semaines;
	private $mois = array("Janvier", "Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");
		
	
	function __construct( $annee ) {
		$this->annee = $annee;
		
		$d=01;
		while(date("D", strtotime($d."-05-".$annee))<>"Sat"){
			$d++;
		}
		$timestampDebut = strtotime($d."-05-".$annee);
		$timestampFin = strtotime("31-10-".$annee);
	  
	  $i=0;
	  while ($timestampDebut+$i*7*24*3600<$timestampFin){
		  $this->semaines[]=new semaine($timestampDebut+$i*7*24*3600);
		  $i++;
		}
	}
	  
	public function getsemaine($i){
		return $this->semaines[$i-1];
	}
	
public function getmois($i){
		return $this->mois[$i-1];
	}	
	
	
	public function nombreDeSemaines(){
		return count($this->semaines);
	}

	public function afficherLeMois($mois){
		
		echo 
		"<tr>
		<td class='calendrier'>".$this->getmois($mois)."</td>";
				
		for ($i=1;$i<$this->nombreDeSemaines(); $i++){
			if($this->getsemaine($i)->getmois()==$mois){
			echo
			"<td 
				class='euro".$this->getsemaine($i)->getprix()." calendrier' 
				name='sem dispo' 
				etat='".$this->getsemaine($i)->getetat()."' 
				debut='".$this->getsemaine($i)->getdateDebut()."' 
				fin='".$this->getsemaine($i)->getdateFin()."' 
				prix='".$this->getsemaine($i)->getprix(). "'>
					Semaine ".$this->getsemaine($i)->getnumeroDansLeMois()."<br/>
					<span class='close'>".$this->getsemaine($i)->getetat()."</span>
			</td>";
			}
		}
		echo "</tr>";
	}

	public function afficherLecalendrier(){
		
		echo 
		"<table width='100%' cellspacing='5px'>	<caption>Année ".$this->annee."</caption>";
		
		$this->afficherLeMois(5);
		$this->afficherLeMois(6);
		$this->afficherLeMois(7);
		$this->afficherLeMois(8);
		$this->afficherLeMois(9);
		$this->afficherLeMois(10);
		
		echo "</table>";
	}	
}


?>
