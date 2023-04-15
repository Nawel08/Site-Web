<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N&T SCHOOL</title>
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require_once('header_pasco.html'); ?>

    <section class="text">
        <h1> Celui qui ouvre une porte d'école, ferme une prison </h1>
        <i>~Victor Hugo</i>
        <br><br><br>
        <p> Oyez, Oyez, lycéens et collégiens, Bienvenue chez nous !
            En ligne depuis peu, nous venons de créer LA plateforme qu'il te faut.
            En effet, si tu as des difficultés, des absences accentuées ou encore que tu n'es pas aisé voici
            créer pour toi, un site qui va te permettre d'avoir d'exellentes notes sans te déplacer et à coût remarquable.
        </p>
        <br>
        <a href="Lesabonnements.php">Nos abonnements</a><a href="apercu_gratuit.php"> Aperçu gratuit </a>
    </section>

    <div class="fonddumain"></div>

    <div class="container">
        
        <div class="chat-messages">
            <?php if (isset($_GET['reponse'])): ?>
                <div class="chat-message">
                    <strong>Vous :</strong>
                    <p><?= htmlspecialchars($_GET['question']) ?></p>
                </div>
                <div class="chat-message">
                    <strong>Chatbot :</strong>
                    <p><?= htmlspecialchars($_GET['reponse']) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="chatbot-icon">
    <img src="chatbotb.png" width="50px" height="50px" alt="Chatbot Icon" id="chatbot-icon">
</div>


    <div class="chatbot-container" id="chatbot-container">

        <form action="acceuil.php" method="post">
            <input type="text" id="question_2" name="question" placeholder="Posez votre question..." required>
            <button type="submit">Envoyer</button>
        </form>

        <div class="chat-messages">
            <?php
            if (isset($_POST['question'])) {
                $question = strtolower(trim($_POST['question']));
                $reponse = '';

                $keywords = [
    'bonjour' => ['Bonjour ! Comment allez-vous ?', 'Bonjour ! Que puis-je faire pour vous ?'],
    'ça va' => ['Très bien, merci ! Et vous ?', 'Ça va bien, et vous ?'],
    'aide' => ['Bien sûr, comment puis-je vous aider ?', 'Je suis là pour vous aider, de quoi avez-vous besoin ?'],
    'études' => ['Nous proposons des cours en ligne pour les étudiants de tous les niveaux. Découvrez nos offres sur la page "Nos abonnements" !', 'Avec N&T School, vous pouvez étudier depuis chez vous avec des cours en ligne de qualité.'],
    'tarifs' => ['Nos prix dépendent du type d\'abonnement que vous choisissez. Rendez-vous sur la page "Nos abonnements" pour découvrir nos offres !', 'Les prix de nos abonnements varient en fonction de la durée et du niveau d\'études.'],
    'connexion' => ['Pour vous connecter, rendez-vous sur la page "Connexion" et entrez vos identifiants.', 'Vous pouvez accéder à votre compte en vous connectant sur la page "Connexion".'],
];

$question = strtolower($question);

foreach ($keywords as $keyword => $responses) {
    foreach ($responses as $response) {
        if (strpos($question, $keyword) !== false) {
            $reponse = $response;
            break 2;
        }
    }
}

if ($reponse == '') {
    $reponse = 'Désolé, je ne comprends pas votre question. Pouvez-vous reformuler s\'il vous plaît ?';
	}
			}
?>

<div class="chat-messages">
    <?php if (isset($_POST['question'])): ?>
        <div class="chat-message">
            <strong>Vous :</strong>
            <p><?= htmlspecialchars($question) ?></p>
        </div>
        <div class="chat-message">
            <strong>Chatbot :</strong>
            <p><?= htmlspecialchars($reponse) ?></p>
        </div>
    <?php endif; ?>
</div>
<script>

    function toggleChatbot() {
        var chatbotIcon = document.getElementById('chatbot-icon');
        var chatbotContainer = document.getElementById('chatbot-container');
        
        chatbotContainer.classList.toggle('hidden');
    }
	document.getElementById('chatbot-icon').addEventListener('click', toggleChatbot);


    document.addEventListener('DOMContentLoaded', function() {
    var chatbotContainer = document.getElementById('chatbot-container');
    chatbotContainer.classList.add('hidden');
});

</script>



</body>
</html>