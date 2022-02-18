<?php

require_once "cnx.php";

$sql ="SELECT `id_client`, `nom_client`, `prenom_client`, `email_client`, `dateInscription` FROM `client`";

$html = "<option value='0'>-- Choisir un n° de client --</option>";

foreach ($cnx->query($sql) as $row) {
    $id = $row['id_client'];
    $nom = $row['nom_client'];
    $prenom = $row['prenom_client'];
    $html.= "<option value='$id'>$id - $nom $prenom</option>";
}

echo $html;