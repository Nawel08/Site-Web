<!-- BEN OMRANE et ZAIT -->
<?php
require 'db.class.php'; // inclure le fichier de la classe de connexion à la base de données
$DB = new DB('localhost', 'root', '', 'siteweb'); // créer une nouvelle instance de la classe DB pour se connecter à la base de données
//var_dump($_GET['ids']);
//var_dump($_GET);
$date_commande = date('H:i d-m-Y'); // obtenir la date et l'heure actuelle

if (isset($_GET['ids'])) { // on vérifie si la variable ids contient quelque chose
   $ids = $_GET['ids']; // on récupére la valeur du paramètre 'ids'
   $abonnements = explode(',', $ids); // séparer la chaîne de caractères en utilisant la virgule comme délimiteur et stocker les résultats dans un tableau
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation de commande</title>
</head>
<body>
    <h1>Votre commande a été enregistrée</h1>
	<?php
	$to="zait.inesnawel@gmail.com"; // spécifier l'adresse email du destinataire
$subject="Utilisation de mail()"; // spécifier le sujet du message
$message="Salut :) "; // spécifier le contenu du message
$headers="Content-Type:text/plain;charset=utf-8\r\n"; // spécifier le type et le jeu de caractères du contenu
$headers.="From nawelz0311@gmail.com\r\n"; // spécifier l'adresse email de l'expéditeur

if(mail($to,$subject,$message,$headers)) // envoyer le message par email et vérifier si l'envoi a réussi
echo 'envoyé !'; // afficher un message de confirmation si l'envoi a réussi
else
echo 'erreur :('; // afficher un message d'erreur si l'envoi a échoué
?>
    <p>Nous vous remercions pour votre achat. Un email de confirmation a été envoyé à votre adresse.</p>
    
    <p>Date de commande : <?php echo $date_commande; ?></p>
    <p>Abonnements achetés :</p>
    <?php if (isset($abonnements) && !empty($abonnements)): ?> // vérifier si le tableau des abonnements n'est pas vide
    <ul>
    <?php
        foreach ($abonnements as $id_abonnement) { // boucle sur le tableau des abonnements pour afficher les détails de chaque abonnement
    $requete = $DB->prepare('SELECT * FROM abonnement WHERE id_abonnement = ?'); // préparer une requête SQL pour récupérer les informations de l'abonnement correspondant à l'ID
    $requete->execute(array($id_abonnement)); // exécuter la requête en utilisant l'ID de l'abonnement comme paramètre
    $abonnement = $requete->fetch(); // récupérer les résultats de la requête et stocker les informations dans un tableau

    echo '<li>';
    echo 'Nom de l\'abonnement: ' . $abonnement['nom'] . '<br>'; // afficher le nom de l'abonnement
    echo 'Prix: ' . $abonnement['prix'] . '<br>'; // afficher le prix de l'abonnement
    echo 'Heures de Visio: ' . $abonnement['heure_visio']; //afficher l'heure de visio de l'abonnement
    echo '</li>';
}
    ?>
    </ul>
    <?php endif; ?> //pour fermer la structure du if
</body>
</html>
