<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$donneeCalculeeManager = new DonneeCalculeeManager($db);
$typeDonneeManager = new TypeDonneeManager($db);

$newTypeDonnee = $typeDonneeManager->createTypeDonneeDepuisTableau(array('libelle' => $_POST['libelleDonneeCalculee']));
$typeDonneeManager->ajouterTypeDonne($newTypeDonnee);

$tableauIdParams = json_encode($_POST['tableauIdParams']);

//Nettoyage du tableau JSON
$tableauIdParams = str_replace('[', '', $tableauIdParams);
$tableauIdParams = str_replace(']', '', $tableauIdParams);
$tableauIdParams = str_replace('"', '', $tableauIdParams);

//Création d'un tableau de la structure DonneeCalculee
$donneeCalculeTab = array(
  'idType' => $_SESSION['newIdTypeDonne'],
  'nomFormule' => $_POST['nomFormuleCalcul'],
  'tableauIdParams' => $tableauIdParams
);

$newDonneeCalculee = $donneeCalculeeManager->createDonneeCalculeeDepuisTableau($donneeCalculeTab);
$donneeCalculeeManager->ajouterDonneeCalculee($newDonneeCalculee);

?>
