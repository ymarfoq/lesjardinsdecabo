<?php

session_start();

if($_SESSION['mdp']=='marfoq'){
	?>

<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type"></meta>
		<link href="style.css" type="text/css" rel="stylesheet"></link>
		<link href="arbre.css" type="text/css" rel="stylesheet"></link>
<?php
function affichage_famille($id, $conn){
    $m = $conn->query('SELECT * FROM marfoq WHERE id=='.$id);
    $membre = $m->fetch();
    $p = $conn->query('SELECT annee FROM marfoq WHERE id=='.$membre['parent']);
    $parent = $p->fetch();
	echo "<li";
	if($membre['parent']==0){echo " class='origine'";}
	echo "><div><a class='".$membre['genre']." cible'>";
	echo "<div class='fiche f_".$membre['genre']."' id=".$id.">
			<img class='exit cible' src='croix.png' whidth=20 height=20 onclick='cachage(".$id.")'>
					<h3>".$membre['prenom']." ".$membre['nom']."</h3>
					<img src='".$membre['photo']."'  height=300>
					<p>Date de naissance : ".$membre['naissance']."</p>";
					if($membre['conjoint']==0){
						echo "<form method='post' action='modif.php' enctype='multipart/form-data'>
							<fieldset><legend> Ajouter un conjoint</legend>
								<input type='hidden' name='type' value='conjoint'>
								<input type='hidden' name='conjoint' value='".$id."'>
								<label>Nom : </label><input name='nom' type='text' size=10 required><br>
								<label>Prenom : </label><input name='prenom' type='text' size=9 required><br>
								<label for='birthday'>Date de naissance : </label>
								<select name='jour'>
								<option selected>jour</option>";
								for($d=1;$d<=31;$d++){echo "<option value=".$d.">".$d."</option>";}
								echo "</select> 
								<select name='mois'>
									<option selected>mois</option>";
									for($m=1;$m<=12;$m++){echo "<option value=".$m.">".$m."</option>";}
								echo "</select> 
								<select name='annee'>
									<option selected >année</option>";
									for($y=date('Y');$y>=1900;$y--){echo "<option value=".$y.">".$y."</option>";}
								echo "</select><br>
								<label for='photo'>Photo : </label><input type='file' name='photo'><br>
								<input type='hidden' name='genre' value=";
								if($membre['genre']=='femme'){echo "'homme'><br>";}else{echo "'femme'><br>";}
								echo "<input type='submit' value='ajouter'></fieldset>
							</form><br>";
						}
					echo "<form method='post' action='modif.php' enctype='multipart/form-data'>
							<fieldset><legend>Ajouter un enfant</legend>
								<input type='hidden' name='type' value='enfant'>
								<input type='hidden' name='parent' value=".$id.">
								<input name='nom' type='hidden' value='";
								if($membre['genre']=='homme'){echo $membre['nom']."'>";}
								elseif($o_entry['conjoint']!=0){
									$c=$conn->query('SELECT nom FROM conjoints WHERE conjoint='.$id);
									$conjoint = $c->fetch();
									echo $conjoint['nom']."'>";}
								else{echo "inconnu'>";}							
								echo "<label for='genre'>Genre : </label>
								<input type='radio' name='genre' value='homme' required checked>&#9794
								<input type='radio' name='genre' value='femme' required>&#9792<br>
								<label>Prenom	: </label><input name='prenom' type='text' size=9 required><br>
								<label for='birthday'>Date de naissance : </label>
								<select name='jour'>
									<option selected>jour</option>";
									for($d=1;$d<=31;$d++){echo "<option value=".$d.">".$d."</option>";}
								echo "</select> 
								<select name='mois'>
									<option selected>mois</option>";
									for($m=1;$m<=12;$m++){echo "<option value=".$m.">".$m."</option>";}
								echo "</select> 
								<select name='annee'>
									<option selected >année</option>";
									for($y=date('Y');$y>=1800;$y--){echo "<option value=".$y.">".$y."</option>";}
								echo "</select><br>
									<label for='photo'>Photo : </label><input type='file' name='photo'><br>
									<input type='submit' value='ajouter'>
								</fieldset>
							</form>";
							if($_GET['mdp']=='yoyo'){
								echo "<form method='post' action='modif.php'>
									<input type='hidden' name='type' value='supprimer'>							
									<input type='hidden' name='id' value=".$id.">
									<input type='submit' value='supprimer'>
								</form>";
							}	
						echo "</div>";
				
				echo "<img src='".$membre['photo']."' width=50 height=50 onclick='revelation(".$id.")'></a>";
					
	if ($membre['conjoint']==1){
		$c = $conn->query('SELECT * FROM conjoints WHERE conjoint=='.$id);
		$conjoint = $c->fetch();
			echo "<a class='".$conjoint['genre']." cible'>
			
			<div class='fiche f_".$conjoint['genre']."' id=".($id+1).">
			<img class='exit cible' src='croix.png' whidth=20 height=20 onclick='cachage(".($id+1).")'>
					<h3>".$conjoint['prenom']." ".$conjoint['nom']."</h3>
					<img src='".$conjoint['photo']."' height=300>
					<p>Date de naissance : ".$membre['naissance']."</p>";
					echo "<form method='post' action='modif.php' enctype='multipart/form-data'>
							<fieldset><legend>Ajouter un enfant</legend>
								<input type='hidden' name='type' value='enfant'>
								<input type='hidden' name='parent' value=".$id.">
								<input name='nom' type='hidden' value='";
								if($membre['genre']=='homme'){echo $membre['nom']."'>";}
								else{echo $conjoint['nom']."'>";}
								echo "<label for='genre'>Genre : </label>
								<input type='radio' name='genre' value='homme' required checked>&#9794
								<input type='radio' name='genre' value='femme' required>&#9792<br>
								<label>Prenom : </label><input name='prenom' type='text' size=9 required><br>
								<label for='birthday'>Date de naissance : </label>
								<select name='jour'>
									<option selected>jour</option>";
									for($d=1;$d<=31;$d++){echo "<option value=".$d.">".$d."</option>";}
								echo "</select> 
								<select name='mois'>
									<option selected>mois</option>";
									for($m=1;$m<=12;$m++){echo "<option value=".$m.">".$m."</option>";}
								echo "</select> 
								<select name='annee'>
									<option selected >année</option>";
									for($y=date('Y');$y>=1800;$y--){echo "<option value=".$y.">".$y."</option>";}
								echo "</select><br>
									<label for='photo'>Photo : </label><input type='file' name='photo'><br>
									<input type='submit' value='ajouter'>
								</fieldset>
							</form>";
							if($_GET['mdp']=='yoyo'){
								echo "<form method='post' action='modif.php'>
									<input type='hidden' name='type' value='supprimer'>							
									<input type='hidden' name='id' value=".$id.">
									<input type='submit' value='supprimer'>
								</form>";
							}	
				echo "</div>
					<img src='".$conjoint['photo']."' width=50 height=50 onclick='revelation(".($id+1).")'></a>";
	}
	echo "</div>";
		
	if($membre['enfants']>0){
		$e=$conn->query('SELECT id FROM marfoq WHERE parent=='.$id.' ORDER BY annee ASC;');
		$enfants = $e->fetchAll();
		echo "<ul>";
		foreach ($enfants as $e_entry){
			affichage_famille($e_entry['id'],$conn);
		}
		echo "</ul>";
	}
	echo "</li>";
}
?>
<script>
function revelation(id){
	var fiche=document.getElementById(id);
	var allelem=document.getElementsByClassName('fiche')
	for (var i = 0; i < allelem.length; ++i) {
		var autrefiche = allelem[i];  
		autrefiche.style.display='none';
	}
	fiche.style.display='block';
}

function cachage(id){
	var elem=document.getElementById(id);
	elem.style.display='none';
}

</script>
	</head>
<body>
	
<?php include 'header.php'; ?>

<section>
<aside id='regle'>
	<?php
	$year=1800;
	while ($year < 2110){
		$height = 40+($year-1800)*3.13;
		echo "<span class='grad' style='top:".$height."px;'>".$year."</span>";
		$year =$year + 20;
	}
	?>
</aside>
<article>
	<div class="tree">
	<?php
    $o = $conn->query('SELECT * FROM marfoq WHERE parent==0');
	$origine = $o->fetchAll();
	
	echo "<ul>";
	foreach ($origine as $o_entry) {
		affichage_famille($o_entry['id'],$conn);		
		}
	echo "</ul>";
	?>
	</div>
</article>
</section>
</body>
</html>
<?php
}
else{header('Location: ../');}
	?>
