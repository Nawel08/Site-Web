<?php
session_start(); //on démarre la session
$DB= new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); //connexion à la base de donnée
if(isset($_SESSION['mail'])){ //si l'utilisateur est connecté 
$requser=$DB->prepare("SELECT * FROM utilisateur WHERE mail=?"); //requete sql pour récup les mail de utilisateurs
$requser->execute(array($_SESSION['mail'])); //on récupère celui qui a le même email
$user=$requser->fetch(); //on récupère de la base de donnée qu'on met dans une variable user

if(isset($_POST['nvxprenom']) AND !empty($_POST['nvxprenom']) AND $_POST['nvxprenom']!=$user['prenom'])
	{ //si le mail contient quelque chose et qu'il est différent de vide et différent du mail de la base de donnée de base 
	$nvxprenom=htmlspecialchars($_POST["nvxprenom"]); //pour sécuriser notre variable
	$insertprenom=$DB->prepare('UPDATE utilisateur SET prenom=? WHERE mail=? '); //requete sql pour modifier uniquement le prenom d'un mail en particulier
	$insertprenom->execute(array($nvxprenom,$_SESSION['mail']));//execution de la requete sql avec comme prenom le nouveau prenom et avec la même adresse mail
	header('Location: moncompte.php?mail='.$_SESSION['mail']); //ensuite on renvoit sur la page moncompte avec la même session de mail
	}

if(isset($_POST['nvxmdp']) AND !empty($_POST['nvxmdp']) AND isset($_POST['nvxmdp2']) AND !empty($_POST['nvxmdp2'])){//si les mots de passes sont vides
	$nvxmdp=sha1($_POST["nvxmdp"]); //pour hacher notre mdp
	$nvxmdp2=sha1($_POST['nvxmdp2']);
	if ($nvxmdp==$nvxmdp2){ //si les mots de passe sont les mêmes 
		$insertmdp=$DB->prepare("UPDATE utilisateur SET password=? WHERE mail=?"); //on fait la requete pour changer le mot de passe
		$insertmdp->execute(array($_SESSION['mail'],$nvxmdp)); //on change le mot de passe avec le nouveau 
		header('Location: moncompte.php?mail='.$_SESSION['mail']); //on renvoit l'utilisateur dans la page mon compte avec le nouveau mot de passe
	}
	else{
		$erreur="Vos deux mots de passes ne correspondent pas";
	}
}
	
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
	<h2> Modification de profil</h2>
	<form method="POST" action=""><table>
	<tr><td><label>Mon prénom :</label></td><td><input type="text" name="nvxprenom" value="<?php echo $user['prenom']; ?>"></td></tr>
	<tr><td><label>Adresse Mail :</label></td><td><input type="text" name="nvxmail" value="<?php echo $user['mail']; ?>"></td></tr>
	<tr><td><label>Mot de passe : </label></td><td><input type="password" name="nvxmdp"></td></tr>
	<tr><td><label>Confirmation du mot de passe: </label></td><td><input type="password" name="nvxmdp2"></td></tr>
	<tr><td></td><td><input type="submit" value="Mettre à jour mon profil"></td></tr>
	</table>
	<?php if (isset($erreur)){echo $erreur;} //si l'erreur existe on l'affiche?>
	</form>
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
header("Location: login.php");}

?>

