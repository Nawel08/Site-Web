<!-- Déclaration du type de document HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
 <!-- Définition de l'encodage des caractères -->
    <meta charset="UTF-8">
	<!-- Configuration de l'affichage pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Titre de la page -->
	<title>Contactez-nous</title>
	<!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="BD_Projet_Contact.css">
</head>
<body>
	<!-- En-tête de la page -->
<?php 
require_once('header.html');
?>
	<!-- Contenu principal de la page -->
    <main>
	<!-- Section du formulaire de contact -->
        <section class="contact-form">
		<br>
		<br>
            <h1 style="margin-left:-60px;margin-top:40px; font-size:80px;">Contactez-nous</h1>
			<br>
			<br>
			<br>
			
            <p>Si vous avez un problème ou une question, veuillez remplir le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
            <br>
			<br>
			<br>
			 <!-- Formulaire de contact -->
			<form action="send_contact.php" method="POST">
			 <!-- Champ pour le nom complet -->
                <div class="form-group">
                    <label for="name">Nom complet :</label>
                    <input style="height:40px;"  type="text" id="name" name="name" required>
                </div>
				 <!-- Champ pour l'adresse e-mail -->
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input style="height:40px;" type="email" id="email" name="email" required>
                </div>
				 <!-- Champ pour sélectionner le type de problème -->
                <div class="form-group">
                    <label for="problem">Problème :</label>
                    <select style="height:40px; font-size:18px;"  id="problem" name="problem" required>
                        <option style="height:40px; font-size:16px;" value="">Sélectionnez un problème</option>
                        <option style="height:40px; font-size:16px;"  value="technical">Problème technique</option>
                        <option style="height:40px; font-size:16px;"  value="content">Abonnement</option>
                        <option style="height:40px; font-size:16px;" value="account">Compte utilisateur</option>
                        <option style="height:40px; font-size:16px;" value="other">Autre</option>
                    </select>
                </div>
				<!-- Champ pour entrer le message -->
                <div class="form-group">
                    <label for="message">Message (200 caractères max) :</label>
                    <textarea id="message" name="message" maxlength="200" style="font-size:16px;" required></textarea>
                </div>
				<!-- Bouton pour soumettre le formulaire -->
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>
	<!-- Saut de lignes pour aérer -->
	
	
	<!-- Pied de page de la page -->
 <?php 
 require_once('footer.html');
 ?>
	<!-- Fermeture du body et du document html. -->
</body>
</html>
