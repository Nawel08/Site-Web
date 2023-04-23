<!-- BEN OMRANE et ZAIT -->

<!-- Je commence par une balise PHP pour initialiser une session et me connecter à la base de données -->
<?php
//Ouverture de la session
session_start();
//Connexion à la base de donnée
$DB = new PDO('mysql:host=127.0.0.1;dbname=siteweb','root','');

//Je vérifie si le formulaire de connexion est envoyé
if (isset($_POST['formconnexion'])) {
    //Je récupère le nom d'utilisateur et le mot de passe saisis dans le formulaire
    $mailconnect = htmlspecialchars($_POST['username']);
    $mdpconnect = $_POST['password'];

    //Je prépare une requête pour sélectionner l'utilisateur dans la base de données
    $requser = $DB->prepare("SELECT * FROM utilisateur WHERE mail=?");
    $requser->execute(array($mailconnect));

    //Si l'utilisateur est trouvé dans la base de données
    if ($requser->rowCount() > 0) {
        //Je récupère les informations de l'utilisateur
        $userinfo = $requser->fetch();
        //Je vérifie si le mot de passe est correct en utilisant la fonction password_verify()
        if (password_verify($mdpconnect, $userinfo['password'])) {
            //Je stocke l'adresse mail et le prénom de l'utilisateur dans des variables de session
            $_SESSION['mail'] = $userinfo['mail'];
            echo $_SESSION['mail'];
            $_SESSION['prenom'] = $userinfo['prenom'];
            //Je redirige l'utilisateur vers la page de son compte en utilisant les variables de session
            header("Location: moncompte.php?mail=" . $_SESSION['mail']);
        } else {
            //Si le mot de passe est incorrect, j'affiche un message d'erreur
            $erreur = "Mauvais mail ou mot de passe";
        }
    } else {
        //Si l'utilisateur n'est pas trouvé dans la base de données, j'affiche un message d'erreur
        $erreur = "Mauvais mail ou mot de passe";
    }
}
//Fin du code PHP
?>

<!-- Ouverture de la partie HTML de la page connexion:-->
<!DOCTYPE html>

 <head>
    <meta charset="utf-8">
    <!-- J'importe le fichier de style -->
    <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
 </head>
 
<body>
<?php 
//J'importe le header depuis un fichier externe, on met une fois de plus le header lorsque l'utilisateur n'est pas connecté
require("header_pasco.html");
?>

 <div id="container">
    <!-- Affichage du formulaire de connexion -->
    <form action="" method="POST" > 
        <h1 style="color:darkblue;">Connexion</h1>
        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
        <input type="submit" id='submit' value='LOGIN' name="formconnexion" >
		
        <br>
        <br>
        <br>
		
        <!-- Des liens pour réinitialiser le mot de passe, s'inscrire ou contacter l'assistance -->
        <a class="lien_haut"  style="margin-left:-10px;"href=#>Mot de passe oublié</a>
        <br>
        Nouvel utilisateur? <a class="lien_haut" style="margin-left:-89px;" href="BD_Projet_Inscription.php">Inscription </a>
		<br>
		Des difficultés pour vous connecter ? <a class="lien_haut" style="margin-left:-163px;" href="BD_Projet_Contact.html">Contacte-nous</a>
  <br>
  <!--Permet d'afficher un message d'errreur en cas de problème lié à la connexion-->
  <?php 
 if (isset($erreur)){
	 echo '<a style="color:red">'.$erreur."</a>";
 }
 ?>
 <!-- Fermeture du formulaire-->
 </form>
 </div>
 <!-- Grâce à php, on fait appel à notre pied de page sans avoir à le copier coller.-->
 <?php
 require_once('footer.html');
 ?>
 </body>
</html>
