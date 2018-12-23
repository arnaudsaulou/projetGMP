<?php
class EnonceManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet Enonce à partir d'un tableau
	public function createEnonceDepuisTableau($paramsEnonce){
		return new Enonce($paramsEnonce);
	}


	//Cette fonction permet d'ajouter un énoncé à la base de données
	public function ajouterEnonce($newEnonce){
		if(!empty($newEnonce)){

      $req = $this->db->prepare(
        "INSERT INTO `enonce`(`nomEnonce`, `enonce`) VALUES (:nomEnonce , :enonce)"
      );

      $req->bindValue(':nomEnonce',$newEnonce->getNomEnonce(),PDO::PARAM_STR);
			$req->bindValue(':enonce',$newEnonce->getEnonce(),PDO::PARAM_STR);

      $result = $req->execute();

			$req->closeCursor();

      return $result;

    }
	}

	public function recupererListEnonce(){

		$listeEnonce = array();

		$req = $this->db->prepare("SELECT `idEnonce`,`nomEnonce`,`enonce` FROM `enonce`");

		$req->execute();

		while($enonce = $req->fetch(PDO::FETCH_OBJ)){
			$listeEnonce[] = $this->createEnonceDepuisTableau($enonce);
		};

		$req-> closeCursor();

		return $listeEnonce;
	}


	public function recupererEnonceViaIdEnonce($idEnonce){

		if(!empty($idEnonce)){

			$req = $this->db->prepare("SELECT `idEnonce`,`nomEnonce`,`enonce` FROM `enonce` WHERE `idEnonce` = :idEnonce");

			$req->bindValue(':idEnonce',$idEnonce,PDO::PARAM_STR);

			$req->execute();

			$enonce = $req->fetch(PDO::FETCH_OBJ);

			$enonce = $this->createEnonceDepuisTableau($enonce);

			$req-> closeCursor();

			return $enonce;
		}
	}

	//Cette fonction permettant de compter le nombre d'énoncé enregistrés
	public function compterEnonce(){

		$req = $this->db->prepare("SELECT count(`idEnonce`) AS total FROM `enonce`");

		$req->execute();

		$nbEnonce = $req->fetch(PDO::FETCH_ASSOC);

		$req-> closeCursor();

		return $nbEnonce['total'];

	}

}

?>
