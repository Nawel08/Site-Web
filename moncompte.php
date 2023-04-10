<?php
session_start(); //on démarre la session
$DB= new PDO('mysql:localhost;dbname=siteweb','root',''); //connexion à la base de donnée
if(isset($_POST['username'])){//si ma variable username existe
$requser= $DB->prepare('SELECT * FROM utilisateur WHERE username=?'); //requete sql pour récuperer nom d'utilisateur de la base de donnée
$requser->execute(array($_POST['username'])); //on execute la requête 
$userinfo=$requser->fetch(); //affichage des données
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>N&T School | Mon Compte </title>
<link rel="stylesheet" type="text/css" href="accueil.css">
</head>
<body>
<?php
	require('header.html')
	?>
	
	<section class="moncompte">
	<br><br>
	<h2>| Mon Compte </h2>
	<h5>Mes informations personelles </h5>
	<br><br>
	<table>
	<tr><td>Nom :</td><td></td></tr>
	<tr><td>Prénom :</td><td></td></tr>
	<tr><td>Email :</td><td><?php echo $userinfo['username'];?></td></tr>
	<tr><td>Mot de passe :</td><td><?php echo $userinfo['mot_de_passe'];?></td></tr>
	</table>
	<table>
	<tr>
	<td><a href="deconnexion.php">Se déconnecter </a></td>
	<td><a href="modification">Modifier mon profil </a></td>
	</tr>
	</section>
	
	<hr><br><br><br><br>
	<footer class="foot">
	<a href="FAQ.html"> FAQ</a>
	<a href="mention.html">Mentions légales </a>
	<a href="nous.html"> Qui sommes nous ? </a>
	<a href="Lesabonnements.html"> Nos abonnements </a>
	<a href="BD_Projet_Contact.html"> Nous contacter </a>
	</footer>

	
	
	</body>

</html>
<?php
}
else{
echo "Pas de variable username";}

?>

