<?php

require "../classes/MyPDO.class.php";
require "../classes/TypeDonneeManager.class.php";

$db = new MyPDO;
$typeDonneeManager = new TypeDonneeManager($db);
$newTypeDonnee = $typeDonneeManager->createTypeDonneeDepuisTableau(array('libelle' => $_POST['newTypeDonnee']));
$typeDonneeManager->ajouterTypeDonne($newTypeDonnee);

?>
