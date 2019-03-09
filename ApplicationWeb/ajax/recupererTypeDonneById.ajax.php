<?php

require('../include/config.inc.php');
require('../include/autoLoad.inc.php');

$db = new MyPDO;
$typeDonneeManager = new TypeDonneeManager($db);

$typeDonnee = $typeDonneeManager->getTypeDonneeById($_POST['idType']);

$typeDonnee = array(
  'idType' => $typeDonnee->getIdType(),
  'libelle' => $typeDonnee->getLibelle()
);

echo json_encode($typeDonnee);

?>
