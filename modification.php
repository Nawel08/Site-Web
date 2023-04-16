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
if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){ //on vérifie si l'avatar est définis et si le nom de la photo de son avatar existe bien dans le dossier 
$taillemax= 2097152;//la taille maximum de la photo en octet
$extensionsValides=array('jpg','jpeg','png','gif'); //on initialise une variable de "verification" pour autorise après l'utilisateur a utilisé uniquement des fichier de ce type
	if (!$_FILES['avatar']['size']<=$taillemax){ //si la taille de la photo de l'avatar est bien respecté, soit plus petite que la taille maximum que j'ai fixé
		$extensionUpload=strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1)); 
		//strrchr pour renvoyer l'extension du fichier avec le point et le substring va nous permettre d'ignorer le premier caractère de la chaine et le strtolower pour tout mettre en minuscule pas que l'utilisateur mette en majuscule et que comme j'ai mis "png" en minuscule qu'il ne comprenne pas
		if(in_array($extensionUpload,$extensionsValides)){ //pour vérifier si l'extensionupload est bien dans les valeurs de extensions valides c'st à dire que l'extension de l'image de l'avatar corrrespond bien
			$chemin="utilisateur/avatar/".$_SESSION['mail'].".".$extensionUpload; //chemin vers lequel notre photo va aller
			$resultat=move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin); //pour déplacer le fichier de l'avatar, tmp_name est l'endroit ou se situe le fichier temporairement pour qu'on le déplace dans notre variable $chemin
			if($resultat){ //si le fichier c'est bien importé
				$updateavatar=$DB->prepare('UPDATE utilisateur SET avatar=:avatar WHERE mail= :mail'); //on prépare la requete sql afin d'ajouter ou modifie en fonction de si il y avait ou non un avatar au mail de l'utilisateur 
				$updateavatar->execute(array('avatar'=>$_SESSION['mail'].".".$extensionUpload,'mail'=>$_SESSION['mail'])); //on recup le nom du fichier avec avatar de l'amil
				header ('Location: moncompte.php?mail='.$_SESSION['mail']);
			}
			else{ //sinon
				$erreur="Erreur au cours de l'importation de la photo de profil";
			}
		}
		else{
			$erreur='Votre photo de profil doit être au format gif, jpeg, jpg ou png';
		}
}}
	else{
		$erreur="Votre photo de profil ne doit pas dépasser 2Mo";
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
	<br><br><br><br>
	<section class="moncompte">
	<br><br><br>
	<h2> Modification de profil</h2>
	<form method="POST" action="" enctype="multipart/form-data"><table> <!-- On ajoute un type d'encodage pour que l'avatar fonctionne-->
	<tr><td><label>Mon prénom :</label></td><td><input type="text" name="nvxprenom" value="<?php echo $user['prenom']; ?>"></td></tr>
	<tr><td><label>Adresse Mail :</label></td><td><input type="text" name="nvxmail" value="<?php echo $user['mail']; ?>"></td></tr>
	<tr><td><label>Mot de passe : </label></td><td><input type="password" name="nvxmdp"></td></tr>
	<tr><td><label>Confirmation du mot de passe: </label></td><td><input type="password" name="nvxmdp2"></td></tr>
	<tr><td><label>Mon avatar :</label></td><td><input type="file" name="avatar"></td></tr>
	<tr><td></td></tr>
	<tr><td></td><td><input type="submit" value="Mettre à jour mon profil" ></td></tr>
	</table>
	<?php if (isset($erreur)){echo $erreur;} //si l'erreur existe on l'affiche?>
	</form>
	<br><br><br>
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


