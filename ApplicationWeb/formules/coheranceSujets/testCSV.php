<?php


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
