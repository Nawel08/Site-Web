<!-- BEN OMRANE et ZAIT -->

<?php
//Ouverture d'une session
session_start();
//Appel du code disponible dans db.class.php, où il y a toutes les informations relatives à la connexion à notre base de données
require 'db.class.php';
//Connexion à la base de données
$DB = new DB('localhost', 'root', '', 'siteweb');
$connexion = $DB->getConnexion();


if(isset($_POST['username']) && isset($_POST['password'])){
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name = 'siteweb';
    $db_host = 'localhost';
    $db = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    // Vérification de la connexion
    if ($db->connect_error) {
        die("La connexion a échoué: " . $db->connect_error);
    }
    
    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $db->prepare("SELECT mot_de_passe FROM utilisateur WHERE nom_utilisateur = ?");

    // Lier les paramètres à la requête
    $stmt->bind_param("s", $_POST['username']);

    // Exécuter la requête
    $stmt->execute();

    // Stocker le résultat de la requête
    $stmt->store_result();
    
    // Si l'utilisateur existe dans la base de données
    if($stmt->num_rows > 0)
    {
        // Récupérer le mot de passe hashé correspondant à l'utilisateur
        $stmt->bind_result($hash);
        $stmt->fetch();
        
        // Vérifier le mot de passe grâce aux dé-hashage
        if(password_verify($_POST['password'], $hash))
        {
            // Nom d'utilisateur et mot de passe corrects
			echo "<script>alert(\"Tu es connecté !\")</script>"; //On indique à l'utilisateur qu'il est bien connecté grâce à une alert en javascript
            $_SESSION['username'] = $_POST['username'];//On récupère les variables de sessions
			$_SESSION['connected'] = true;
			if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) { //Si l'utilisateur est bien connecté
			

			if(isset($_POST['username'])){
			  $requser= $connexion->prepare('SELECT * FROM utilisateur WHERE nom_utilisateur=?');
			  $requser->execute(array($_POST['username'])); 
			  $userinfo=$requser->fetch(); 
			} 
			echo "<!DOCTYPE html>";
			/* 
			Comme PHP est un langage qui 'comprend' et 'interprète' les balises HTML, nous pouvons insérer dans echo "" le code html relatif à notre page.
			Dans le code qui suit, nous allons après avoir définit l'encodage, le titre et le fichier css à relier à notre page web,
			nous allons créer l'espace 'Mon Compte'
			
			Après un titre de niveau 2 (h2), on inscrit un titre de niveau 5.
			Suite à cela, on commence la récuparation des données.
			grâce à $userinfo, on recupère le noms d'utilisateur qu'on affiche dans une cellule du table créer.
			
			On ajoute aussi des liens (avec la balise a) qui permettent lorsqu'on clique dessus de se deconnecter ou de modifier le profil 
			*/
echo"
<head>

<meta charset='utf-8'> 
<title>N&T School | Mon Compte </title>
<link rel='stylesheet' type='text/css' href='accueil.css'>
</head>
<body>

	
	<section class='moncompte'>
	<br><br>
	<h2>| Mon Compte </h2>
	<h5>Mes informations personelles </h5>
	<br><br>
	<table>
	<tr><td>Nom :</td><td></td></tr>
	<tr><td>Prénom :</td><td></td></tr>
	<tr><td>Email :</td><td><?php echo $userinfo['nom_utilisateur'];?></td></tr>
	<tr><td>Mot de passe :</td><td><?php echo $userinfo['mot_de_passe'];?></td></tr>
	</table>
	<table>
	<tr>
	<td><a href='deconnexion.php'>Se déconnecter </a></td>
	<td><a href='modification'>Modifier mon profil </a></td>
	</tr>
	</section>
	
	<hr><br><br><br><br>
	<footer class='foot'>
	<a href='FAQ.html'> FAQ</a>
	<a href='mention.html'>Mentions légales </a>
	<a href='nous.html'> Qui sommes nous ? </a>
	<a href='Lesabonnements.php'> Nos abonnements </a>
	<a href='BD_Projet_Contact.php'> Nous contacter </a>
	</footer>

	
	
	</body>

</html>";
			header('Location: moncompte.php');	//On redirige l'uilisateur vers la page moncompte.php où il accès à son espace avec ses informations personnelles.
        }
        else
        {
            // Mot de passe incorrect
            echo "Le mot de passe entré est incorrect.";
            header('Location: login.php?erreur=1'); //On redirige l'utilisateur dans la page suivante: login.php?erreur=1
        }
    }
    else
    {
        // Nom d'utilisateur incorrect
        echo "Le nom d'utilisateur entré est incorrect.";
        header('Location: login.php?erreur=1'); //On redirige l'utilisateur dans la page suivante: login.php?erreur=1
    }

    // Fermer la connexion
    $stmt->close();
    $db->close();
}
else{
    header('Location: login.php'); //Redirection vers la page login.php, où se trouve le formulaire de connexion.
}
}



?>



<!DOCTYPE html>
<!-- Formulaire qui va permettre à l'utilisateur de se deconnecter lorsqu'il appuie sur le bouton -->
<form action="deconnexion.php" method="POST"> <!-- Nous utilions la méthode POST malgré qu'il n y ai pas de données sensibles entrées -->
    <button type="submit" class="btn btn-secondary">Déconnexion</button>
</form>
</html>
<!--Fermeture du formulaire et du fichier html -->