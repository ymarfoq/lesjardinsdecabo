<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_POST['mdp'])){if($_POST['mdp']=='Carpediem/2014'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
article table{width:100%;}
#resume{text-align:center; overflow:hidden; margin:15px; font: 20px 'ruzicka', sans-serif;}
</style>
<?php 
	$titre="Accueil";
	include("../header.php");
?>
	<article id='piscine'>
		
	</article>
	<article id='herbe'>
		
	</article>
</body>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</html>	
