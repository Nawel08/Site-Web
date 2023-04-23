<!-- BEN OMRANE et ZAIT-->

<!DOCTYPE html>
 <head>
	<!-- encodage souhaité à l'aide de la balise meta-->
	 <meta charset="utf-8">
	 <!-- importer le fichier de style -->
	 <link rel="stylesheet" href="l.css" media="screen" type="text/css" />
 </head>
 
 
 <body style='background:#fff;'>
 <div id="content">
<?php
 session_start(); // Démarrage de la session
 
// Vérifie si la variable de session 'connected' existe et si sa valeur est vraie
if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) { 
    // Affiche un message de bienvenue à l'utilisateur connecté avec son nom d'utilisateur récupéré dans la variable de session 'username'
    echo "<div class='alert alert-success' role='alert'>Bienvenue ".$_SESSION['username']." ! Vous êtes maintenant connecté.</div>";
    // Supprime la variable de session 'connected' pour éviter qu'elle ne soit affichée à nouveau sur d'autres pages
    unset($_SESSION['connected']);
}
?>
 </div>
 </body>
</html>