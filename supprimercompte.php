<?php
session_start(); //on démarre la session
$DB= new PDO('mysql:host=127.0.0.1;dbname=siteweb','root',''); //connexion à la base de donnée
if(isset($_SESSION['mail'])){//si ma variable de session mail existe
$getmail=htmlspecialchars($_SESSION['mail']);
$requser=$DB->prepare('DELETE FROM utilisateur WHERE mail=?');
$requser->execute(array($getmail)); //execution de la requete avec notre getid on r id que celui du login

if ($requser->rowCount()>0){
	header('Location:BD_Projet_Inscription.php');
}
else{
	echo("erreur de suppression");
	
}}
