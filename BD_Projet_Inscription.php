<!-- BEN OMRANE et ZAIT -->

<!-- Ce fichier correspond à la page inscription disponible sur notre site. -->
<!-- On y trouve un formulaire en html/CSS/JS mais aussi un lien avec notre base de donnée. -->

<!-- Ouverture de la partie en PHP, afin d'enregistrer chaqye inscription dans notre base de données.-->
<?php

//On appelle notre fichier db.class.php où se trouve toutes les lignes nécessaires pour se connecter à ntre base de donnée.
// De cette manière, on réduit drastiquement les lignes de notre code, ce qui le rend plus clair.
require 'db.class.php';

//Connexion à la base de donnée
$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); 

//Vérifcation des champs une fois le formulaire envoyé.
//Si les champs qui contiennt en nom 'mail' et 'mdp' ne sont pas vides, alors:
if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){ 
	//on affecte à la variable mail le mail du formulaire avec la fonction htmlspecialchars pour enlever les caractères html etc pour éviter les injections de code 
	$mail=htmlspecialchars($_POST['mail']); 
	//On procède de la même manière pour le prénom.
	$prenom=htmlspecialchars($_POST['prenom']);
	//Pour le mot de passe, on le sotck sous forme cryptée/hachée dans la base de donnée pour ne pas y avoir accès
	$mdp=PASSWORD_HASH($_POST['mdp'],PASSWORD_DEFAULT);
	//Si la longeur de notre variable $mail, précdemment initialisée à une taille inférieure à 250 caractères, alors:
	if (strlen($mail)<250){
		// requête SQL pour sélectionner toutes les colonnes de la table "utilisateur" où la colonne "mail" est égale à une valeur qui sera spécifiée plus tard
		$reqmail=$DB->prepare("SELECT * FROM utilisateur where mail= ?");
		//requête SQL effectuée en utilisant le paramètre de requête $mail pour remplacer le point d'interrogation dans la requête préparée
		$reqmail->execute(array($mail));
		//récupère le nombre de lignes qui résulte de la requête SQL
		$mailexist=$reqmail->rowCount();
		//Si aucune ligne n'a été trouvée
		if ($mailexist==0){
		$insert=$DB->prepare("INSERT INTO utilisateur (mail,password,prenom) VALUES (?,?,?)"); //on insère dans la base de donnée le mail et le mot de passe de l'utilisateur 
		$insert->execute(array($mail,$mdp,$prenom)); //a la place des points d'interrogation on met ces valeurs
		// Permet de rediriger l'utilisateur vers la page login.php
		header('Location: login.php');  }
		//Si le mail existe déjà on renvoie un message d'erreur
		else{
			$erreur="Mail déjà existant";
		}
	}
	//Si l'email à une taille supérieur à 250 caractères, on renvoie un message d'erreur.
	else{
		$erreur="Votre email ne doit pas dépasser 250 caractères.";
	}
	
}
//Fermeture de la partie PHP
?>

<!-- Ouverture de la partie en HTML -->
<!DOCTYPE html>
<!-- Permte de mettre la langue intiale de notre page en français.-->
<html lang="fr">
<!-- Ouverture du head où on trouvera tous les liens et informations utiles à la suite du document.-->
<head>
	<!-- Permet d'avoir tous els caractères-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3G5m2dm8l/7Upkg/g" crossorigin="anonymous">
    <!-- Lien CSS pour le style de la page -->
	<link rel="stylesheet" href="BD_Projet_Inscription.css">
	<link rel="stylesheet" href="test.css">
	<!-- Titre de la page-->
    <title>NT School | Inscription</title>
	<!-- Comme nous avons eu certains bug avec notre CSS, nous avons mit certaines propriétés directement dans le head. De cette manière, nous avons pu résoudre
	nos problèmes liés au style. 
	Toutefois, nous sommes consciente que ce n'est pas ce qu'il y a de plus estétique et recommandé.
	-->
	<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    font-size: 62.5%;
}

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f6f6f6;
    color: #333;
}

