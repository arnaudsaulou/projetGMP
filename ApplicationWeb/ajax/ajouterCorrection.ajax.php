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
		'tableauIdParams' => $tableauIdParams,
		'bareme' => $_POST['bareme']
	);

	//Récupéré la solution existente si présente
	$oldSolution = $solutionManager->recupererSolution($_POST['idQuestion']);
	if($oldSolution != null){
		$solutionManager->supprimerSolutionViaIdQuestion($_POST['idQuestion']);
	}

	//Création d'un objet Solution
	$solution = $solutionManager->createSolutionDepuisTableau($solutionTab);

	//Ajout de la règle de correction à la BD
	$query = $solutionManager->ajouterSolution($solution);

	if($query){
    $response_array['status'] = 'success';
	}else {
	    $response_array['status'] = 'error';
	}

	echo json_encode($response_array);

?>
