<?php

$fichierEnonce = fopen("enonce.txt",'r');

$ligneExploded = array();
$listIdTypesDonnees= array();

while(!feof($fichierEnonce)){

  $ligne = fgets($fichierEnonce);

  $ligneExploded = explode("##", $ligne);

  for($i = 1; $i < count($ligneExploded); $i = $i + 2){
    $listIdTypesDonnees[] = $ligneExploded[$i];
  }
}


$sujetManager->generateSujet($listIdTypesDonnees);

fclose($fichierEnonce);

?>
