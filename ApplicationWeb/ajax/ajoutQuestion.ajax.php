<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$questionManager = new QuestionManager($db);

$newQuestion = $questionManager->createQuestionDepuisTableau(array('libelle' => $_POST['libelle']));

$questionManager->ajouterQuestion($newQuestion);

?>
