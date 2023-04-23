<!-- BEN OMRANE et ZAIT -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du mode de paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .payment-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 0;
        }

        .payment-option:last-child {
            border-bottom: none;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        .payment-option img {
            max-width: 120px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #0071eb;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body> 
<br><br><br><br>
    <div class="container">
	<!-- Titre de la page possible grâce à la balise h1-->
        <h1>Choisissez votre mode de paiement</h1>
		<!-- formulaire de paiement, où le lien de redirection est test_panier.php et où la méthode utilisée est POST car ce sont des données sensibles.-->
        <form action="test_panier.php" method="POST">
            <div class="payment-option">
                <input type="radio" name="payment" value="credit_card" id="credit_card" required>
                <label for="credit_card">Carte de crédit</label>
				<!-- On utilise la balise img afin d'insérer des images relatives aux différents moyens de paiement.-->
                <img src="cb.png" alt="Logo carte de crédit">
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="paypal" id="paypal">
                <label for="paypal">PayPal</label>
                <img src="paypal.png" alt="Logo PayPal">
            </div>
			<!--Bouton pour envoyer le formulaire -->
            <button type="submit" class="submit-btn">Continuer</button>

        </form>
    </div>
</body>
<?php
session_start(); //On démarre la session
if (!isset($_SESSION['mail'])) { //Si la variable de session mail n'existe pas
    header("Location: login.php"); //On redirige l'utilisateur vers la page login.php, qui est la page de connection.
    exit(); //On stop l'exécution du code.
}

if (isset($_POST['achat_abonnement'])) { //Si l'utilisateur a cliqué sur le bouton d'achat d'abonnement.
    $id_abonnement = $_POST['id_abonnement']; //On récupère son id

    // Connexion à la base de données
	$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb', 'root', '');

	$getmail = htmlspecialchars($_SESSION['mail']); // On récupère l'adresse email de l'utilisateur connecté
	$requser = $DB->prepare('SELECT * FROM utilisateur WHERE mail = ?'); // On prépare une requête pour récupérer les informations de l'utilisateur
	$requser->execute(array($getmail));
	$userinfo = $requser->fetch(); // On stocke les informations de l'utilisateur dans une variable
	$id_utilisateur = $userinfo['id']; // On récupère l'id de l'utilisateur

	// On prépare une requête pour insérer l'abonnement acheté dans la table 'abonnements_achetes'
	$insert_abonnement = $DB->prepare("INSERT INTO abonnements_achetes (id_utilisateur, id_abonnement, date_achat) VALUES (?, ?, ?)");
	$insert_abonnement->execute(array($id_utilisateur, $id_abonnement, date("Y-m-d H:i:s"))); // On exécute la requête avec les valeurs récupérées

	header("Location: moncompte.php"); // On redirige l'utilisateur vers sa page de compte

}

?>



<?php
//Utilisation de la fonction require_once pour appeler notre fichier footer.html qui contient notre pied de page
require_once('footer.html');
?>
</html>
