<?php

require_once "cnx.php";

$select = [];
$select['REPONSE'] = '';
$select['CODE_ERR'] = '';
$select['MESS_ERR'] = '';
$select['CODE_SQL'] = '';

$id = $_POST['id'];

$sql = "SELECT `id_client`, `nom_client`, `prenom_client`, `email_client`, `dateInscription` 
        FROM `client`
        WHERE `id_client` = :id";

$stmt = $cnx->prepare($sql);
$stmt->execute(array(':id' => $id));
$row = $stmt->fetch();

$select['REPONSE'] = 'OK';
$select['nom'] = $row['nom_client'];
$select['prenom'] = $row['prenom_client'];
$select['email'] = $row['email_client'];

echo json_encode($select);