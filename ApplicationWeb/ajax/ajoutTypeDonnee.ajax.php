<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

if(!isset($_SESSION)){
  session_start();
}

$db = new MyPDO;
$typeDonneeManager = new TypeDonneeManager($db);
$newTypeDonnee = $typeDonneeManager->createTypeDonneeDepuisTableau(array('libelle' => $_POST['newTypeDonnee']));
$ajout = $typeDonneeManager->ajouterTypeDonne($newTypeDonnee);

echo json_encode($ajout);

?>
