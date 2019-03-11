<?php
$ligne = 0; // compteur de ligne
$fic = fopen("test.csv", "a+");
$superTab = array();
while($tab = fgetcsv($fic,0,';')){
  $champs = count($tab);//nombre de champ dans la ligne en question

  if($ligne == 0){
    $ligne ++;
  } else {
    //affichage de chaque champ de la ligne en question
    $superTab[] = $tab;
    $ligne ++;
  }
}

var_dump($superTab);

$testArray = [5,4,9];
$containsAllValues = false;
$i = 0;

while ($i < count($superTab) && !$containsAllValues) {
  $containsAllValues = !array_diff($testArray, $superTab[$i]);
  $i++;
}

if($containsAllValues){
  echo "invalid";
} else {
  echo "ok";
}

?>
