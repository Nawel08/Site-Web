<html>
 <head>

 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 
 <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
 </head>
 <!DOCTYPE html>
<html>
<head>
<html>
	<head>
		<meta charset="utf-8">
	    <title>N&T SCHOOL</title>
	    <link rel="stylesheet" type="text/css" href="accueil.css">
	</head>
	
	<body>
	<!-- Création banière-->
	<header class="main-head">
	<nav>
	<a href="accueil.html"><img src="logo2.png" alt="" id="logo"></a>
	<!--Création d'un menu déroulant-->
		<ul>
			<li class="lien" >
			<a class="lien_haut" href="#">Mathématiques</a>
			<ul class="sub-menu">
			<li class="lien">
			<br>
			<a href="#" title="terminale">Terminale</a>
			</li>
			<li class="lien">
			<a href="#" title="premiere">Première</a>
			</li>
			<li class="lien">
			<a href="#" title="seconde">Seconde</a>
			</li>
			<li class="lien">
			<a href="BD_Projet_PageMaths.html" title="troisieme">Troisième</a>
			</li>
			</ul>
			</li>
			
			<li class="lien" >
			<a class="lien_haut" href="informatique.html">Informatique</a>
			<ul class="sub-menu">
			<li class="lien">
			<br>
			<a href="BD_Projet_PageInfo.html" title="terminale">Terminale</a>
			</li>
			<li class="BD_Projet_PageInfo.html">
			<a href="#" title="premiere">Première</a>
			</li>
			<li class="lien">
			<a href="#" title="seconde">Seconde</a>
			</li>
			<li class="lien">
			<a href="#" title="troisieme">Troisième</a>
			</li>
			</ul>
			</li>
			
			<li class="lien"><a  class="lien_haut"href="BD_Projet_Inscription.html">Inscription</a></li>
			<li class="lien"><a  class="lien_haut" href="panier.php">Panier</a></li>
			<li class="lien"><a  class="lien_haut" href="login.php">Connexion</a></li>
		</ul>
	</nav>
	</header>
 <body>
 <div id="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <h1>Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit" id='submit' value='LOGIN' >
 <br>
 <br>
 <br>
 <a class="lien_haut" href=#>Mot de passe oublié</a>
 <br>
 Nouvel utilisateur? <a class="lien_haut" href="BD_Projet_Inscription.html">Inscription </a>
 <br>
Des difficultés pour vous connecter ? <a class="lien_haut" href="BD_Projet_Contact.html">Contacte-nous</a>
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>
 </div>
 <br>
 <br>
 <br>
 	<hr><br><br>
	<br>
	<footer class="foot">
	<a href="FAQ.html"> FAQ</a>
	<a href="mention.html">Mentions légales </a>
	<a href="nous.html"> Qui sommes nous ? </a>
	<a href="Lesabonnements.php"> Nos abonnements </a>
	<a href="BD_Projet_Contact.html"> Nous contacter </a>
	</footer>
	<div class="fonddumain"></div>
	<br>
	<br>
	<br>
 </body>
</html>