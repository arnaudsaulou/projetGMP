<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

if(!isset($_SESSION)){
  session_start();
}

$db = new MyPDO();
$questionManager = new QuestionManager($db);

$newQuestion = $questionManager->createQuestionDepuisTableau(array('libelle' => $_POST['libelle']));

if(!isset($_SESSION['tableauQuestionEnonce'])){
  $_SESSION['tableauQuestionEnonce'] = array(0 => serialize($newQuestion));
} else {
  array_push($_SESSION['tableauQuestionEnonce'], serialize($newQuestion));
}

// if(!isset($_SESSION['tableauQuestionEnonce'])){
//   $_SESSION['tableauQuestionEnonce'] = array(0 => $newQuestion);
// } else {
//   array_push($_SESSION['tableauQuestionEnonce'], $newQuestion);
// }

var_dump($_SESSION['tableauQuestionEnonce']);

?>
