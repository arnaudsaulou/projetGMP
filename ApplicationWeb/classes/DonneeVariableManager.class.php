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

	public function getRandomDonneeVariableByIdTypeDonnee($idTypeDonnee){

		if(!empty($idTypeDonnee)){
      $req = $this->db->prepare(
        "SELECT t.`idDonneeVariable`,`idType`,`valeur` FROM donnees_variable AS t INNER JOIN
				(SELECT ROUND(RAND() * (SELECT MAX(`idDonneeVariable`) FROM donnees_variable WHERE `idType` = :idType))
				AS idDonneeVariable ) AS x
				WHERE t.idDonneeVariable >= x.idDonneeVariable AND `idType` = :idType LIMIT 1"
      );

      $req->bindValue(':idType',$idTypeDonnee,PDO::PARAM_INT);

      $req->execute();

      $donneeVariable = $req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();

      return new DonneeVariable($donneeVariable);
    }

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
