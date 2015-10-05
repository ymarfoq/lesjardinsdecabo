	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Les Jardins de Cabo | <?php echo $titre; ?></title>
	<META NAME="Description" CONTENT="Les Jardins de Cabo est une résidence de vacances située au Maroc et destinée à la location d'appartements saisonniers.">
	<META NAME="Keywords" CONTENT="Les Jardins de Cabo, location, appartement, vacances, Maroc, Tanger, Tetouan, Piscine, mer, plage, jetski, méditerranée, Club Med.">
	<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2015">
	<META NAME="Author" CONTENT="Yohan Marfoq">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<meta name="rating" content="general" />
	<meta name="revisit-after" content="10 Days" />
	<link rel="shortcut icon" type="image/png" href="../images/icone.ico">
	<!--POLICES-->
	<!--CSS-->
	<link rel="stylesheet" type="text/css" media="all" href="../style.css">
</head>

<body class='<?php echo $titre; ?>'>
	<header>
		<nav>
				<a id="accueil" href="../accueil/"><img src='../images/logo.png' alt="Les Jardins De Cabo" height=30></a>
				<a class="menu_item" href="../proprio/">Je suis propriétaire</a>
				<a class="menu_item" href="../vacances/">Je suis vacancié</a>
		</nav>
	</header>
	<section>
<?php $db =new PDO('sqlite:../bases/base.db');?>
