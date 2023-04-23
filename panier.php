<!-- BEN OMRANE et ZAIT -->
<?php
//Ouverture de la session
session_start();
//Appel au fichier db.class.php qui contient les codes nécessaires à la bonne connexion avec notre base de donnée
require 'db.class.php';
//Connexion à notre base de données
$DB = new DB('localhost', 'root', '', 'siteweb');
$connexion = $DB->getConnexion();

// Vérification que la connexion a réussi
if (!$connexion) {
    die('Erreur de connexion à la base de données');
}
// vérifie si une variable de session panier existe
if (isset($_SESSION['panier'])) {
    // récupère les IDs des abonnements ajoutés au panier
    $ids = implode(',', $_SESSION['panier']);
    //Utilisation d'un bloc try-catch
    try {
        // exécute une requête SQL pour récupérer les informations des abonnements correspondant aux IDs
        $stmt = $DB->query("SELECT * FROM abonnement WHERE id_abonnement IN ($ids)");
        
        // vérifie si la requête a réussi (la méthode query retourne un objet PDOStatement en cas de réussite)
        if ($stmt instanceof PDOStatement) {
            // stocke les résultats dans une variable $abonnements
            $abonnements = $stmt->fetchAll();
        }
    } catch (PDOException $e) {
        // en cas d'erreur PDO, affiche un message d'erreur
        echo 'Erreur PDO : ' . $e->getMessage();
    }
}


?>


