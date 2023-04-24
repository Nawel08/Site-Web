<!DOCTYPE>
<!-- Ouverture de notre page HTML-->

	<head>
	<!-- Définition de l'en tête-->
		<meta charset="utf-8">
	    <title>Qui sommes nous ?</title>
	    <link rel="stylesheet" type="text/css" href="accueil.css">
		
	</head>
	<!--fermeture de la definiton de l'en tête -->
	
	<!-- Ouverture du body.
	On y ajoute du style css, la couleur du background.
	-->
	<body style="background-color: 03224C">
	
	<!-- On utilise du code php afin d'importer notre bannière. -->
	<?php
	require_once('header.html');
	?>
	
	<!-- Début de la section qui contient la classe 'nous', utilisée dans le code css.-->
	<section class="nous">
	
	<!--Quelques sauts de ligens pour aérer -->
	<br><br><br>
	
	<!-- Titre -->
	<h1> Qui sommes-nous ? </h1>
	
	<br><br><br><br>
	
	<!-- Nous utilisons la balise <p> pour écrire notre paragraphe d'introduction -->
	<p style="font-size:25px;"> 
	Hey, actuellement nous sommes 2 étudiantes en L2 MIASHS à la sorbonne Paris 1. 
	Au fur et à mesure de nos années d'études, nous avons appris à comprendre et apprendre seules. 
	En effet, dans la classe se trouve 35 élèves donc le professeur doit s'occuper de 35 personnes en 2heure parfois seulement en 1heure.
	Au début, on s'y fait et on pose juste quelques questions de temps en temps. Mais plus ça avance, plus les difficultés se font ressentir.
	En terminale, 30% de la classe prennent des cours particuliers, parfois même plus. Par curiosité, nous nous sommes renseignez sur le coût et certains payent jusqu'à 40euros L'HEURE. ce qui est
	inpensable pour quelqu'un qui n'est pas aisé financièrement. 
	Nous avons donc eu l'idée de créer un site web qui vous permet de comprendre sans payer très chere et sans recherches conséquentes.
	</p>
	<!-- Fermeture de notre paragraphe. -->
	
	<br><br><br><br>
	
	<!-- la balise <dl>, descrption list, nous permet de créer une liste de termes -->
	<!-- On peux ici retrouver toutes les informatiosn relatives à Tesnime-->
	<dl>Tesnime BEN OMRANE</dl>
	<li>née le 30/03/2003 </li>
	<li>BAC Mathématiques physique option Mathématique Experte au lycée Marcelin Berthelot </li>
	<li>LICENCE MIASHS option informatique à la Sorbonne Paris 1</li>
	<li>Téléphone : 0651415894</li>
	<li>Adresse mail: tesnime.benomrane@gmail.com</li>
	<li> Appuyer <a href="CVtesnime.pdf">ici</a> pour voir mon CV </li>
	
	<br><br>
	
	 <!--On retrouve ici toutes les informations relatives à Ines -->
	<dl>Ines Nawel ZAIT</dl>
	<li>née le 08/08/2003 </li>
	<li>BAC Mathématiques physique option Mathématique Experte au lycée Marcelin Berthelot </li>
	<li>LICENCE MIASHS option informatique à la Sorbonne Paris 1</li>
	<li>Téléphone : 0623131937</li>
	<li>Adresse mail: zait.inesnawel@gmail.com</li>
	<li> Appuyer <a href="CVnawel.pdf">ici</a> pour voir mon CV </li>
	
	<br><br>
	
	</section>
	<!--  Fermeture de notre section-->
	
	<!-- Utilisation du code php pour insérer le pied de page-->
	<?php
	require_once('footer.html');
	?>
	
	</body>
	<!--fermeture du body -->
</html>
<!-- fermeture du document html.-->