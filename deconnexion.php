 <?php
 session_start(); //on ouvre la session
 $_SESSION=array(); //on la met dans un tableau
 session_destroy(); //on détruit la session
 header("Location: login.php"); //on redirige l'utilisateur vers login.php pour qu'il se reconnecte
 ?>
 
