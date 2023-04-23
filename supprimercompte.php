<!-- BEN OMRANE et ZAIT -->
<?php
session_start(); // Démarrage de la session
$DB= new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); // Connexion à la base de données
if(isset($_SESSION['mail'])){ // Si la variable de session 'mail' existe
  $getmail=htmlspecialchars($_SESSION['mail']); // Récupération de la variable 'mail' de la session et protection contre les failles XSS
  $requser=$DB->prepare('DELETE FROM utilisateur WHERE mail=?'); // Préparation de la requête SQL pour supprimer l'utilisateur correspondant au mail
  $requser->execute(array($getmail)); // Exécution de la requête avec le mail récupéré
  if ($requser->rowCount()>0){ // Si une ligne a été supprimée dans la table 'utilisateur'
    header('Location:BD_Projet_Inscription.php'); // Redirection vers la page d'inscription
  }
  else{
    echo("erreur de suppression"); // Affichage d'un message d'erreur si aucune ligne n'a été supprimée
  }
}
?>
