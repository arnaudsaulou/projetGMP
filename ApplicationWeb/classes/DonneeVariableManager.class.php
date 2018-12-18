<?php
class DonneeVariableManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet DonneeVariable à partir d'un tableau
	public function createDonneeVariableDepuisTableau($paramsDonneeVariable){
		return new DonneeVariable($paramsDonneeVariable);
	}

	public function getListOfDonneesVariableByIdTypeDonnee($idTypeDonnee){
		if(!empty($idTypeDonnee)){

			$listDonneeVariable = array();

      $req = $this->db->prepare(
        "SELECT * FROM donnees_variable WHERE idType = :idType"
      );

      $req->bindValue(':idType',$idTypeDonnee,PDO::PARAM_INT);

      $req->execute();

			while($donneeVariable  = $req->fetch(PDO::FETCH_OBJ)){
				$listDonneeVariable[] = new DonneeVariable($donneeVariable);
			}

			$req->closeCursor();

			return $listDonneeVariable;

    }
	}

	//Fonction permettant d'ajouter un nouvel objet DonneeVariable
	public function ajouterDonneeVariable($newDonneeVariable){
		if(!empty($newDonneeVariable)){
			$req = $this->db->prepare(
				"INSERT INTO `donnees_variable`(`idType`, `valeur`) VALUES (:idType , :valeur)"
			);

			$req->bindValue(':idType',$newDonneeVariable->getIdType(),PDO::PARAM_INT);
			$req->bindValue(':valeur',$newDonneeVariable->getValeur(),PDO::PARAM_INT);

			$result = $req->execute();

			$req->closeCursor();

			return $result;

		}
	}

	public function genererListeDonneeVariableViaInterval($interval){
		$listeDonneVariable = array();

		for ($valeur=$interval['borneInferieurInterval']; $valeur <= $interval['borneSuperieurInterval']; $valeur += $interval['pasInterval']) {
			$listDonneeVariable[] = $this->createDonneeVariableDepuisTableau(array('idType' =>  $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
		}

		return $listDonneeVariable;
	}

	public function genererListeDonneeVariableViaListe($liste){
		$listeDonneVariable = array();

		foreach ($liste as $valeur) {
			$listDonneeVariable[] = $this->createDonneeVariableDepuisTableau(array('idType' =>  $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
		}

		return $listDonneeVariable;
	}

}

?>
