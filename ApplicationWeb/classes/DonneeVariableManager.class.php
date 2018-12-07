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

			return $listDonneeVariable;

			$req->closeCursor();

    }
	}

}

?>
