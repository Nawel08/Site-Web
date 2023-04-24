<!-- BEN OMRANE et ZAIT -->
<?php 
//Grâce a du code php, on fait appel au code qui est dans la page 'header.html', ainsi on aura notre en tête.
include_once('header.html');
?>

<head>
	<!-- Lien relatif au css du fichier -->
	<link rel="stylesheet" type="text/css" href='informatique.css'>
</head>
	<!-- La div suivante va nous permettre de placer nos deux premiers bouttons-->
	<div>
	<button class="un">Terminale</button>
	<button class="deux">Première</button></div>
	
	<!--Cette div nous permet de placer les deux derniers bouttons -->
	<div>
	<button class="trois">Seconde</button>
	<button class="quatre" ><a href="BD_Projet_PageInfo.php">Troisième</a></button></div>
	
	<!--Ce code est nécéssaire pour le bon fonctionnement du fond dynamique.	-->
<ul class="background">
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
   <li></li>
</ul>

<!-- fermeture du body-->
</body>
<?php 
//Code php permettant d'inclure notre pied de page disponible dans le fhcier footer.html
include_once('footer.html');
?>
</html>