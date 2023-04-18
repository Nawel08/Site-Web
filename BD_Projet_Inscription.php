<?php

require 'db.class.php';
$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); //connexion base de donnée
//$connexion = $DB->getConnexion();

// Vérifiez que la connexion a réussi
//if (!$connexion) {
  //  die('Erreur de connexion à la base de données');
//}
if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){ //on vérifie que l'email et le mdp ne sont pas vide
	$mail=htmlspecialchars($_POST['mail']); //on affecte à la variable mail le mail du formulaire avec la fonction htmlspecialchars pour enlever les caractères html etc pour éviter les injections de code 
	$prenom=htmlspecialchars($_POST['prenom']);
	$mdp=PASSWORD_HASH($_POST['mdp'],PASSWORD_DEFAULT);//de même mais on stocke le mot de passe sous forme crypté/haché dans la base de donnée pour ne pas y avoir accès
	if (strlen($mail)<250){
		$reqmail=$DB->prepare("SELECT * FROM utilisateur where mail= ?");
		$reqmail->execute(array($mail));
		$mailexist=$reqmail->rowCount();
		if ($mailexist==0){
		$insert=$DB->prepare("INSERT INTO utilisateur (mail,password,prenom) VALUES (?,?,?)"); //on insère dans la base de donnée le mail et le mot de passe de l'utilisateur 
		$insert->execute(array($mail,$mdp,$prenom)); //a la place des points d'interrogation on met ces valeurs
		header('Location: login.php');}
		else{
			$erreur="Mail déjà existant";
		}
	}
	else{
		$erreur="Votre email ne doit pas dépasser 250 caractères.";
	}
	
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3G5m2dm8l/7Upkg/g" crossorigin="anonymous">
    <link rel="stylesheet" href="BD_Projet_Inscription.css">
	<link rel="stylesheet" href="test.css">
    <title>NT School | Inscription</title>
	<style>/* Reset CSS */
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
</head>

<body>
    <?php
    include_once('header_pasco.html');
    ?>

    <main>
        <div class="inscription-container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-row">
                        <h1 style="
						color: black;
    font-size: 2.5rem;
    font-family: 'Georgia', serif;
    margin-bottom: 25px;
    text-align: center;" 
	class="text-center mb-4">Inscription</h1>
                        <form name="form-row" class="form-row" action="BD_Projet_Inscription.php" method="POST">
                            <div class="form-row">
                                <label>Prénom *</label>
                                <input name="prenom" required>
                            </div>
                            <div class="form-row">
                                <label >Adresse mail *</label>
                                <input type="email"  name="mail" required>
                            </div>
                            <div class="form-row">
                                <label for="password" class="form-label">Mot de passe *</label>
                                <input type="password" class="form-control" name="mdp" id="password" required></div>
								<div class="form-row">
								<tr><td><label class="form-control">Confirmer le mot de passe * </label ></td>
								<td><input name="mdp2" type="password" required class="input"></td></tr>
								</div>
								
<div class="validator-criters">
            <span class="chiffre"><i class="far fa-check-circle"></i> &nbsp;Votre mot de passe doit avoir 2 chiffres</span>
            <span class="majuscule"><i class="far fa-check-circle"></i> &nbsp;Votre mot de passe doit avoir 1 lettre majuscule</span>
            <span class="minuscule"><i class="far fa-check-circle"></i> &nbsp;Votre mot de passe doit avoir 1 lettre minuscule</span>
            <span class="generique"><i class="far fa-check-circle"></i> &nbsp;Votre mot doit comporter 8 Caractères au minimum</span>
        </div>

   

    <script src="test.js"></script>
                                <small class="form-text text-muted">Votre mot de passe doit contenir au moins 8 caractères, 2 chiffres, 1 lettre majuscule et 1 lettre minuscule.</small>
                            </div>
                            <div class="form-row2">
                                <label for="reponse" class="form-label">Je souhaite m'abonner à la newsletter</label>
                                <select class="form-select" name="reponse" id="reponse">
                                    <option>Oui</option>
                                    <option>Non</option>
                                </select>
                            </div>
                            <button style=" background-color: darkblue;" type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<script src="test.js"></script>
    <?php
    require_once('footer.html');
    ?>
</body>

</html>

