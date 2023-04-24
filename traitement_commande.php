<!-- BEN OMRANE et ZAIT -->

<?php
session_start(); // Démarrage de la session
require 'db.class.php'; // Inclusion du fichier de la classe de connexion à la base de données
$DB = new DB('localhost', 'root', '', 'siteweb'); // Création d'une instance de la classe DB pour se connecter à la base de données
$connexion = $DB->getConnexion(); // Récupération de l'objet PDO pour effectuer des requêtes SQL sur la base de données

// Si le formulaire de paiement a été soumis
if (isset($_POST['payment'])) {
    $_SESSION['payment_method'] = $_POST['payment']; // Stockage de la méthode de paiement choisie dans une variable de session
}

// Vérification que la connexion à la base de données a réussi
if (!$DB->getConnexion()) {
    die('Erreur de connexion à la base de données');
}

// Vérification que le formulaire de paiement a été soumis et que les champs nécessaires ont été remplis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom_carte']) && !empty($_POST['num_carte']) && !empty($_POST['date_expiration']) && !empty($_POST['cvv'])) {
    // Récupération des données du formulaire de paiement
    $nom_carte = $_POST['nom_carte'];
    $num_carte = $_POST['num_carte'];
    $date_expiration = $_POST['date_expiration'];
    $cvv = $_POST['cvv'];

    // Vérification que la variable de session panier existe
    if (isset($_SESSION['panier'])) {
        // Récupération des ID des abonnements stockés dans la variable de session panier et récupération des détails de chaque abonnement depuis la table abonnement
        $ids = implode(',', $_SESSION['panier']);
		//Bloc try-catch permettant de gérer les éventuelles erreurs
        try {
            $stmt = $connexion->prepare("SELECT * FROM abonnement WHERE id_abonnement IN ($ids)"); //préparation d'une requête SQL permettant de selectionner chaque colonne de la table abonnements qui correspond à l'id stocké.
            $stmt->execute(); //Exécution de la requête.
            $abonnements = $stmt->fetchAll(); // Stockage des résultats dans un tableau associatif
        } catch (PDOException $e) { // En cas d'erreur PDO lors de l'exécution de la requête SQL
            echo 'Erreur PDO : ' . $e->getMessage(); // Affichage du message d'erreur
        }
        
        // Pour chaque abonnement récupéré depuis la table abonnement, enregistrement d'une nouvelle commande et des détails de la commande dans la table panier
        foreach ($abonnements as $abonnement) {
            $id_abonnement = $abonnement['id_abonnement'];

            $stmt = $DB->prepare("INSERT INTO commande (date_commande, cvv, nom_carte, num_carte, id_abonnement) VALUES (:date_commande, :cvv, :nom_carte, :num_carte, :id_abonnement)"); //Préparation d'une requête SQL pour insérer une nouvel enregistrement dans la table commande.
            $stmt->bindParam(':cvv', $cvv);
            $stmt->bindParam(':nom_carte', $nom_carte);
            $stmt->bindParam(':num_carte', $num_carte);
            $stmt->bindParam(':id_abonnement', $id_abonnement);
            $date_commande = date('Y-m-d H:i:s'); // Récupération de la date et l'heure actuelle au format SQL
            $stmt->bindParam(':date_commande', $date_commande);
            $stmt->execute(); // Exécution de la requête 



            // Récupérer l'ID de la commande enregistrée
            $commande_id = $DB->getLastInsertId();

            // Enregistrer les détails de la commande dans la table panier
                        $stmt = $DB->prepare("INSERT INTO panier (id_commande, id_abonnement, prix) VALUES (:id_commande, :id_abonnement, :prix)");
            $stmt->bindParam(':id_commande', $commande_id);
            $stmt->bindParam(':id_abonnement', $abonnement['id_abonnement']);
            $stmt->bindParam(':prix', $abonnement['prix']);
            $stmt->execute();
        }

        // Supprimez la variable de session panier pour vider le panier
        unset($_SESSION['panier']);

        // Redirigez l'utilisateur vers une page de confirmation de commande
        header("Location: confirmation_commande.php?ids=" . urlencode($ids));

        exit();
    }


}
?>

