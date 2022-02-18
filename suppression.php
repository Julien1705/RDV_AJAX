<?php

require_once "cnx.php";

$select = [];
$select['REPONSE'] = '';
$select['CODE_ERR'] = '';
$select['MESS_ERR'] = '';
$select['CODE_SQL'] = '';

$id = $_POST['id'];

$sql = "DELETE FROM `client` 
        WHERE `id_client` = :id";

$stmt = $cnx->prepare($sql);
$stmt->execute(array(':id' => $id));

$select['REPONSE'] = 'OK';


echo json_encode($select);