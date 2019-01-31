<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$reponseManager = new ReponseManager($db);

$nombreDeRep = $reponseManager->getNbReponses(13);

echo json_encode($nombreDeRep);

?>
