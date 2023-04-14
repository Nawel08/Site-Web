<?php
require 'db.class.php';
$DB = new DB('localhost', 'root', '', 'siteweb');
//var_dump($_GET['ids']);
//var_dump($_GET);
$date_commande = date('H:i d-m-Y');

if (isset($_GET['ids'])) {
   $ids = $_GET['ids'];
   $abonnements = explode(',', $ids);
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
	$to="zait.inesnawel@gmail.com";
$subject="Utilisation de mail()";
$message="Salut :) ";
$headers="Content-Type:text/plain;charset=utf-8\r\n";
$headers.="From nawelz0311@gmail.com\r\n";

if(mail($to,$subject,$message,$headers))
echo 'envoyé !';
else
echo 'erreur :(';
?>
    <p>Nous vous remercions pour votre achat. Un email de confirmation a été envoyé à votre adresse.</p>
    
    <p>Date de commande : <?php echo $date_commande; ?></p>
    <p>Abonnements achetés :</p>
    <?php if (isset($abonnements) && !empty($abonnements)): ?>
    <ul>
    <?php
        foreach ($abonnements as $id_abonnement) {
    $requete = $DB->prepare('SELECT * FROM abonnement WHERE id_abonnement = ?');
    $requete->execute(array($id_abonnement));
    $abonnement = $requete->fetch();

    echo '<li>';
    echo 'Nom de l\'abonnement: ' . $abonnement['nom'] . '<br>';
    echo 'Prix: ' . $abonnement['prix'] . '<br>';
    echo 'Heures de Visio: ' . $abonnement['heure_visio'];
    echo '</li>';
}
    ?>
    </ul>
    <?php endif; ?>
</body>
</html>
