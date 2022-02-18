<?php
require_once "cnx.php";

$select = [];
$select['REPONSE'] = '';
$select['CODE_ERR'] = '';
$select['MESS_ERR'] = '';
$select['CODE_SQL'] = '';

$date_rdv = $_POST["date_rdv"];
$heure_debut_rdv = $_POST["heure_debut_rdv"];
$heure_fin_rdv = $_POST["heure_fin_rdv"];
$id_client = $_POST["id_client"];
$nro_intervenant = $_POST["nro_intervenant"];

$sql = "INSERT INTO `rendez-vous`(`date_rdv`, `heure_debut_rdv`, `heure_fin_rdv`, `id_interv`, `id_client`) VALUES ('$date_rdv','$heure_debut_rdv','$heure_fin_rdv','$nro_intervenant','$id_client')";

$rs_insert  = $cnx->exec($sql);

$select['REPONSE'] = 'OK';


echo json_encode($select);

?>