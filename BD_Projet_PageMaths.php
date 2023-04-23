<!-- BEN OMRANE et ZAIT-->

<!--Ouverture de notre fichier HTML où on retrouve un aperçu de nos pages sur les mathématiques. -->
<!DOCTYPE html>
<!--Initalisation de la langue en français. -->
<html lang="fr">

<head>
    <!-- Définition de l'encodage de la page -->
    <meta charset="UTF-8">
    <!-- Lien vers le fichier CSS de la page -->
    <link rel="stylesheet" href="BD_Projet_Contact.css">
    <!-- Titre de la page -->
    <title> NT School | Théorème de Pythagore et sa réciproque </title>
</head>
<body>
    <!-- Inclusion d'un fichier HTML (header_pasco.html) dans cette page -->
    <?php
        include_once('header_pasco.html');
    ?>
    <!-- sauts de ligne -->
    <br>
    <br>
    <br>
    <!-- Titre principal -->
    <h1 style="margin-left:80px; font-size:38px;">| Théorème de Pythagore et sa récirpoque </h1>
    <!-- Section pour les notions fondamentales -->
    <section class="notions_fonda">
    </section>
    <!-- sauts de ligne -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Section pour la fiche de cours -->
    <section class="fiche_cours">
        <!-- Titre pour la fiche de cours -->
        <h2 style=" font-size:30px; margin-left: 150px;"> Fiche de cours </h2>
        <!--  sauts de ligne -->
        <br>
        <br>
        <!-- Description de la fiche de cours -->
        <p  style="margin-left: 150px; font-size:20px;" class="descr"> Cette fiche de cours résume toutes les <b> notions cléfs </b> de ce chapitre.</p>
        <!--  sauts de ligne -->
        <br>
        <br>
        <br>
        <!-- Image de la fiche de cours -->
        <img src="fiche_pytha_page-0001.jpg" alt="Page 1 du PDF"
        width=800px height=580px 
        style="margin-left: 150px;"
        >
    </section>
    <!--  sauts de ligne -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Section pour la vidéo -->
    <section class="video">
        <!-- Titre pour la vidéo -->
        <h2 style="font-size:30px; margin-left: 150px;"> Vidéo d'explication </h2>
        <!--  sauts de ligne -->
        <br>
        <br>
        <br>
        <br>
        <!-- Description de la vidéo -->
        <p style="margin-left: 150px; font-size:20px;" class="descr"> Cette courte vidéo résume globalement le chapitre, ce qui est idéale si tu as plus une mémoire auditive.</p>
        <!--  sauts de ligne -->
        <br>
        <br>
        <!-- Insertion de la vidéo -->
        <iframe width=600 height=340 style=" margin-left:150px;" src="https://www.youtube.com/embed/vpZGqEGfDbA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
		</section>
		<br>
		<br>
		<br>
		<br>
		<!-- Ouverture de la classe où on retrouve l'exercice qui permet de se tester-->
		<section class="exercice">
		<!-- Titre de cet exercice -->
		<h2 style="font-size:30px; margin-left: 150px;"> Exercice pour se tester</h2>
		<br>
		<br>
		<br>
		
		
		<br>
		<br>
		<br>
		<!--Utilisation de la balise fieldset pour encadrer notre enoncé -->
		<fieldset>
		<br>
		<br>
		<!-- Dans les balises p on retrouve l'énoncé de notre exercice.-->
		<p style="margin-left: 150px; font-size:20px;" > Soit IYS un triangle rectalnge en Y tel que:</p>
		<br>
		<p style="margin-left: 150px; font-size:20px;" >SI=13,5cm et SY= 10,8cm</p>
		<br>
		<p style="margin-left: 150px; font-size:20px;">Calculer la longueur IY.</p>
		<br>
		<br>
		<!-- fermeture du cadre pour notre énoncé-->
		</fieldset>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p style="margin-left: 150px; font-size:20px;">Tu peux entrer ta réponse ci-dessous:</p>
		<br>
		<br>
		<br>
		<br>
		<!--Utilisation de la balise textarea pour que l'étudiant ai un espace sufisant pour écrire sa réponse ou son raisonnement. -->
		<textarea id="myTextarea" ></textarea>
		<br>
		<br>
		<!-- Utilisation d'un canvas afin que l'étudiant puisse desinner, faire un brouillon.-->
		  <canvas id="myCanvas" width="700" height="350"></canvas>
		  <!-- Insertion d'une image de gomme, qui permet d'effacer si on clique dessus le contenu du canvas-->
		  <img id="clearButton" src="gomme.png">
		  <!-- Boutton qui permet de dessiner-->
		  <button id="drawButton">Start/Stop Dessin</button>
		  
		  <!-- Script JavaScript permettant la bonne utilisation du canvas:-->
		  <script>
