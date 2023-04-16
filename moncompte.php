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
<link rel="stylesheet" type="text/css" href="moncompte2.css">
</head>
<body>
<?php
	require('header.html')
	?>
	
	<section>
	<br><br><br><br><br><br>
	<br><br>
	<div class="moncompte">
	<h2>| Mon Compte </h2>
	<br>
	<h5>Mes informations personelles </h5>

	<br><br>
	<table >
	<tr><td width="20%">Prénom :</td><td><?php echo $userinfo['prenom']; ?></td><td></td><td style="text-align:center;"><label>Photo de profil :</label></td></tr>
	<tr><td>Email :</td><td><?php echo $userinfo['mail'];?></td><td></td><td style="text-align: center" rowspan='2'><?php if (!empty($userinfo['avatar'])){ ?><img width="70%" height="70%"  style="border-radius: 25% 10%;" src="utilisateur/avatar/<?php echo $userinfo['avatar'];?>"> <?php } 
		//si la variable de l'avatar dans la base de donnée n'est pas vide?></td></tr> 
	<tr><td>Mot de passe :</td><td></td></tr><tr></td><td></td></tr>
	</table>
	<br><br>
	
	<h5>Mes abonnements </h5>
	<table>
	<tr><td>Abonnement en cours :</td><td><?php echo $userinfo['mail'];?></td></tr><tr></td><td></td></tr>
	</table>
	<br><br><br><br>
	
	<a href="modification.php">Modifier mon profil </a><br><br>
	<a href="deconnexion.php">Se déconnecter </a><br><br>
	<a href="supprimercompte.php?mail=<?php $userinfo['mail'];?>">Supprimer compte </a><br><br>
	
	<br><br><br>
	</section>
	</div>
	<br><br><br><br><br><br><br><br><br>
	<?php
	require('footer.html');
	?>
	
	</body>

</html>
<?php
}
else{
header("Location: login.php");} //si on clique sur compte mais qu'on n'est pas connecté cela nous renvoie vers la page connexion

?>




