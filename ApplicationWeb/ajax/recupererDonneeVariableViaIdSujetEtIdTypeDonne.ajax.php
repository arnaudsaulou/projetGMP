<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$sujetPossibleManager = new SujetPossibleManager($db);

if(!isset($_SESSION)){
  session_start();
}

$listeDonneVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($_POST['idSujet']);

foreach ($listeDonneVariable as $donneVariable) {
  $donneeVaiable[] = array(
    'idType' => $donneVariable->getIdType(),
    'valeur' => $donneVariable->getValeur()
  );
}

echo json_encode($donneeVaiable);

?>