// Récupération de la balise canvas
const canvas = document.getElementById("myCanvas");
// Récupération du contexte de dessin
const context = canvas.getContext("2d");
// Récupération de la balise textarea
const textarea = document.getElementById("myTextarea");
// Récupération du bouton "Dessiner"
const drawButton = document.getElementById("drawButton");
// Récupération du bouton "Effacer"
const clearButton = document.getElementById("clearButton");

// Initialisation des variables
let isDrawing = false;
let lastX = 0;
let lastY = 0;

// Définition de la couleur de la ligne
context.strokeStyle = "white";
// Définition de l'épaisseur de la ligne
context.lineWidth = 5;

// Ajout d'un événement pour le bouton "Dessiner"
drawButton.addEventListener("click", function() {
  // Inversion de la variable isDrawing
  isDrawing = !isDrawing;
  // Changement du texte du bouton selon l'état de isDrawing
  if (isDrawing) {
    drawButton.textContent = "Stop Drawing";
  } else {
    drawButton.textContent = "Start Drawing";
  }
});

// Ajout d'un événement pour le bouton "Effacer"
clearButton.addEventListener("click", function() {
  // Effacement complet du canvas
  context.clearRect(0, 0, canvas.width, canvas.height);
});

// Ajout d'un événement pour le clic de la souris
canvas.addEventListener('mousedown', (event) => {
  // Si on est en train de dessiner
  if (isDrawing) {
    // Mise à jour des variables lastX et lastY
    lastX = event.pageX - canvas.offsetLeft;
    lastY = event.pageY - canvas.offsetTop;
  }
});

// Ajout d'un événement pour le mouvement de la souris
canvas.addEventListener('mousemove', (event) => {
  // Si on est en train de dessiner
  if (isDrawing) {
    // Récupération des coordonnées actuelles de la souris
    const currentX = event.pageX - canvas.offsetLeft;
    const currentY = event.pageY - canvas.offsetTop;
    // Définition du début du tracé
    context.beginPath();
    // Déplacement du tracé jusqu'à lastX, lastY
    context.moveTo(lastX, lastY);
    // Tracé d'une ligne jusqu'aux coordonnées actuelles
    context.lineTo(currentX, currentY);
    // Dessin de la ligne
    context.stroke();
    // Mise à jour des variables lastX et lastY
    lastX = currentX;
    lastY = currentY;
  }
});

// Ajout d'un événement pour le relâchement de la souris
canvas.addEventListener('mouseup', () => {
  // Arrêt du dessin
  isDrawing = false;
});


</script>
<!-- Fermeture du script JavaScript -->

		<br>
		<br>
		<br>
		<br>
		<!-- Le formulaire suivant permet à l'étudiant qui souhaite voir la correction d'être dirigé vers une page inscription-->
		<form action="BD_Projet_Inscription.php">
		<button style="margin-left:600px;" width=100px> Voir la correction</button>
		</form>
		</section>
		
		<br>
		<br>
<!-- Insertion du pied de page -->
<?php
	include_once('footer.html');
?>
	</body>

</html>
<!-- Fermeture du body, puis du fichier html -->