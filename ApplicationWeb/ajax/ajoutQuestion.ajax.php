<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');


if(!isset($_SESSION)){
  session_start();
}

$db = new MyPDO();
$questionManager = new QuestionManager($db);

if(isset($_SESSION['tableauQuestionEnonce'])){
  unset($_SESSION['tableauQuestionEnonce']);
}

$tableauQuestions = json_decode($_POST['tableauQuestions']);

foreach ($tableauQuestions as $question) {
  $newQuestion = $questionManager->createQuestionDepuisTableau(array('libelle' => $question));

  if(!isset($_SESSION['tableauQuestionEnonce'])){
    $_SESSION['tableauQuestionEnonce'] = array(0 => serialize($newQuestion));
  } else {
    array_push($_SESSION['tableauQuestionEnonce'], serialize($newQuestion));
  }
}

?>
