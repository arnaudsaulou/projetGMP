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
        "INSERT INTO `questions`(`idEnonce` , `libelle`) VALUES (:idEnonce , :libelle)"
      );

			$req->bindValue(':idEnonce',$newQuestion->getIdEnonce(),PDO::PARAM_INT);
      $req->bindValue(':libelle',$newQuestion->getLibelle(),PDO::PARAM_STR);

      $result = $req->execute();

			$req->closeCursor();

      return $result;

    }
	}

	//Cette fonction permet d'ajouter une liste de questions à la base de données
	public function ajouterListeQuestion($lastInsertedIdEnonce){
		if(!empty($lastInsertedIdEnonce)){

			foreach ($_SESSION['tableauQuestionEnonce'] as $question) {
				$question = unserialize($question);

				$question->setIdEnonce($lastInsertedIdEnonce);
				$this->ajouterQuestion($question);

				unset($_SESSION['tableauQuestionEnonce']);
			}

		}
	}

	//Cette fonction permet de recupérer une question dans la base de données via son id
	public function recupererQuestionViaIdQuestion($idQuestion){
		if(!empty($idQuestion)){

			$req = $this->db->prepare(
				"SELECT `idQuestion` , `idEnonce` , `libelle` FROM `questions` WHERE `idQuestion` = :idQuestion"
			);

			$req->bindValue(':idQuestion',$idQuestion,PDO::PARAM_INT);

			$req->execute();

			$question = $this->createQuestionDepuisTableau($req->fetch(PDO::FETCH_OBJ));

			$req->closeCursor();

			return $question;

		}
	}



}

?>
