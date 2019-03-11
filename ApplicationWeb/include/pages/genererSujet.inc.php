<?php

$ligneExploded = array();
$listIdTypesDonnees = array();

$ligneExploded = explode("##", $newEnonce->getEnonce());

for ($i = 1; $i < count($ligneExploded); $i = $i + 2) {
    $listIdTypesDonnees[] = $ligneExploded[$i];
}

$sujetManager->generateSujet($listIdTypesDonnees,$_POST["coheranceSujet"]);
