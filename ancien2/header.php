<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Les Jardins de Cabo | <?php echo $titre; ?></title>
<META NAME="Description" CONTENT="Les Jardins de Cabo est une résidence de vacances située au Maroc et destinée à la location d'appartements saisonniers.">
<META NAME="Keywords" CONTENT="Résidence, Maroc, location, appartement, vacances, Tanger, Tetouan, Piscine, mer, plage, jetski, méditerranée, Activités, Club Med.">
<META NAME="Author" CONTENT="Yohan Marfoq">
<META NAME="Identifier-URL" CONTENT="http://www.lesjardinsdecabo.com">
<META NAME="Date-Creation-yyyymmdd" content="20120101">
<META NAME="Category" CONTENT="Location d'appartements">
<meta name="rating" content="general" />
<meta name="revisit-after" content="10 Days" />
<meta name="expires" content="never">
<meta name="distribution" content="global" /> 
<link rel="shortcut icon" type="image/png" href="../images/icone.ico">
<!--POLICES-->
<!--CSS-->
<link rel="stylesheet" type="text/css" media="all" href="../style.css">
<script type='text/javascript' src='../admin/script.js'></script>

</head>
<body class='<?php echo $titre; ?>'>
	<header>
		<nav>
				<a id="accueil" href="../accueil"><img src='../images/logo.png' height=30></a></li>
				<a class="menu_item" href="../proprio">Je suis propriétaire</a></li>
				<a class="menu_item" href="../vacances">Je suis vacancié</a></li>
		</nav>
	</header>
	<section>
<?php $db =new PDO('sqlite:../bases/base.db');?>
