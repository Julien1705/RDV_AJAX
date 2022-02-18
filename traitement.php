<?php
require_once "cnx.php";

$select = [];
$select['REPONSE'] = '';
$select['CODE_ERR'] = '';
$select['MESS_ERR'] = '';
$select['CODE_SQL'] = '';

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$mail = $_POST["mail"];
$date = date('Y-m-d');

$sql = "INSERT INTO `client`(`nom_client`, `prenom_client`, `email_client`, `dateInscription`) VALUES ('$nom','$prenom','$mail','$date')";

$rs_insert  = $cnx->exec($sql);

$select['REPONSE'] = 'OK';
$select['nom'] = $nom;
$select['prenom'] = $prenom;

echo json_encode($select);

?>