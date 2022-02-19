<?php

require_once 'cnx.php';

$date = date('Y-m-d');
$controle_presence = 0;
$controle_filtre = 0;

$response = [
    "REPONSE" => '',
    "CODE_ERR" => '',
    "MESS_ERR" => '',
    "CODE_SQL" => '',
];

$liste_erreurs = [];

// Création de filtre qui vérifie les données envoyés par l'utilisateur

$filtres = [
    'prenom' => FILTER_SANITIZE_STRING,
    'nom' => FILTER_SANITIZE_STRING,
    'mail' => FILTER_VALIDATE_EMAIL
];

$resultat = filter_input_array(INPUT_POST, $filtres);

foreach ($filtres as $key => $value) {
    if (empty($_POST[$key])) {
        $response['REPONSE'] = 'KO';
        $liste_erreurs[] = "$key est vide.";
        $controle_presence++;
    } elseif ($resultat[$key] === false) {
        $response['REPONSE'] = 'KO';
        $liste_erreurs[] = "$key est non valide.";
        $controle_filtre++;
    }
}

if (($controle_filtre === 0) && ($controle_presence === 0)) {
    // Ecriture de la requête SQL

    $sql = "INSERT INTO `client`(`prenom_client`, `nom_client`, `email_client`, `dateInscription`) 
        VALUES (:prenom, :nom, :mail, '$date')";

    // Préparation de la requête SQL

    $rs_insert = $cnx->prepare($sql);

    $rs_insert->bindValue(':prenom', trim($resultat['prenom']), PDO::PARAM_STR);
    $rs_insert->bindValue(':nom', trim($resultat['nom']), PDO::PARAM_STR);
    $rs_insert->bindValue(':mail', trim($resultat['mail']), PDO::PARAM_STR);

    $rs_insert->execute();

    // Vérification de la présence d'une erreur dans le retour de la requête SQL

    if ($rs_insert) {
        $response['REPONSE'] = 'OK';
        $response['MESSAGE'] = "{$resultat['prenom']} {$resultat['nom']} à bien été ajouté.";
    } else {
        $response['REPONSE'] = 'KO';
        $error = $cnx->errorInfo();
        $liste_erreurs[] = $error[2];
    }
}

$response['MESS_ERR'] = $liste_erreurs;

echo json_encode($response);

?>