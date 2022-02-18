<?php

require_once "cnx.php";

$select = [];
$select['REPONSE'] = '';
$select['CODE_ERR'] = '';
$select['MESS_ERR'] = '';
$select['CODE_SQL'] = '';

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];

$sql = "UPDATE `client` SET `nom_client`= :nom,`prenom_client`=:prenom ,`email_client`= :email WHERE `id_client` = :id";

$stmt = $cnx->prepare($sql);
$stmt->execute(array(':id' => $id,':nom' => $nom, ':prenom' => $prenom, ':email' => $email));

$select['REPONSE'] = 'OK';


echo json_encode($select);