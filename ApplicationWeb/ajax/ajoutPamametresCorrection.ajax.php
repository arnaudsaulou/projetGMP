<?php

	require('../include/config.inc.php');
	require('../include/autoLoad.inc.php');

	$db = new MyPDO;
	$enonceManager = new EnonceManager($db);
	$typeDonneeManager = new TypeDonneeManager($db);

if(!empty($_POST['idEnonce'])){
	//on récupère la liste des données variable de l'énoncé

	$listeTypeDonnee = $enonceManager->getTypeDonneVariablePresentDansEnonce($_POST['idEnonce']);

	$listeParams = array();

	foreach ($listeTypeDonnee as $key => $typeDonnee) {
		$listeParams[] = array("idType" => $typeDonnee->getIdType(), "libelle" => $typeDonnee->getLibelle());
	}

} else {
	$listeParams = "error";
}

echo json_encode($listeParams);

?>
