<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$donneeCalculeeManager = new DonneeCalculeeManager($db);

$listeDonneeCalcule = $donneeCalculeeManager->recupererDonneeCalculeeViaListeIdDonneeCalculee($_POST['listeIdTypeDonne']);

foreach ($listeDonneeCalcule as $donneeCalcule) {
  $donneeCalculeArray[] = array(
    'idType' => $donneeCalcule->getIdType(),
    'nomFormule' => $donneeCalcule->getNomFormule(),
    'tableauIdParams' => $donneeCalcule->getTableauIdParams()
  );
}

echo json_encode($donneeCalculeArray);
?>
