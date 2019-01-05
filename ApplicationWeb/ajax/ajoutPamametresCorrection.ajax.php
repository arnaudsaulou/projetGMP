<?php 

	require('../include/config.inc.php');
	require('../include/autoLoad.inc.php');

	$db = new MyPDO;
	$typeDonneeManager = new TypeDonneeManager($db);

	//on récupère la liste des données variable de l'énoncé
	$listeTypeDonnee = $typeDonneeManager->getTypeDonnee();
	
	echo "<td>";
		echo '<select name="param1">';
			foreach ($listeTypeDonnee as $key => $typeDonnee) {
				echo "<option value=".$typeDonnee->getIdType().">".$typeDonnee->getLibelle()."</option>";
			}
		echo "</select>";
	echo "</td>";

?>