<?php

require_once "cnx.php";

$sql = "SELECT `id_interv`, `prenom_interv`, `qualification_interv` FROM `intervenants` ORDER BY `qualification_interv`";

$html = "<label for='intervenant'>Intervenant</label><br>";

foreach ($cnx->query($sql) as $row) {
    $id = $row['id_interv'];
    $prenom = $row['prenom_interv'];
    $qualification_interv = $row['qualification_interv'];
    $html .= "<div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' name='inlineRadioOptions' id='$id' value='$id'> $prenom - $qualification_interv</input>
</div><br>";
}

echo $html;
