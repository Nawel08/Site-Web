<!-- BEN OMRANE et ZAIT-->
<!DOCTYPE html>
<html lang="fr">
<!-- head de notre fichier où on retrouve tous les liens relatifs à son bon fonctionnement-->
<head>
    <meta charset="UTF-8">
	<!-- Permet de définir la largeur de l'affichage en fonction de la largeur de l'appareil utilisé-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Permet définir le niveau de zoom initial. -->
	<!-- titre de la page-->
    <title>N&T SCHOOL</title>
	<!-- liens vers les pages css contenant le style de la page-->
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Suite à quelques problèmes que nous avons rencontrés avec nos fichiers css, nous avons du inclure certaines lignes directement dans le html, 
	pour que cela fonctionne bien.
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
<!-- Fermeture de la balise style et de la balise head-->

<!-- Ouverture du body.-->
<body>

<!-- On commence par mettre la div en lien avec le code promo-->
<div class="promo-banner">
        <span class="promo-text">Obtenez 20% de réduction sur l'abonnement SuperStrong avec le code promo: <b>BIENVENU20</b></span>
    </div>
	
	<!-- Grâce à un code php  on fait appel à notre header_pasco.html-->
    <?php require_once('header_pasco.html'); ?>

	<!-- Ouverture de la section contenant le texte de la page-->
    <section class="text">
	<!--Citation en guise de titre -->
        <h1> Celui qui ouvre une porte d'école, ferme une prison </h1>
        <i>~Victor Hugo</i>
        <br><br><br>
        <p> Oyez, Oyez, lycéens et collégiens, Bienvenue chez nous !
            En ligne depuis peu, nous venons de créer LA plateforme qu'il te faut.
            En effet, si tu as des difficultés, des absences accentuées ou encore que tu n'es pas aisé voici
            créer pour toi, un site qui va te permettre d'avoir d'exellentes notes sans te déplacer et à coût remarquable.
        </p>
        <br>
		<!--Lien vers notre page abonnement à l'aide de la balise a -->
        <a href="Lesabonnements.php">Nos abonnements</a><a href="apercu_gratuit.php"> Aperçu gratuit </a>
    </section>
	<!-- fermeture de la section-->

	<!--div permettant d'inclure le fond -->
    <div class="fonddumain"></div>

    <!-- div relative à notre chatbot-->
    <div class="chatbot-icon">
	<!--importation de l'image grâce à l'attribut src de la balise img -->
        <img src="chatbotb.png" width="50px" height="50px" alt="Chatbot Icon" id="chatbot-icon">
    </div>
	
	<!-- div relative a forme du chatbot-->
    <div class="chatbot-container hidden" id="chatbot-container">
        <form>
		<!-- formulaire permettant de soumettre une question au chatbot-->
            <input type="text" id="question_2" name="question" placeholder="Posez votre question..." required>
            <button type="submit">Envoyer</button>
        </form>
		<!--Div permettant au chatbot de répondre -->
        <div class="chat-messages"></div>
    </div>

	<!-- Ouverture du script JavaScript permettant le bon fonctionnement du chatbot.-->
    <script>
function toggleChatbot() {
  // Récupérer l'élément HTML de l'icône chatbot
  var chatbotIcon = document.getElementById('chatbot-icon');
  // Récupérer l'élément HTML du conteneur chatbot
  var chatbotContainer = document.getElementById('chatbot-container');
  
  // Ajouter ou supprimer la classe 'hidden' du conteneur chatbot pour afficher ou cacher le chatbot
  chatbotContainer.classList.toggle('hidden');
}

// Ajouter un écouteur d'événements sur l'icône chatbot pour activer la fonction toggleChatbot lorsqu'elle est cliquée
document.getElementById('chatbot-icon').addEventListener('click', toggleChatbot);


// Attendre que le document soit prêt avant de commencer
$(document).ready(function() {
  // Ajouter un écouteur d'événements sur le formulaire de chatbot pour intercepter la soumission
  $("form").on("submit", function(event) {
    // Empêcher la soumission du formulaire
    event.preventDefault();
    
    // Récupérer la question saisie par l'utilisateur
    var question = $("#question_2").val();
    
    // Ajouter la question de l'utilisateur à la liste des messages de chat
    var userMessage = '<div class="chat-message user"><p class="user-label"">Vous :</p><p>' + question + '</p></div>';
    $(".chat-messages").append(userMessage);
    
    // Effacer la zone de saisie de la question de l'utilisateur
    $("#question_2").val('');

    // Commencer la requête AJAX pour envoyer la question de l'utilisateur au serveur
    $.ajax({
      url: 'message.php', // Définir l'URL du script PHP qui traite la question
      type: 'POST', // Utiliser la méthode POST
      data: 'text=' + question, // Ajouter la question de l'utilisateur en tant que paramètre POST 'text'
      success: function(result) {
        // Ajouter la réponse du chatbot à la liste des messages de chat
        var botReply = '<div class="chat-message bot"><p class="bot-label">Chatbot :</p><p>' + result + '</p></div>';
        $(".chat-messages").append(botReply);
        
        // Faire défiler la zone des messages de chat vers le bas pour voir la dernière réponse
        $(".container .chat-messages").scrollTop($(".container .chat-messages")[0].scrollHeight);
      }
    });
  });
});

</script>

<!-- Fermeture du script JavaScript relatif au chatbot-->

<!-- -Utilisation du code php et de la fonction require_once pour importer notre fihier footer.html où se trouve notre pied de page. -->
<?php 
require_once('footer.html');
?>

<!-- Fermeture du body et du fichier html-->
</body>
</html>
