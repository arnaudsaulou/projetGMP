<?php

class AttribueManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

//cette fonction permet d'enregistrer un attribue dans la base de données
	public function addAttribue($Attribue){
		$req=$this->db->prepare
		('INSERT INTO attribue (idUtilisateur,idSujet,dateAttribution,dateLimite)
		VALUES (:idUtilisateur,:idSujet,:dateAttribution,:dateLimite)');

		$req->bindValue(':idUtilisateur',$Attribue->getIdUtilisateur(),PDO::PARAM_STR);
		$req->bindValue(':idSujet',$Attribue->getIdSujet(),PDO::PARAM_STR);
		$req->bindValue(':dateAttribution',$Attribue->getDateAttribution(),PDO::PARAM_STR);
		$req->bindValue(':dateLimite',$Attribue->getIdUtilisateur(),PDO::PARAM_STR);

		$req->execute();
	}

	//cette fonction permet de recuperer un attribue à partie d'un id d'utilisateur et d'un id de sujet
	public function getAttribueById($idUtilisateur,$idSujet){
			$req = $this->db->prepare(
			    'SELECT idUtilisateur,idSujet,dateAttribution, dateLimite
				FROM attribue WHERE idUtilisateur= :idUtilisateur && idSujet= :idSujet');

			$req->bindValue(':idUtilisateur',$idUtilisateur,PDO::PARAM_STR);
			$req->bindValue(':idSujet',$idSujet,PDO::PARAM_STR);

			$req->execute();


			$attribue=$req->fetch(PDO::FETCH_OBJ);

			return new Attribue($attribue);
			$req->closeCursor();

	}


}
