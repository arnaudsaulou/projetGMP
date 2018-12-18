<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$donneeVariableManager = new DonneeVariableManager($db);

if(!isset($_SESSION)){
  session_start();
}

$listeDonneeVariable = $donneeVariableManager->genererListeDonneeVariableViaInterval($_POST);

foreach ($listeDonneeVariable as $newDonneeVariable) {
  $donneeVariableManager->ajouterDonneeVariable($newDonneeVariable);
}

?>
