<?php

$ligneExploded = array();
$listIdTypesDonnees = array();

$ligneExploded = explode("##", $newEnonce->getEnonce());

for ($i = 1; $i < count($ligneExploded); $i = $i + 2) {
    $listIdTypesDonnees[] = $ligneExploded[$i];
}


if(isset($_POST["pasBesoinCoheranceSujet"]) && $_POST["pasBesoinCoheranceSujet"] == "on"){
  $sujetManager->generateSujet($listIdTypesDonnees,$_POST["coheranceSujet"]);
} else {
  $sujetManager->generateSujet($listIdTypesDonnees,null);
}
