<?php
session_start();
$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb', 'root', '');

if (isset($_SESSION['mail'])) {
    $getmail = htmlspecialchars($_SESSION['mail']);
    $requser = $DB->prepare('SELECT * FROM utilisateur WHERE mail=?');
    $requser->execute(array($getmail));
    $userinfo = $requser->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>N&T School | Mon Compte</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="moncompte.css">
</head>
<body>
    <?php if (isset($_SESSION['mail'])): ?>
        <?php require('header.html') ?>
<br>
					<br>
					<br>
					<br>
        <main class="container">
            <section class="mt-5">
                <div class="card">
                    <div class="card-header">
					<br>
					<br>
					
                        <h2 style=" color: black;">Mon Compte</h2>
						
                    </div>
                    <div class="card-body">
					<br>
					<br>
					
                        <h5 style="color: black;" >Mes informations personnelles</h5>
						<br>
					<br>
                        <table class="table">
                            <tr>
                                <td width="20%">Prénom :</td>
                                <td><?php echo $userinfo['prenom']; ?></td>
                                <td></td>
                                <td style="text-align:center;"><label>Photo de profil :</label></td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td><?php echo $userinfo['mail']; ?></td>
                                <td></td>
                                <td style="text-align: center" rowspan='2'>
                                    <?php if (!empty($userinfo['avatar'])): ?>
                                        <img width="20%" height="20%" style="border-radius: 25% 10%;" src="utilisateur/avatar/<?php echo $userinfo['avatar']; ?>">
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                        <div class="mt-4">
                            <a href="modification.php" class="btn btn-primary">Modifier mon profil</a>
                            <a href="deconnexion.php" class="btn btn-secondary">Se déconnecter</a>
                            <a href="supprimercompte.php?mail=<?php echo $userinfo['mail']; ?>" class="btn btn-danger">Supprimer compte</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php require('footer.html') ?>
    <?php else: ?>
        <?php header("Location: login.php"); ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


