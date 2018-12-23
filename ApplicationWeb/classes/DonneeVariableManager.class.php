<?php
class DonneeVariableManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Cette fonction permet de créer un objet DonneeVariable à partir d'un tableau
	public function createDonneeVariableDepuisTableau($paramsDonneeVariable){
		return new DonneeVariable($paramsDonneeVariable);
	}

	//Cette fonction permet de récupérer la liste des données variables à partir d'un id type de donnée
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

	//Fonction permettant d'ajouter un nouvel objet DonneeVariable à la base de données
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

	//Cette fonction permet de générer la liste des données variable à partir d'un interval
	public function genererListeDonneeVariableViaInterval($interval){
		$listeDonneVariable = array();

		for ($valeur=$interval['borneInferieurInterval']; $valeur <= $interval['borneSuperieurInterval']; $valeur += $interval['pasInterval']) {
			$listDonneeVariable[] = $this->createDonneeVariableDepuisTableau(array('idType' =>  $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
		}

		return $listDonneeVariable;
	}

	//Cette fonction permet de générer la liste des données variable à aprtir d'une liste
	public function genererListeDonneeVariableViaListe($liste){
		$listeDonneVariable = array();

		foreach ($liste as $valeur) {
			$listDonneeVariable[] = $this->createDonneeVariableDepuisTableau(array('idType' =>  $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
		}

		return $listDonneeVariable;
	}


	//Cette fonction permet de récupérer l'identifiant du type à partir d'un identifiant donnée variable
	function recupererIdTypeViaIdDonneeVariable($idDonneeVariable){
		if(!empty($idDonneeVariable)){

			$req = $this->db->prepare(
				"SELECT `idType` FROM `donnees_variable` WHERE `idDonneeVariable` = :idDonneeVariable"
			);

			$req->bindValue(':idDonneeVariable',$idDonneeVariable->getIdType(),PDO::PARAM_INT);

			$result = $req->execute();

			$idType = $req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();

			return $idType;

		}
	}

}

?>
