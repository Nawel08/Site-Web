<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name = 'siteweb';
    $db_host = 'localhost';
    $db = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    // Vérifier la connexion
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
        
        // Vérifier le mot de passe
        if(password_verify($_POST['password'], $hash))
        {
            // Nom d'utilisateur et mot de passe corrects
			echo "<script>alert(\"Tu es connecté !\")</script>";
            $_SESSION['username'] = $_POST['username'];
			$_SESSION['connected'] = true;
			if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
			
			
			header('Location: accueil.html');	
        }
        else
        {
            // Mot de passe incorrect
            echo "Le mot de passe entré est incorrect.";
            header('Location: login.php?erreur=1');
        }
    }
    else
    {
        // Nom d'utilisateur incorrect
        echo "Le nom d'utilisateur entré est incorrect.";
        header('Location: login.php?erreur=1');
    }

    // Fermer la connexion
    $stmt->close();
    $db->close();
}
else
{
	
    header('Location: login.php');
}}

?>
<!DOCTYPE html>
<form action="deconnexion.php" method="POST">
    <button type="submit" class="btn btn-secondary">Déconnexion</button>
</form>
</html>
