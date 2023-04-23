<!--BEN OMRANE et ZAIT -->


<!--Ouverture de la partie code en html. -->
<!DOCTYPE html>

<!-- Ouverture du head où on retrouve tous les liens utiles au bon fonctionnement de notre code HTML -->
<head>
		<!--lien vers les fichiers css -->
	    <link rel="stylesheet" type="text/css" href="accueil.css">
		<link rel="stylesheet" type="text/css" href="header.css">
	
		<!--Nous avons aussi mit quelques propriétes CSS ici car, nous rencontrions certains problèmes lié à la synchronisation et à l'actualisation.
		-->
		<style>
        .promo-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-color: #7F00FF;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            overflow: hidden;
        }

        .promo-text {
            white-space: nowrap;
            animation: scrolling-text 10s linear infinite;
			font-size:15px;
        }

        @keyframes scrolling-text {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
	</head>
	<!-- Fermeture et head-->
	<!-- Ouverture du body-->
	<!--Pour les mêmes raisons que citées précedemment, nous avons aussi été amenée à écrire du css directement dans les balises. -->
	<body style="background-color: #03224C">
		
	<!-- Création de la bannière qui défile en haut de page où est inscris un code promo.-->
		<div class="promo-banner">
        <span class="promo-text">Obtenez 20% de réduction sur l'abonnement SuperStrong avec le code promo: <b>BIENVENU20</b></span>
    </div>
	<!-- Fermeture du code relatif à la bannière-->
	
	<!--Ouverture du header -->
	<header class="main-head">
	<!-- Pour la page abonnement, nous avons decidé de ne pas utiliser les même header que sur les autres pages car, nous voulions que l'icône panier soit présente.-->
	<!--Ouverture de la balise navigation -->
	<nav>
	<!--Insertion du logo -->
	<a href="acceuil.php" ><img  id="logo" style="background-color: transparent;" src="logo_t5.png" width=250px height=130px ></a>
		<ul>
		<!-- Insertion de l'icône panier-->
			<li><a href="panier.php"><img height= 35px width=35px src="achats.png" ></a></li>
			<!-- Insertion du bouton pour accéder à son compte.-->
			<li ><a   href="moncompte.php"><button style="background-color:#0C0456;" class="compte">Mon Compte</button></a></li> 
		</ul>
	</nav>
	</header>
	
	<br><br><br><br><br><br><br>
	<!-- Après plusieurs sauts de lignes, création du titre grâce à la balise h1-->
	<h1 style="font-size: 50px;
	color: White;
	margin-left:50px;"> Abonnement</h1>
	
	<br><br><br><br><br>
	
	<!-- Ouverture de la classe abonnement -->
	<section class="abonnement">
	 <?php //Ouverture de la balise php
    require 'db.class.php'; //On fait appel au fichier nommé db.class.php qui contient toutes les informatiosn relatives à la connexion de notre base de données.
    $DB = new DB('localhost', 'root', '', 'siteweb'); // Connexion à la base de donnée
    $connexion = $DB->getConnexion();
	
    // Vérification que la connexion a réussi
  if (!$connexion) {
    die('Erreur de connexion à la base de données');
	}
// On ouvre un bloc try pour essayer d'exécuter le code qui suit.
try {
	// On prépare la requête SQL permettant de récupérer le nom et l'id des abonnements de la table 'abonnement'
	$stmt = $DB->getConnexion()->prepare('SELECT nom, id_abonnement FROM abonnement GROUP BY nom');
	// On exécute la requête préparée
	$stmt->execute();

	// On récupère les résultats de la requête sous forme d'objets
	$abonnements = $stmt->fetchAll(PDO::FETCH_OBJ);
}
// Si une erreur PDO est levée, on récupère le message d'erreur et on l'affiche.
catch (PDOException $e) {
	echo 'Erreur PDO : ' . $e->getMessage();
}
?>
<!-- Ouverture de la table qui va nous permettre d'afficher de manière structurée les abonnements disponibles dans notre base de donnée-->
	<table>
  <tr>
 <?php   
    // Affiche une cellule vide dans le tableau
    echo "<th></th>";

    // Prépare la requête SQL pour récupérer le nom et l'id des abonnements dans la table "abonnement"
    $stmt = $DB->getConnexion()->prepare('SELECT nom, id_abonnement FROM abonnement GROUP BY nom');
    // Exécute la requête SQL
	$stmt->execute();
	// Récupère les résultats sous forme d'objet
	$abonnements = $stmt->fetchAll(PDO::FETCH_OBJ);
	
    // Parcourt les résultats et affiche le nom de chaque abonnement dans une cellule du tableau
    foreach ($abonnements as $abonnement) {
        echo '<td>' . $abonnement->nom . '</td>'; // Affiche le nom de l'abonnement
		echo "<br>"; // Ajoute un saut de ligne
    }
?>

  <!-- Fermeture de la ligne précédente -->
</tr>
<!-- Ouverture d'une nouvelle ligne -->
<tr>
	<!-- Création de la colonne correspondant à l'en-tête du prix -->
	<th style="text-align: left;">Prix</th>
	<?php
	    // Récupération des noms et des prix des abonnements dans la base de données
	    $abonnements = $DB->query('SELECT DISTINCT nom,prix FROM abonnement');
		    // Parcours de la liste des abonnements
    foreach ($abonnements as $abonnement) {
        // Affichage du prix de chaque abonnement dans une cellule du tableau
        echo '<td>' . $abonnement->prix . '€</td>';
    }
?>
</tr>
  <tr>
  </tr>
  <tr>
  <!-- On procède exactement de la même manière pour récupérer les informatiosn relatives aux heures visio, ainsi qu'aux fiches disponibles et aux controles.-->
    <th style="text-align: left;">Heures de visios proposés</th>
    <?php
      // Récupérer les heures de visio des abonnements depuis la base de données
      $abonnements = $DB->query('SELECT DISTINCT heure_visio,heure_visio FROM abonnement');
	  
      foreach ($abonnements as $abonnement) {
	  
	  
	  echo '<td>' . $abonnement->heure_visio . '</td>';
      }
    ?>
  </tr>
  <tr>
    <th style="text-align: left;">Fiches à disposition aux choix de l'utilisateur</th>
    <?php
      // Récupérer le nombre de fiches disponibles pour chaque abonnement depuis la base de données
      $stmt = $DB->getConnexion()->prepare('SELECT fiche_dispo, id_abonnement FROM abonnement GROUP BY nom');
$stmt->execute();
$abonnements = $stmt->fetchAll(PDO::FETCH_OBJ);
	  
      foreach ($abonnements as $abonnement) {
		 
		  echo '<td>' . $abonnement->fiche_dispo . '</td>';
      }
    ?>
  </tr>
  <tr>
    <th style="text-align: left;">Contrôles pour se tester</th>
    <?php
      // Récupérer le nombre de contrôles disponibles pour chaque abonnement depuis la base de données
      $stmt = $DB->getConnexion()->prepare('SELECT controle_dispo, id_abonnement FROM abonnement GROUP BY nom');
$stmt->execute();
$abonnements = $stmt->fetchAll(PDO::FETCH_OBJ);
	  
      foreach ($abonnements as $abonnement) {
		  
			echo '<td>' . $abonnement->controle_dispo. '</td>';
		  
      }
    ?>
  </tr>
<tr>
    <td></td>
    
    <?php
    // Ouvre une connexion à la base de données
    $DB = new Database();
    
    // Récupére tous les abonnements depuis la base de données et les regrouper par nom
    $stmt = $DB->getConnexion()->prepare('SELECT fiche_dispo, id_abonnement FROM abonnement GROUP BY nom');
	//On exécute le requête
    $stmt->execute();
	//Permet de récupérer tous les résultats de la requête SQL préparée stockée dans la variable $stmt.
	//La méthode fetchAll() de l'objet PDOStatement retourne un tableau contenant toutes les lignes de résultats sous forme d'objets. 
	//Le paramètre PDO::FETCH_OBJ spécifie que ces objets seront des instances de la classe standard PHP stdClass, avec les noms des colonnes comme propriétés de l'objet.
	//Ainsi, $abonnements contiendra un tableau d'objets qui représentent les résultats de la requête SQL.
    $abonnements = $stmt->fetchAll(PDO::FETCH_OBJ);

    // On parcoure les résultats avec une boucle foreach
    foreach ($abonnements as $abonnement) {
        // Afficher un bouton "Ajouter au panier" pour chaque abonnement
        echo '<td>';
        echo '<form method="post" action="ajouter_panier.php">';
        // Ajouter un champ caché pour stocker l'ID de l'abonnement
        echo '<input type="hidden" name="id_abonnement" value="' . $abonnement->id_abonnement . '">';
        // Ajouter un bouton de soumission pour ajouter l'abonnement au panier
        echo '<input style="color: #F0F8FF;
	display:inline-block;
	text-decoration: none;
	font-size: 1.8rem;
	border: 1px solid #F0F8FF;
	color: #F0F8FF;
	padding:10px 20px;
	margin-right:20px;
	text-align: center;
	border-radius: 10px 100px / 120px;
	border-color: #0C0456;
	background-color: #0C0456;" type="submit" value="Ajouter au panier">';
        echo '</form>';
        echo '</td>';
    }
?>


		 </tr>

</table>
<!-- Fermeture de la table qui contient toutes les informatiosn relatives aux abonnements -->
	
	<br><br><br>
	
	<!-- Création des petits ppoints en bas des abonneme,ts où on retrouve des infromatiosn utiles-->
	<p>* Abonnement mensuel </p><br>
	<p>**Vous pouvez résilier à tout moment</p><br>
	<p>***Le premier mois est débité automatiqument après achat </p><br>
	<br><br>
	<br><br>
	<br>
	
	
	</section>
	
	<!-- Importation du pied de page -->
	<?php
	require('footer.html');
	?>

	</body>
</html>