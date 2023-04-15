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
        <div class="chat-messages"></div>
    </div>

    <div class="chatbot-icon">
        <img src="chatbotb.png" width="50px" height="50px" alt="Chatbot Icon" id="chatbot-icon">
    </div>

    <div class="chatbot-container hidden" id="chatbot-container">
        <form>
            <input type="text" id="question_2" name="question" placeholder="Posez votre question..." required>
            <button type="submit">Envoyer</button>
        </form>
        <div class="chat-messages"></div>
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

        $(document).ready(function() {
    $("form").on("submit", function(event) {
        event.preventDefault();
        var question = $("#question_2").val();
        var userMessage = '<div class="chat-message"><strong>Vous :</strong><p>' + question + '</p></div>';
        $(".chat-messages").append(userMessage);
        $("#question_2").val('');

        // start ajax code
        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text=' + question,
            success: function(result) {
                var botReply = '<div class="chat-message"><strong>Chatbot :</strong><p>' + result + '</p></div>';
                $(".chat-messages").append(botReply);
                $(".container .chat-messages").scrollTop($(".container .chat-messages")[0].scrollHeight);
            }
        });
    });
});
</script>
</body>
</html>