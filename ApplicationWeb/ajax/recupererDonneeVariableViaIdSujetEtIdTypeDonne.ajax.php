<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$sujetPossibleManager = new SujetPossibleManager($db);

if(!isset($_SESSION)){
  session_start();
}

$listeIdTypeDonnee = $_POST['listeIdTypeDonne'];
$listeValeur = $sujetPossibleManager->recuperListeValeurDonneeVariableViaIdSujet($listeIdTypeDonnee, $_POST['idSujet']);

echo json_encode($listeValeur);

?>
