<?php

	require('../include/config.inc.php');
	require('../include/autoLoad.inc.php');

	$db = new MyPDO;
	$typeDonneeManager = new TypeDonneeManager($db);

	//on récupère la liste des données variable de l'énoncé
	$listeTypeDonnee = $typeDonneeManager->getListOfTypeDonneeDeDonneesVariable();

	$listeParams = array();

	foreach ($listeTypeDonnee as $key => $typeDonnee) {
		$listeParams[] = array("idTypeDonnee" => $typeDonnee->getIdType(), "libelleTypeDonnee" => $typeDonnee->getLibelle());
	}

	echo json_encode($listeParams);

?>
