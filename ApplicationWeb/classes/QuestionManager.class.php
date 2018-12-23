<?php
class QuestionManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet Question à partir d'un tableau
	public function createQuestionDepuisTableau($paramsQuestion){
		return new Question($paramsQuestion);
	}


	//Cette fonction permet d'ajouter une question à la base de données
	public function ajouterQuestion($newQuestion){
		if(!empty($newQuestion)){

      $req = $this->db->prepare(
        "INSERT INTO `questions`(`libelle`) VALUES (:libelle)"
      );

      $req->bindValue(':libelle',$newQuestion->getLibelle(),PDO::PARAM_STR);

      $result = $req->execute();

			$req->closeCursor();

      return $result;

    }
	}

}

?>
