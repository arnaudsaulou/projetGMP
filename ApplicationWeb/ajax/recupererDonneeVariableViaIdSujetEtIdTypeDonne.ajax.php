<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$sujetPossibleManager = new SujetPossibleManager($db);

if(!isset($_SESSION)){
  session_start();
}

$listeValeur = $sujetPossibleManager->recuperListeValeurDonneeVariableViaIdSujet(
                                                                                  $_POST['listeIdTypeDonne'],
                                                                                  $_POST['idSujet']
                                                                                 );

echo json_encode($listeValeur);

?>
