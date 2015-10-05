<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_GET['mdp'])){if($_GET['mdp']=='yoyo'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
#piscine p{margin-top:20px;}
#herbe table{margin:10px;}
.close{font-size:12px; color:red;}
</style>
<?php 
	$titre="Propriétaires";
	include("../header.php");
	$pb=False;
	if(isset($_GET['pb'])){$pb=$_GET['pb'];};
	 ?>
	
	<section>
		<div class='titre'>
			<h1>Propriétaire</h1>
		</div>
	<article id='piscine'>

	<h3>Louer votre appartement.</h3>
	<br><br>
	<p>Bonjour<br></p>
	<p>Vous êtes propriétaire d'un appartement à Cabo Negro et vous souhaitez rentabiliser un maximum cet investissement?</p>
	<p><strong>Rien de plus facile.</strong></p>
		<p>Nous vous proposons de rendre visible votre appartement sur notre site qui prendra tout en charge avant la location :</p><br>
		<p>Trouver des locataires serieux et fiables, les contacter, leur louer et s'assurer que tout se déroule parfaitement jusqu'à leur départ.</p>
		<p>Tous ce que vous avez à faire est de remplir le formulaire de la manière la plus complète afin que votre appartement soit choisis par les intéressée.</p>

	</article>
	<article id='herbe'>
		<h2>Cette partie du site n'est pas disponible pour le moment.</h2>
		<h3>Merci de votre compréhension et de votre patience.</h3>
	</article>
	</section>
</body>
<footer>
</footer>
</html>	
