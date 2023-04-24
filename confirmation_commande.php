<!-- BEN OMRANE et ZAIT -->

<!DOCTYPE html>

<html lang="fr">
<head>
<!-- Encodage de caractère utilisé pour la page-->
    <meta charset="UTF-8">
	<!-- Titre de la page-->
    <title>Récapitulatif de commande</title>
	<!-- Importation d'un fichier CSS provenant d'une source externe-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Balise style où des style relatifs a nos classes, balise sosnt spécifiés. -->
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        table {
            width: 50%;
            margin-bottom: 40px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        label {
            margin-left: 160px;
            font-size: 15px;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            margin-left: 160px;
            width: 50%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 3px;
        }

        .valider {
            font-size: 15px;
            display: block;
            width: 50%;
            padding: 10px;
            background-color: #0071eb;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 160px;
        }

        .valider:hover {
            font-weight: bold;
        }

        fieldset {
            height: 400px;
        }
		legend{
			margin-left:80px;
		}
    </style>
</head>
<!-- fermeture de la balsie head-->

<!--Après l'ouverture de notre fichier html, on utilise du code php afin d'insérer notre en tête qui se trouve dans le fichier 'header.html'-->
<?php
session_start(); // Démarrer la session pour accéder aux variables de session
require_once('header.html');
?>
<body> 

<br><br> <br><br>
    <div class="container">
	<br><br><br>
	
	<!--balise h1 spécifiant le premier titre de la page -->
        <h1 style="color:black;">Paiement</h1>
        <!--Ouverture d'une table afin de structurer nos champs -->
        <table>
		<!-- Utilisation de code php afin d'avoir un lien avec notre base de donnée-->
            <?php
			
			require 'db.class.php'; // Inclure le fichier db.class.php pour se connecter à la base de données
			$DB = new DB('localhost', 'root', '', 'siteweb'); // Instancier l'objet DB pour se connecter à la base de données

			if (isset($_SESSION['panier'])) { // Vérifier si la variable de session 'panier' existe
			$ids = implode(',', $_SESSION['panier']); // Récupérer les identifiants des abonnements sélectionnés dans le panier
			try {
				$stmt = $DB->query("SELECT * FROM abonnement WHERE id_abonnement IN ($ids)"); // Exécuter une requête SQL pour récupérer les informations des abonnements sélectionnés
				if ($stmt instanceof PDOStatement) { // Vérifier si l'objet de la requête est une instance de PDOStatement
					$abonnements = $stmt->fetchAll(); // Récupérer toutes les lignes du résultat de la requête dans un tableau
					foreach ($abonnements as $abonnement) { // Parcourir le tableau de résultats
						echo '<tr>'; // Afficher une nouvelle ligne de tableau 
						echo '<td>' . $abonnement['nom'] . '</td>'; // Afficher le nom de l'abonnement dans une cellule
						echo '<td>' . $abonnement['prix'] . ' €</td>'; // Afficher le prix de l'abonnement dans une cellule
						echo '</tr>'; // Fermer la ligne de tableau 
					}
				}
			} catch (PDOException $e) { // Si une exception est levée lors de l'exécution de la requête
				echo 'Erreur PDO : ' . $e->getMessage(); // Afficher le message d'erreur
			}
		}

            ?>
			
        </table>
     <!-- fermeture du tableau-->
	 
	 <!--Formulaire relatif au traitement de la commande, on y retrouvera tous les champs lié au paiement. -->
	 <!-- Pour cela, on utilise la méthode POST-->
	 <!--Une fois le formulaire soumis, l'utilisateur sera dirigé vers la page traitement_commande.php -->
    <form action="traitement_commande.php" method="POST">
	<!--Utilisation de la balise fieldset afin d'avoir automatiquement les bords d'un tableau  -->
        <fieldset>
            <br><br>
			<!--Insertion de nos champs à l'aide des balises label et input -->
            <label for="nom">Nom</label>
            <input type="text" name="nom_carte" required>
            <label for="numero">Numéro de carte</label>
			<input type="text" name="num_carte" placeholder="ex: 1234 1234 1234 1234" required>
			<label for="date_exp">Date d'expiration</label>
            <input type="text" name="date_expiration" placeholder="ex: 03/25" required>
                <label for="cvv">CVV</label>
                <input type="text" name="cvv" placeholder="ex: 908 " required><br>
		</fieldset>
		<br><br>
		<!-- Boutton de validation du formulaire-->
		<input type="submit" class="valider" value="Valider la commande">
		<br>
	</form>
	</div>
	<!-- Insertion du code necessaire pour avoir le pied de page-->
	<?php
	require_once('footer.html');
	?>
</body>
</html>
