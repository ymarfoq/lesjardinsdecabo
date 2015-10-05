
<?php

  try {

// Create (connect to) SQLite database in file
$bdd = new PDO('sqlite:..\bases\base.bdd');
// Set errormode to exceptions
$bdd->setAttribute(PDO::ATTR_ERRMODE,
	PDO::ERRMODE_EXCEPTION);

$bdd->exec("CREATE TABLE IF NOT EXISTS partenaires (
                    nom TEXT, 
                    logo TEXT, 
                    site TEXT, 
                    contact TEXT)");

// Prepare INSERT statement to SQLite3 file db
    $insert = "INSERT INTO partenaires (nom, logo, site, contact)
					VALUES (:nom, :logo, :site, :mail)";
					
    $stmt = $bdd->prepare($insert);
    
$nom=htmlentities(addslashes($_POST['nom']));
$logo="../bases/partenaires/".$nom."/".$_FILES['logo']['name'];
$site=htmlentities(addslashes($_POST['site']));
$mail=htmlentities(addslashes($_POST['contact']));
$maxsize=htmlentities(addslashes($_POST['MAX_FILE_SIZE']));
if ($_FILES['logo']['error'] > 0) $erreur = "Erreur lors du transfert";
if ($_FILES['logo']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
 $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($_FILES['logo']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
$image_sizes = getimagesize($_FILES['logo']['tmp_name']);

//Créer un dossier 'fichiers/1/'
mkdir('../bases/partenaires/'.$nom, 0777, true);
  
move_uploaded_file($_FILES['logo']['tmp_name'],$logo);
 
 // Bind parameters to statement variables
 $stmt->bindParam(':nom', $nom); 
 $stmt->bindParam(':logo', $logo); 
 $stmt->bindParam(':site', $site); 
 $stmt->bindParam(':mail', $mail);
 
    

 
// Execute statement
$stmt->execute();

// Close file db connection
$bdd = null;

}
   
catch(PDOException $e) {
 // Print PDOException message
 echo $e->getMessage();
}


header('Location: index.php');
?>
