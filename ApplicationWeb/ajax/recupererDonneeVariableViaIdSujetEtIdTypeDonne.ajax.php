<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$sujetPossibleManager = new SujetPossibleManager($db);

if(!isset($_SESSION)){
  session_start();
}

$listeValeur = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($_POST['idSujet']);
$donneeVaiable = array();

foreach ($listeValeur as $valeur) {
  $donneeVaiable[] = $valeur->getValeur();
}

echo json_encode($donneeVaiable);

?>