<!DOCTYPE html>
	<!-- On fait appel au fichier qui contient notre en-tête grâce à du code php-->
	<?php
	require_once('header.html');
	?>
	<!--balise div relative à la bannière de haut de page qui contient le code promo -->
	<div class="promo-banner">
        <span class="promo-text">Obtenez 20% de réduction sur nos abonnements avec le code promo: <b>BIENVENU20</b></span>
    </div>
	<!-- Fermeture de cette balise-->
	
	<!-- Ouverture du head-->
	<head>
	<!-- Lien vers le CSS relatif à cette page-->
	<link rel="stylesheet" type="text/css" href="panier.css">
	<!--Malheuresement, suite à plusieurs bugs, nous avons dû déplacer certains bout de notre code css dans notre fichier html. -->
	<style>
        .promo-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-color: #f9c851;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            overflow: hidden;
        }

        .promo-text {
            white-space: nowrap;
            animation: scrolling-text 10s linear infinite;
			font-size:15px;
        }

        @keyframes scrolling-text {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
	</head>
	<!--Fermeture du haut de page. -->
	
	<!-- Utilisation de saut de ligne pour aérer (avec du css nous aurions aussi pu faire ça)-->
	<br><br><br><br><br><br><br>
	
	<!-- Lien pour voir les abonnements-->
	<a style="margin-left:30px; color:white; text-decoration:none; font-size:20px;" href="lesabonnements.php"> Voir les abonnements </a>
	<br><br><br><br><br>
	<!-- Ouberture d'une balise section contenant la classe panier, elle contiendra toutes les informations relatives aux abonnements choisi.-->
	<section class="panier">
		<h1> | Mon Panier </h1>
		<br><br><br>
		<!--Utilisation d'une table pour structurée toutes les informatiosn. -->
		<table>
    <tr>
	<!-- Création de nos cellules d'en tête.-->
        <th>N° de commande </th>
        <th>Type d'abonnement </th>
        <th> Prix </th>
        <th> Reset </th>
    </tr>
	
	<!-- Ouverture du code php qui nous permet de récuprer les informations relatives aux abonnements choisi.-->
    <?php
	$total = 0;
	// Initialisation de la variable $total à 0, qui sera utilisée pour calculer le coût total des abonnements dans le panier.

	// On vérifie que la connexion a réussi
	if (!$connexion) {
	    die('Erreur de connexion à la base de données');
	}
	// Si la connexion a échoué, on arrête l'exécution du script et on affiche un message d'erreur.

	if (isset($_SESSION['panier'])) {
	    // Vérifie si la variable de session panier existe
	    $ids = implode(',', $_SESSION['panier']);
	    // Convertit le tableau des IDs des abonnements en une chaîne de caractères séparée par des virgules.

	    try {
	        $stmt = $DB->getConnexion()->prepare("SELECT * FROM abonnement WHERE id_abonnement IN ($ids)");
			// Prépare une requête SQL qui sélectionne tous les abonnements dont les IDs se trouvent dans la chaîne de caractères $ids.
			$stmt->execute();
			// Exécute la requête SQL.
			$abonnements = $stmt->fetchAll();
			// Stocke les résultats de la requête dans un tableau PHP $abonnements.

	        $abonnements_uniques = array_unique($abonnements, SORT_REGULAR);
	        // Supprime les doublons du tableau $abonnements. 
			// SORT_REGULAR : compare les éléments comme si aucun n'était converti.			

			//Grâce à une boucle foreach on affiche le nom et le prix de chaque abonnement
	        foreach ($abonnements_uniques as $abonnement) {
	            echo '<tr>';
	            echo '<td  class="td">N° de commande</td>';
	            echo '<td  class="td">' . $abonnement['nom'] . '</td>';
	            echo '<td  class="td">' . $abonnement['prix'] . ' €</td>';
				//on met une petite icône qui permet de supprimer l'abonnement lorsqu'on clique dessus.
	            echo '<td  class="td"><a href="supprimer.php?id_abonnement=' . $abonnement['id_abonnement'] . '"><img src="poubelle.png"></a></td>';
	            echo '</tr>';
	            $total += $abonnement['prix'];
				// Ajoute le prix de chaque abonnement au total.

	        }
			
	    } //gestion des erreurs PDO
		catch (PDOException $e) {
	        echo 'Erreur PDO : ' . $e->getMessage();
	    }
	}
?>
</table>
<!--Fermeture de la table -->
<br><br><br><br>

<!--Ouverture d'une nouvelle table qui permet d'ajouter à notre page la partie pour insérer un code promo. -->
<table>
   <tr class="total">
   <?php
//On initialise notre variable réduction a 0.
$reduction = 0;

// On vérifie si un code promo a été saisi et on applique la réduction appropriée
if (isset($_POST['code_promo'])) {
    $code_promo = $_POST['code_promo'];
    // Vérifiez si le code promo est valide et appliquez la réduction
	//Dans notre cas, nous n'avons qu'un code promo qui est BIENVENUE20, mais dans le cas où nous aurions plusieurs code promo, 
	//Nous aurions pu soit utiliser un code similaire pour chacun des codes pormos, soit les entrées dans une base de données avec la réduction associée.
    if ($code_promo === 'BIENVENUE20') {
        $reduction = 0.2; // Si le code promo est valide, on applique la réduction de 20%
        echo "<script>alert('Code promo appliqué!');</script>"; // Afficher un message pour indiquer que le code promo a été appliqué
    } else {
        echo "<script>alert('Code promo invalide!');</script>"; // Afficher un message pour indiquer que le code promo est invalide
    }
}
?>
<!-- Ajout du formulaire pour le code promo -->
<div class="promo-form-container">
	<!-- Création d'un formulaire grâce à la balise form. 
		On utilise la méthode POST, plus sécurisée
	-->
    <form method="POST">
        <label for="code-promo">Code promo:</label>
        <input type="text" name="code_promo" id="code-promo">
        <button type="submit">Appliquer</button>
    </form>
</div>

<!-- Affichage du total de la commande -->
<th>Total : <?php echo $abonnement['prix'] * (1 - $reduction); ?> €</th>
</tr>
</table>
	<!-- Lorsqu'on cliquera sur le bouton valider, on sera dirigé vers la page 'chatpgt' qui contient les informations relatives au paiement.-->
    <form action="chatgpt.php">
        <button>Valider</button>
    </form>
	
</section>


<!-- Appel au pied de page grâce à require_once via un code php-->
<?php
	require_once('footer.html');
	?>
	
	</body>
</html>
<!--Fermeture du fichier html -->