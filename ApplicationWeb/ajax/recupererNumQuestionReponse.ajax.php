<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$questionManager = new QuestionManager($db);

$numQR = $questionManager->recupererDernierIdQuestion();

echo json_encode($numQR);

?>
