<?php

	require('../include/config.inc.php');
	require('../include/autoLoad.inc.php');

	$db = new MyPDO;
	$solutionManager = new SolutionManager($db);

	$tableauIdParams = json_encode($_POST['tableauIdParams']);

	//Nettoyage du tableau JSON
	$tableauIdParams = str_replace('[', '', $tableauIdParams);
	$tableauIdParams = str_replace(']', '', $tableauIdParams);
	$tableauIdParams = str_replace('"', '', $tableauIdParams);

	//Création d'un tableau de la structure Solution
	$solutionTab = array(
		'idQuestion' => $_POST['idQuestion'],
		'nomFormule' => $_POST['nomFormule'],
		'tableauIdParams' => $tableauIdParams
	);

	//Création d'un objet Solution
	$solution = $solutionManager->createSolutionDepuisTableau($solutionTab);

	//Ajout de la règle de correction à la BD
	$solutionManager = $solutionManager->ajouterSolution($solution);

?>
