<!--BEN OMRANE et ZAIT -->

<?php
session_start(); // on démarre la session
require 'db.class.php'; // on importe le fichier db.class.php qui contient la classe de connexion à la base de données
$DB = new DB('localhost', 'root', '', 'siteweb'); // on crée une instance de la classe DB pour se connecter à la base de données

if (isset($_SESSION['panier'])) { // si la variable de session 'panier' existe
    $ids = implode(',', $_SESSION['panier']); // on récupère les IDs des abonnements sélectionnés dans le panier et on les stocke dans une chaîne de caractères séparés par des virgules
    $abonnements = array();
	try {
        $stmt = $DB->query("SELECT * FROM abonnement WHERE id_abonnement IN ($ids)"); // on exécute une requête SQL pour récupérer les informations des abonnements sélectionnés dans le panier
        if ($stmt instanceof PDOStatement) { // si la requête est bien une instance de PDOStatement
            $abonnements = $stmt->fetchAll(); // on stocke les résultats de la requête dans un tableau associatif
            foreach ($abonnements as $abonnement) { // pour chaque abonnement dans le tableau
                echo '<tr>';
                echo '<td>' . $abonnement['nom'] . '</td>'; // on affiche le nom de l'abonnement dans une cellule du tableau HTML
                echo '<td>' . $abonnement['prix'] . ' €</td>'; // on affiche le prix de l'abonnement dans une cellule du tableau HTML
                echo '</tr>';
            }
        }
					
    } catch (PDOException $e) { // en cas d'erreur PDO lors de l'exécution de la requête
        echo 'Erreur PDO : ' . $e->getMessage(); // on affiche le message d'erreur PDO
    }
}
?>

<!DOCTYPE html>

<head>
<!-- Importation du fichier contenant notre header.-->
<?php
	require_once('header.html');
	?>
	<!--Encodage nécéssaire -->
    <meta charset="UTF-8">
	<!-- Style CSS-->
    <style>
	footer{
		widht:100%;
	}
	header{
		width:100%;
	}
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: white;
            margin: 20px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
			margin-top:30px;
        }

        .header p {
            margin: 5px 0 0;
        }

        .info {
            padding: 15px 0;
        }

        .info p {
            margin: 5px 0;
			margin-top: 40px;
			font-size:18px;
			
        }

        .items {
            border-collapse: collapse;
            width: 70%;
			margin-left:150px;
            margin-bottom: 40px;
			margin-top: 40px;
        }
		.items th{
			color:black;
		}
        .items th,
        .items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 2px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="header">
	<!--Balise h1 indiquant le titre de la page -->
        <h1>Confirmation de commande</h1>
		<!--affichage de la variable qui indique à quelle heure la commande a été effectuée -->
        <p>Date de commande : <?php $date_commande = date('H:i d-m-Y');
 echo $date_commande; ?></p>
    </div>
	<!-- Div relatives aux informations de la commande effectuée-->
    <div class="info">
        <p>Nous vous remercions pour votre achat. </p>
        <?php
$getmail = htmlspecialchars($_SESSION['mail']);
$requser = $DB->prepare('SELECT * FROM utilisateur WHERE mail=?');
$requser->execute(array($getmail));
$userinfo = $requser->fetch();

	$to=$userinfo['mail'];
$subject="Confirmation de commande";
$message = '<html><body>';
$message .= '<style> h1 {color: red;} p {font-size: 16px;} </style>';
$message .= '<h1>Confirmation de commande</h1>';
$message .= '<p>Nous vous remercions pour votre commande, elle a été enregistrée avec succès.</p>';
$message .= '<h3>Voici le récapitulatif:</h3>';
$message .= '<table>';
$message .= '<tr><th>Nom de l\'abonnement</th><th>Prix</th><th>Heures de Visio</th></tr>';


foreach ($abonnements as $id_abonnement) {
    $requete = $DB->prepare('SELECT * FROM abonnement WHERE id_abonnement = ?');
    $requete->execute(array($id_abonnement));
    $abonnement = $requete->fetch();
    $message .= '<tr><td>' . $abonnement['nom'] . '</td><td>' . $abonnement['prix'] . '</td><td>' . $abonnement['heure_visio'] . '</td></tr>';
}
$message .= '</table>';

$message .= '</body></html>';
$headers="MIME-Version: 1.0" . "\r\n";
$headers.="Content-Type:text/html;charset=utf-8\r\n";
$headers.="From: nawelz0311@gmail.com\r\n";

if(mail($to,$subject,$message,$headers))
echo 'Le récapitulatif de votre commande vous a été envoyé par mail !';
else
echo "L'email de conformation n'a pas pu être envoyé :(";
?>
<p>Abonnements achetés :</p>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Nom de l'abonnement</th>
                <th>Prix</th>
                <th>Heures de Visio</th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($abonnements) && !empty($abonnements)): ?>
            <?php
                foreach ($abonnements as $id_abonnement) {
                    $requete = $DB->prepare('SELECT * FROM abonnement WHERE id_abonnement = ?');
                    $requete->execute(array($id_abonnement));
                    $abonnement = $requete->fetch();
            ?>
            <tr>
                <td><?php echo $abonnement['nom']; ?></td>
                <td><?php echo $abonnement['prix']; ?></td>
                <td><?php echo $abonnement['heure_visio']; ?></td>
            </tr>
            <?php } ?>
        <?php endif; ?>
		
        </tbody>
    </table>

    <div class="footer">
        <p>Merci d'avoir choisi notre service.</p>
    </div>
	
	<?php
	require_once('footer.html');
	?>
</body>
</html>

