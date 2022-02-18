<?php 

$dsn = "mysql:host=localhost;dbname=formulaire;charset=utf8";
$user = "root";
$pass = "";

/**********************
HOTE_DE_VOTRE_SERVEUR : localhost ou ip de votre serveur
NOM_DE_VOTRE_BDD : Nom de votre base de données
LOGIN_CNX : Login de connexion à votre base de données
PASS_CNX : Mot de passe de connexion à votre base de données
**********************/

try {
	$cnx = new PDO($dsn, $user, $pass);
} catch(PDOException $e) {
	echo 'Erreur de cnx à la bdd';
}