/* Container */
.inscription-container {
    width: 100%;
    max-width: 500px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 50px auto;
    padding: 30px;
    border-radius: 5px;
}


.form-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}


.form-row input,
.form-row select {
    padding: 10px;
    font-size: 1.6rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 90%;
    outline: none;
}



.form-row2 {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}


.form-row2 input,
.form-row2 select {
    padding: 10px;
    font-size: 1.6rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 30%;
    outline: none;
}

button {
    background-color: darkblue;
    border: none;
    color: white;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    width: 40%;
    margin-top: 1rem;
}

button:hover {
    background-color: darkblue;
}

/* Bootstrap overrides */
.card {
    border-radius: 5px;
}

.btn-primary {
    background-color: #4CAF50;
    border-color: #4CAF50;
}

.btn-primary:hover {
    background-color: #45a049;
    border-color: #45a049;
}
.form-row label {
    color: #191970; /* Couleur bleu nuit */
}
	</style>
	<!--Fermeture de la balise style -->
</head>
<!-- Fermeture du head.-->


<body>
	<!-- Grâce à un code PHP, on utilise "include_once" afin d'inclure sur notre page, directement après l'ouverture du body, 
	la page html qui contient notre code HTML pour notre header, lorsque l'utilisateur n'est pas connecté. 
	Ce qui est le cas ici car il est sur la page d'inscription.-->
    <?php
    include_once('header_pasco.html');
    ?>

	<main>
		<div class="inscription-container mt-5"> <!-- Création d'une div avec la classe CSS "inscription-container" et une marge en haut de 5 unités -->
			<div class="row justify-content-center"> <!-- Création d'une div avec la classe CSS "row" et centre horizontalement son contenu -->
				<div class="col-md-6"> <!-- Création d'une div avec la classe CSS "col-md-6" qui prend 6 unités de largeur sur 12 -->
					<div class="form-row"> <!-- Création d'une div avec la classe CSS "form-row" -->
						<!-- Balise h1, correspondant au titre de niveau 1, avec insertion de style CSS-->
						<h1 style="
						color: black;
					    font-size: 2.5rem;
					    font-family: 'Georgia', serif;
					    margin-bottom: 25px;
					    text-align: center;" 
					    class="text-center mb-4">Inscription</h1> <!-- Création d'un titre centré avec du texte, une police de caractères personnalisée et une marge en bas de 4 unités -->
						<form name="form-row" class="form-row" action="BD_Projet_Inscription.php" method="POST" onsubmit="return validateForm();"> <!-- Création d'un formulaire nommé "form-row" qui envoie les données à une page PHP externe et appelle une fonction JavaScript avant de soumettre les données -->
							<div class="form-row"> <!-- Création d'une div avec la classe CSS "form-row" -->
								<label>Prénom *</label> <!-- Création d'une étiquette de formulaire pour un champ de texte "Prénom" -->
								<input name="prenom" required> <!-- Crée un champ de texte nommé "prenom" qui est obligatoire -->
							</div>
							<div class="form-row"> <!-- Création d'une div avec la classe CSS "form-row" -->
								<label >Adresse mail *</label> <!-- Création d'une étiquette de formulaire pour un champ de texte "Adresse mail" -->
								<input type="email"  name="mail" required> <!-- Création d'un champ de texte nommé "mail" qui doit être une adresse e-mail et qui est obligatoire -->
							</div>
							<div class="form-row"> <!-- Création d'une div avec la classe CSS "form-row" -->
								<label for="password" class="form-label">Mot de passe *</label> <!-- Création d'une étiquette de formulaire pour un champ de texte "Mot de passe" avec une classe CSS "form-label" -->
								<input type="password" class="form-control" name="mdp" id="password" required> <!-- Création d'un champ de texte de type mot de passe nommé "mdp" avec une classe CSS "form-control" et un ID "password" qui est obligatoire -->
							</div>
							<div class="form-row"> <!-- Création d'une div avec la classe CSS "form-row" -->
								<tr> <!-- Création d'une ligne de tableau -->
									<td><label class="form-control">Confirmer le mot de passe * </label ></td> <!-- Création d'une étiquette de formulaire pour un champ de texte "Confirmer le mot de passe" avec une classe -->
									<td><input name="mdp2" type="password" id="password2" required class="input"></td> <!-- Crée un champ de texte de type mot de passe nommé "mdp2" avec un ID "password2" qui est obligatoire et a une classe CSS "input" -->
								</tr> <!-- Ferme la ligne de tableau -->
							</div> <!-- Ferme la div avec la classe CSS "form-row" -->

			<!-- Création d'une div qui contient les conditions de validité du mot de passe. -->					
