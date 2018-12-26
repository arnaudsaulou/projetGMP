<?php
class SolutionManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet Solution à partir d'un tableau
	public function createSolutionDepuisTableau($paramsSolution){
		return new Solution($paramsSolution);
	}


	//Cette fonction permet d'ajouter une solution à la base de données
	public function ajouterSolution($newSolution){
		if(!empty($newSolution)){

      $req = $this->db->prepare(
        "INSERT INTO `solutions`(`idSujet`, `idQuestion`, `valeur`) VALUES (:idSujet , :idQuestion , :valeur)"
      );

      $req->bindValue(':idSujet',$newSolution->getIdSujet(),PDO::PARAM_INT);
      $req->bindValue(':idQuestion',$newSolution->getIdQuestion(),PDO::PARAM_INT);
      $req->bindValue(':valeur',$newSolution->getValeur(),PDO::PARAM_STR);

      $result = $req->execute();

			$req->closeCursor();

      return $result;

    }
	}

}

?>
