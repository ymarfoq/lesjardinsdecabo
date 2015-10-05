<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_POST['mdp'])){
	if($_GET['mdp']=='motdepas'){
		$_SESSION['admin']=TRUE;
	}else{
		$_SESSION['admin']=FALSE;
	}
}else{
	if(!(isset($_SESSION['admin']))){
		$_SESSION['admin']=FALSE;
	}
};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
.Accueil{background:url("../images/accueil.jpg") no-repeat scroll 50% 20% transparent; background-size:100%;}
article{position:absolute; top:30%; right:20%; left:20%; display:inline-block;}
.bouton{padding:20px; margin:30px; text-decoration:none; font-size:50px;}
.bouton:hover{padding:18px; border:2px solid; border-radius:10px; background-color:rgba(255,255,255,0.5);}
</style>
<?php 
	$titre="Accueil";
	include("../header.php");
?>
	<article>
		<a class="bouton" href="../vacances/">Vacancier</a>
		<a class="bouton" href="../proprio/">Propriétaire</a>
	</article>
</section>
<footer>
<!--stats-->
	<?php // include("../admin/stat.php") ?>
<!--fin stats -->
</footer>
</body>
</html>	
