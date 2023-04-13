<?php
session_start();
$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); //connexion avec notre base de donnée
//utilisation de host=127.0.1 car plus rapide 
if (isset($_POST['formconnexion'])){
$mailconnect=htmlspecialchars($_POST['username']); //je récupère la variable de mon formulaire
$mdpconnect=sha1($_POST['password']); //même type d'encodage que dans l'inscription mon compte pour pouvoir reconnaitre le mot de passe
$requser=$DB->prepare("SELECT * FROM utilisateur WHERE mail=? AND password=?"); //requete sql qui récupère tous les noms d'utilisateur et les mots de passes
$requser->execute(array($mailconnect,$mdpconnect)); //on execute la requete sql avec nos variables initialisé plus haut
$userexist= $requser->rowCount(); //nous permet de compter le nombre de colonne qui existe avec les info de l'utilisateur
if($userexist==1){ //si le mail et le mdp existe dans la base de donnée
	$userinfo=$requser->fetch(); //pour recevoir les informations
	$_SESSION['mail']=$userinfo['mail'];
	echo $_SESSION['mail'];
	$_SESSION['prenom']=$userinfo['prenom'];
	header("Location: moncompte.php?mail=".$_SESSION['mail']); //pour renvoyer vers le profil de la personne qui se connecte
}
else{
	$erreur="Mauvais mail ou mot de passe";
	
}
}
?>
 <!DOCTYPE html>

<html>
 <head>

 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 
 <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
 </head>
<body>
<?php require("header.html");
?>
 <div id="container">

 <form action="" method="POST" > 
 <h1>Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit" id='submit' value='LOGIN' name="formconnexion" >
 <br>
 <br>
 <br>
 <a class="lien_haut" href=#>Mot de passe oublié</a>
 <br>
 Nouvel utilisateur? <a class="lien_haut" href="BD_Projet_Inscription.html">Inscription </a>
 <br>
Des difficultés pour vous connecter ? <a class="lien_haut" href="BD_Projet_Contact.html">Contacte-nous</a>
  <br>
  <?php 
 if (isset($erreur)){
	 echo '<a style="color:red">'.$erreur."</a>";
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