<div class="validator-criters">
            <span class="chiffre"> <!-- Création d'une balise span avec la classe CSS "chiffre" -->
			<i class="far fa-check-circle"></i> <!-- Création d'une balise i avec les classes CSS "far" et "fa-check-circle" pour afficher une icône de cercle vide -->
			&nbsp;Votre mot de passe doit avoir 2 chiffres <!-- Ajoute un texte pour informer l'utilisateur que son mot de passe doit contenir 2 chiffres -->
		</span> <!-- Fermeture de la balise span -->
		<!--On procède de la même manière pour les autres conditions-->
            <span class="majuscule"><i class="far fa-check-circle"></i> &nbsp;Votre mot de passe doit avoir 1 lettre majuscule</span>
            <span class="minuscule"><i class="far fa-check-circle"></i> &nbsp;Votre mot de passe doit avoir 1 lettre minuscule</span>
            <span class="generique"><i class="far fa-check-circle"></i> &nbsp;Votre mot doit comporter 8 Caractères au minimum</span>
        </div>

    
                               <small class="form-text text-muted"> <!-- Création d'une balise small avec les classes CSS "form-text" et "text-muted" -->
								Votre mot de passe doit contenir au moins 8 caractères, 2 chiffres, 1 lettre majuscule et 1 lettre minuscule. <!-- Ajoute un texte pour informer l'utilisateur des exigences pour le mot de passe -->
							</small> <!-- Ferme la balise small -->
                            </div>
                            
                            <!-- Boutton pour s'inscrire -->
							<button style=" background-color: darkblue;" type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<script>
	function validateForm() {

	// Récupère les valeurs saisies dans les champs de formulaire
	var vprenom = document.forms["form-row"]["prenom"].value;
	var vmdp = document.forms["form-row"]["password"].value;
	var vmdp2 = document.forms["form-row"]["password2"].value;
	var vmail = document.forms["form-row"]["mail"].value;

	// Vérifie que le champ Prénom n'est pas vide
	if (vprenom == ""){
		alert("Le champ Prénom est obligatoire.");
		return false;
	}

	// Vérifie que le champ Mot de passe n'est pas vide
	if (vmdp == ""){
		alert("Le champ Mot de passe est obligatoire.");
		return false;
	}

	// Vérifie que les deux champs Mot de passe sont identiques
	if (vmdp != vmdp2){
		alert("Les mots de passe ne correspondent pas.");
		return false;
	}

	// Vérifie que le champ Email n'est pas vide et qu'il est au format correct
	if (vmail == ""){
		alert("Le champ Email est obligatoire.");
		return false;
	}else {
		var re = /\S+@\S+\.\S+/;
		if (!re.test(vmail)){
			alert("Le champ mail doit être au format text@text.text");
			return false;
		}
	}
}
</script>
<!--Code PHP qui nous permet d'insérer notre pied de page.-->
    <?php
    require_once('footer.html');
    ?>
</body>

</html>
<!--Fermeture du document HTML-->
