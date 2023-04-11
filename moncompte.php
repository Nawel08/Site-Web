<?php
session_start(); //on démarre la session
$DB= new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); //connexion à la base de donnée
if(isset($_SESSION['mail'])){//si ma variable de session mail existe
$getmail=htmlspecialchars($_SESSION['mail']); //pour sécuriser la variable
$requser=$DB->prepare('SELECT * FROM utilisateur WHERE mail=?');
$requser->execute(array($getmail)); //execution de la requete avec notre getid on récup le même id que celui du login
$userinfo=$requser->fetch(); //on affiche les données de la base de donnée
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>N&T School | Mon Compte </title>
<link rel="stylesheet" type="text/css" href="moncompte.css">
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
	<tr><td>Prénom :</td><td><?php echo $userinfo['prenom']; ?></td></tr>
	<tr><td>Email :</td><td><?php echo $userinfo['mail'];?></td></tr>
	<tr><td>Mot de passe :</td><td><?php echo $userinfo['password'];?></td></tr>
	
	</table>
	
	<a href="deconnexion.php" style="color:white;">Se déconnecter </a><br>
	<a href="modification.php">Modifier mon profil </a>
	
	</section>
	
	<br><br><br><br><br><br><br>
	<?php
	require('footer.html');
	?>
	
	</body>

</html>
<?php
}
else{
echo "variable n'existe pas";} //pour vérifier l'erreur

?>


