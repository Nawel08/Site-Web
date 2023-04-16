<?php
session_start(); //initialisation d'une nouvelle session
require 'db.class.php';
$DB = new DB('localhost', 'root', '', 'siteweb');
//$connexion = $DB->getConnexion();

// Vérifiez que la connexion a réussi
//if (!$connexion) {
  //  die('Erreur de connexion à la base de données');
//}
if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){ //on vérifie que l'email et le mdp ne sont pas vide
	$mail=htmlspecialchars($_POST['mail']); //on affecte à la variable mail le mail du formulaire avec la fonction htmlspecialchars pour enlever les caractères html etc pour éviter les injections de code 
	$prenom=htmlspecialchars($_POST['prenom']);
	$mdp=sha1($_POST['mdp']);//de même mais on stocke le mot de passe sous forme crypté/haché dans la base de donnée pour ne pas y avoir accès
	$DB->query("INSERT INTO utilisateur (mail,password,prenom) VALUES('$mail','$mdp','$prenom')"); //on insère dans la base de donnée le mail et le mot de passe de l'utilisateur 
	header('Location: login.php');
	
}

?>
	
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
	<link rel="stylesheet" href="BD_Projet_Inscription.css">
	
	<title> NT School | Inscription </title>
</head>
<body>
 <?php require("header.html");?>
	<main>
	
		<p class="po">| Inscription</p>
		
		<form  name="form" action="BD_Projet_Inscription.php" method="POST" >
		<table class="formu">
		
		
		<tr>
		<td><label class="label">Prénom *</label></td>
		<td>
		<input name="prenom" required class="input"/></td>
		
		</tr>
		
		
		<tr>
		<td><label class="label">Adresse mail *</label></td>
		<td>
		
		<input name="mail" required class="input" /></td></tr>
		<tr>
		<td><label class="label">Mot de passe *</label></td>
		<td><input name="mdp" type="password" required class="input" /></td></tr>
		<tr><td><label class="label">Confirmer le mot de passe * </label ></td>
		<td><input name="mdp2" type="password" required class="input"></td></tr>
		
		
		
		<tr>
		<td>
		<br><br><br>
		<br><br><br>
		<label class="label_fin" > Je souhaite m'abonner pour avoir accès à plus de contenu </label> </td>
		
		<td ><br><br><br><br><br><br><select name="reponse">
		<option>Oui</option>
		<option>Non</option>
		</select>
		</tr>
		
		<tr>
		<td>
		<br>
		<br>
		<br>
		<br>
		<br>
		<button onclick="return validateForm()" class="lien" type="submit">S'inscrire</button>
		
		</td>
		</tr>
		</table>
		</form>
		<br>
		<br>
		<br>
		<hr>
		
		<br>
		<br>
		<br>
		<br>
	
		<br>
		</main>
    <?php
	require('footer.html');
	?>
	<br>
	<br>
	<br>
	<br>
	</footer>
			<script>
			function validateForm() {
				
				var vprenom =document.forms["form"]["prenom"].value;
				var vmdp = document.forms["form"]["mdp"].value;
				var vmdp2=document.forms["form"]["mdp2"].value;
				var vmail = document.forms["form"]["mail"].value;
				

				
				if (vprenom == ""){
					alert("Le champ Prénom est obligatoire.");
					return false;
				}
				if (vmdp == ""){
					alert("Le champ Mot de passe est obligatoire.");
					return false;
				}
				if (vmdp2!=vmdp){
					alert("Les mots de passe ne correspondent pas.");
					return false;
				}
				
				if(vmdp2==""){
					alert("Vous devez confirmez votre mot de passe");
					return false;
				}
				
				if (vmail == ""){
					alert("Le champ Email est obligatoire.");
					return false;
				}else {
					
					var re = /\S+@\S+\.\S+/;
  					if(!re.test(vmail)){
  						alert("Le champ mail doit être au format text@text.text");
						return false;
  					}
				}
				
			}
		</script>
		</body>
</html>
